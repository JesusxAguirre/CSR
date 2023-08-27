<?php

namespace React\Tests\Socket;

use React\EventLoop\Loop;
use React\Socket\TcpServer;
use React\Stream\DuplexResourceStream;
use React\Promise\Promise;

class TcpServerTest extends TestCase
{
    const TIMEOUT = 5.0;

    private $server;
    private $port;

    /**
     * @before
     * @covers React\Socket\TcpServer::__construct
     * @covers React\Socket\TcpServer::getAddress
     */
    public function setUpServer()
    {
        $this->server = new TcpServer(0);

        $this->port = parse_url($this->server->getAddress(), PHP_URL_PORT);
    }

    public function testConstructWithoutLoopAssignsLoopAutomatically()
    {
        $server = new TcpServer(0);

        $ref = new \ReflectionProperty($server, 'loop');
        $ref->setAccessible(true);
        $loop = $ref->getValue($server);

        $this->assertInstanceOf('React\EventLoop\LoopInterface', $loop);

        $server->close();
    }

    /**
     * @covers React\Socket\TcpServer::handleConnection
     */
    public function testServerEmitsConnectionEventForNewConnection()
    {
        $client = stream_socket_client('tcp://localhost:'.$this->port);
        assert($client !== false);

        $server = $this->server;
        $promise = new Promise(function ($resolve) use ($server) {
            $server->on('connection', $resolve);
        });

        $connection = \React\Async\await(\React\Promise\Timer\timeout($promise, self::TIMEOUT));

        $this->assertInstanceOf('React\Socket\ConnectionInterface', $connection);
    }

    /**
     * @covers React\Socket\TcpServer::handleConnection
     */
    public function testConnectionWithManyClients()
    {
        $client1 = stream_socket_client('tcp://localhost:'.$this->port);
        $client2 = stream_socket_client('tcp://localhost:'.$this->port);
        $client3 = stream_socket_client('tcp://localhost:'.$this->port);
        assert($client1 !== false && $client2 !== false && $client3 !== false);

        $this->server->on('connection', $this->expectCallableExactly(3));
        $this->tick();
        $this->tick();
        $this->tick();
        $this->tick();
    }

    public function testDataEventWillNotBeEmittedWhenClientSendsNoData()
    {
        $client = stream_socket_client('tcp://localhost:'.$this->port);
        assert($client !== false);

        $mock = $this->expectCallableNever();

        $this->server->on('connection', function ($conn) use ($mock) {
            $conn->on('data', $mock);
        });
        $this->tick();
        $this->tick();
    }

    public function testDataWillBeEmittedWithDataClientSends()
    {
        $client = stream_socket_client('tcp://localhost:'.$this->port);

        fwrite($client, "foo\n");

        $mock = $this->expectCallableOnceWith("foo\n");

        $this->server->on('connection', function ($conn) use ($mock) {
            $conn->on('data', $mock);
        });
        $this->tick();
        $this->tick();
    }

    public function testDataWillBeEmittedEvenWhenClientShutsDownAfterSending()
    {
        $client = stream_socket_client('tcp://localhost:' . $this->port);
        fwrite($client, "foo\n");
        stream_socket_shutdown($client, STREAM_SHUT_WR);

        $mock = $this->expectCallableOnceWith("foo\n");

        $this->server->on('connection', function ($conn) use ($mock) {
            $conn->on('data', $mock);
        });
        $this->tick();
        $this->tick();
    }

    public function testLoopWillEndWhenServerIsClosed()
    {
        // explicitly unset server because we already call close()
        $this->server->close();
        $this->server = null;

        Loop::run();

        // if we reach this, then everything is good
        $this->assertNull(null);
    }

    public function testCloseTwiceIsNoOp()
    {
        $this->server->close();
        $this->server->close();

        // if we reach this, then everything is good
        $this->assertNull(null);
    }

    public function testGetAddressAfterCloseReturnsNull()
    {
        $this->server->close();
        $this->assertNull($this->server->getAddress());
    }

    public function testLoopWillEndWhenServerIsClosedAfterSingleConnection()
    {
        $client = stream_socket_client('tcp://localhost:' . $this->port);
        assert($client !== false);

        // explicitly unset server because we only accept a single connection
        // and then already call close()
        $server = $this->server;
        $this->server = null;

        $server->on('connection', function ($conn) use ($server) {
            $conn->close();
            $server->close();
        });

        Loop::run();

        // if we reach this, then everything is good
        $this->assertNull(null);
    }

    public function testDataWillBeEmittedInMultipleChunksWhenClientSendsExcessiveAmounts()
    {
        $client = stream_socket_client('tcp://localhost:' . $this->port);
        $stream = new DuplexResourceStream($client);

        $bytes = 1024 * 1024;
        $stream->end(str_repeat('*', $bytes));

        $mock = $this->expectCallableOnce();

        // explicitly unset server because we only accept a single connection
        // and then already call close()
        $server = $this->server;
        $this->server = null;

        $received = 0;
        $server->on('connection', function ($conn) use ($mock, &$received, $server) {
            // count number of bytes received
            $conn->on('data', function ($data) use (&$received) {
                $received += strlen($data);
            });

            $conn->on('end', $mock);

            // do not await any further connections in order to let the loop terminate
            $server->close();
        });

        Loop::run();

        $this->assertEquals($bytes, $received);
    }

    public function testConnectionDoesNotEndWhenClientDoesNotClose()
    {
        $client = stream_socket_client('tcp://localhost:'.$this->port);
        assert($client !== false);

        $mock = $this->expectCallableNever();

        $this->server->on('connection', function ($conn) use ($mock) {
            $conn->on('end', $mock);
        });
        $this->tick();
        $this->tick();
    }

    /**
     * @covers React\Socket\Connection::end
     */
    public function testConnectionDoesEndWhenClientCloses()
    {
        $client = stream_socket_client('tcp://localhost:'.$this->port);

        fclose($client);

        $mock = $this->expectCallableOnce();

        $this->server->on('connection', function ($conn) use ($mock) {
            $conn->on('end', $mock);
        });
        $this->tick();
        $this->tick();
    }

    public function testCtorAddsResourceToLoop()
    {
        $loop = $this->getMockBuilder('React\EventLoop\LoopInterface')->getMock();
        $loop->expects($this->once())->method('addReadStream');

        new TcpServer(0, $loop);
    }

    public function testResumeWithoutPauseIsNoOp()
    {
        $loop = $this->getMockBuilder('React\EventLoop\LoopInterface')->getMock();
        $loop->expects($this->once())->method('addReadStream');

        $server = new TcpServer(0, $loop);
        $server->resume();
    }

    public function testPauseRemovesResourceFromLoop()
    {
        $loop = $this->getMockBuilder('React\EventLoop\LoopInterface')->getMock();
        $loop->expects($this->once())->method('removeReadStream');

        $server = new TcpServer(0, $loop);
        $server->pause();
    }

    public function testPauseAfterPauseIsNoOp()
    {
        $loop = $this->getMockBuilder('React\EventLoop\LoopInterface')->getMock();
        $loop->expects($this->once())->method('removeReadStream');

        $server = new TcpServer(0, $loop);
        $server->pause();
        $server->pause();
    }

    public function testCloseRemovesResourceFromLoop()
    {
        $loop = $this->getMockBuilder('React\EventLoop\LoopInterface')->getMock();
        $loop->expects($this->once())->method('removeReadStream');

        $server = new TcpServer(0, $loop);
        $server->close();
    }

    public function testEmitsErrorWhenAcceptListenerFailsWithoutCallingCustomErrorHandler()
    {
        $listener = null;
        $loop = $this->getMockBuilder('React\EventLoop\LoopInterface')->getMock();
        $loop->expects($this->once())->method('addReadStream')->with($this->anything(), $this->callback(function ($cb) use (&$listener) {
            $listener = $cb;
            return true;
        }));

        $server = new TcpServer(0, $loop);

        $exception = null;
        $server->on('error', function ($e) use (&$exception) {
            $exception = $e;
        });

        $this->assertNotNull($listener);
        $socket = stream_socket_server('tcp://127.0.0.1:0');

        $error = null;
        set_error_handler(function ($_, $errstr) use (&$error) {
            $error = $errstr;
        });

        $time = microtime(true);
        $listener($socket);
        $time = microtime(true) - $time;

        restore_error_handler();
        $this->assertNull($error);

        $this->assertLessThan(1, $time);

        $this->assertInstanceOf('RuntimeException', $exception);
        assert($exception instanceof \RuntimeException);
        $this->assertStringStartsWith('Unable to accept new connection: ', $exception->getMessage());

        return $exception;
    }

    /**
     * @param \RuntimeException $e
     * @requires extension sockets
     * @depends testEmitsErrorWhenAcceptListenerFailsWithoutCallingCustomErrorHandler
     */
    public function testEmitsTimeoutErrorWhenAcceptListenerFails(\RuntimeException $exception)
    {
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('Not supported on HHVM');
        }

        $this->assertEquals('Unable to accept new connection: ' . socket_strerror(SOCKET_ETIMEDOUT) . ' (ETIMEDOUT)', $exception->getMessage());
        $this->assertEquals(SOCKET_ETIMEDOUT, $exception->getCode());
    }

    public function testListenOnBusyPortThrows()
    {
        if (DIRECTORY_SEPARATOR === '\\') {
            $this->markTestSkipped('Windows supports listening on same port multiple times');
        }
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('Not supported on HHVM');
        }

        $this->setExpectedException(
            'RuntimeException',
            'Failed to listen on "tcp://127.0.0.1:' . $this->port . '": ' . (function_exists('socket_strerror') ? socket_strerror(SOCKET_EADDRINUSE) . ' (EADDRINUSE)' : 'Address already in use'),
            defined('SOCKET_EADDRINUSE') ? SOCKET_EADDRINUSE : 0
        );
        new TcpServer($this->port);
    }

    /**
     * @after
     * @covers React\Socket\TcpServer::close
     */
    public function tearDownServer()
    {
        if ($this->server) {
            $this->server->close();
        }
    }

    /**
     * This methods runs the loop for "one tick"
     *
     * This is prone to race conditions and as such somewhat unreliable across
     * different operating systems. Running the loop until the expected events
     * fire is the preferred alternative.
     *
     * @deprecated
     */
    private function tick()
    {
        if (DIRECTORY_SEPARATOR === '\\') {
            $this->markTestSkipped('Not supported on Windows');
        }

        \React\Async\await(\React\Promise\Timer\sleep(0.0));
    }
}
