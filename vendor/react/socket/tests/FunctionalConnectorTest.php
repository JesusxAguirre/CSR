<?php

namespace React\Tests\Socket;

use React\EventLoop\Loop;
use React\Promise\Deferred;
use React\Socket\ConnectionInterface;
use React\Socket\Connector;
use React\Socket\ConnectorInterface;
use React\Socket\TcpServer;

class FunctionalConnectorTest extends TestCase
{
    const TIMEOUT = 30.0;

    private $ipv4;
    private $ipv6;

    /** @test */
    public function connectionToTcpServerShouldSucceedWithLocalhost()
    {
        $server = new TcpServer(9998);

        $connector = new Connector(array());

        $connection = \React\Async\await(\React\Promise\Timer\timeout($connector->connect('localhost:9998'), self::TIMEOUT));

        $server->close();

        $this->assertInstanceOf('React\Socket\ConnectionInterface', $connection);

        $connection->close();
    }

    /**
     * @group internet
     */
    public function testConnectTwiceWithoutHappyEyeBallsOnlySendsSingleDnsQueryDueToLocalDnsCache()
    {
        if ((DIRECTORY_SEPARATOR === '\\' && PHP_VERSION_ID < 70000) || defined('HHVM_VERSION')) {
            $this->markTestSkipped('Not supported on Windows for PHP versions < 7.0 and legacy HHVM');
        }

        $socket = stream_socket_server('udp://127.0.0.1:0', $errno, $errstr, STREAM_SERVER_BIND);

        $connector = new Connector(array(
            'dns' => 'udp://' . stream_socket_get_name($socket, false),
            'happy_eyeballs' => false
        ));

        // minimal DNS proxy stub which forwards DNS messages to actual DNS server
        $received = 0;
        Loop::addReadStream($socket, function ($socket) use (&$received) {
            $request = stream_socket_recvfrom($socket, 65536, 0, $peer);

            $client = stream_socket_client('udp://8.8.8.8:53');
            fwrite($client, $request);
            $response = fread($client, 65536);

            stream_socket_sendto($socket, $response, 0, $peer);
            ++$received;
            fclose($client);
        });

        $connection = \React\Async\await($connector->connect('example.com:80'));
        $connection->close();
        $this->assertEquals(1, $received);

        $connection = \React\Async\await($connector->connect('example.com:80'));
        $connection->close();
        $this->assertEquals(1, $received);

        Loop::removeReadStream($socket);
    }

    /**
     * @test
     * @group internet
     */
    public function connectionToRemoteTCP4n6ServerShouldResultInOurIP()
    {
        // max_nesting_level was set to 100 for PHP Versions < 5.4 which resulted in failing test for legacy PHP
        ini_set('xdebug.max_nesting_level', 256);

        $connector = new Connector(array('happy_eyeballs' => true));

        $ip = \React\Async\await(\React\Promise\Timer\timeout($this->request('dual.tlund.se', $connector), self::TIMEOUT));

        $this->assertNotFalse(inet_pton($ip));
    }

    /**
     * @test
     * @group internet
     */
    public function connectionToRemoteTCP4ServerShouldResultInOurIP()
    {
        $connector = new Connector(array('happy_eyeballs' => true));

        try {
            $ip = \React\Async\await(\React\Promise\Timer\timeout($this->request('ipv4.tlund.se', $connector), self::TIMEOUT));
        } catch (\Exception $e) {
            $this->checkIpv4();
            throw $e;
        }

        $this->assertNotFalse(inet_pton($ip));
        $this->assertEquals(4, strlen(inet_pton($ip)));
    }

    /**
     * @test
     * @group internet
     */
    public function connectionToRemoteTCP6ServerShouldResultInOurIP()
    {
        $connector = new Connector(array('happy_eyeballs' => true));

        try {
            $ip = \React\Async\await(\React\Promise\Timer\timeout($this->request('ipv6.tlund.se', $connector), self::TIMEOUT));
        } catch (\Exception $e) {
            $this->checkIpv6();
            throw $e;
        }

        $this->assertNotFalse(inet_pton($ip));
        $this->assertEquals(16, strlen(inet_pton($ip)));
    }

    public function testCancelPendingTlsConnectionDuringTlsHandshakeShouldCloseTcpConnectionToServer()
    {
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('Not supported on legacy HHVM');
        }

        $server = new TcpServer(0);
        $uri = str_replace('tcp://', 'tls://', $server->getAddress());

        $connector = new Connector(array());
        $promise = $connector->connect($uri);

        $deferred = new Deferred();
        $server->on('connection', function (ConnectionInterface $connection) use ($promise, $deferred) {
            $connection->on('close', function () use ($deferred) {
                $deferred->resolve(null);
            });

            Loop::futureTick(function () use ($promise) {
                $promise->cancel();
            });
        });

        \React\Async\await(\React\Promise\Timer\timeout($deferred->promise(), self::TIMEOUT));
        $server->close();

        try {
            \React\Async\await(\React\Promise\Timer\timeout($promise, self::TIMEOUT));
            $this->fail();
        } catch (\Exception $e) {
            $this->assertInstanceOf('RuntimeException', $e);
            $this->assertEquals('Connection to ' . $uri . ' cancelled during TLS handshake (ECONNABORTED)', $e->getMessage());
        }
    }

    /**
     * @internal
     */
    public function parseIpFromPage($body)
    {
        $ex = explode('title="Look up on bgp.he.net">', $body);
        $ex = explode('<', $ex[1]);

        return $ex[0];
    }

    private function request($host, ConnectorInterface $connector)
    {
        $that = $this;
        return $connector->connect($host . ':80')->then(function (ConnectionInterface $connection) use ($host) {
            $connection->write("GET / HTTP/1.1\r\nHost: " . $host . "\r\nConnection: close\r\n\r\n");

            return \React\Promise\Stream\buffer($connection);
        })->then(function ($response) use ($that) {
            return $that->parseIpFromPage($response);
        });
    }

    private function checkIpv4()
    {
        if ($this->ipv4 === null) {
            $this->ipv4 = !!@file_get_contents('http://ipv4.tlund.se/');
        }

        if (!$this->ipv4) {
            $this->markTestSkipped('IPv4 connection not supported on this system');
        }
    }

    private function checkIpv6()
    {
        if ($this->ipv6 === null) {
            $this->ipv6 = !!@file_get_contents('http://ipv6.tlund.se/');
        }

        if (!$this->ipv6) {
            $this->markTestSkipped('IPv6 connection not supported on this system');
        }
    }
}
