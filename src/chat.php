<?php

namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Csr\Modelo\ChatRoom;
//require dirname(__DIR__) . '/modelo/ChatRoom.php';

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo 'Servidor iniciado!';
    }

    public function onOpen(ConnectionInterface $conn) {
        
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
        
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        //Capturando datos del JS
        $data = json_decode($msg, true);

        //Capturando informacion de usuarios y mensajes
        $chat_objeto = new ChatRoom;
        /*$chat_objeto->setUserId($data['cedula']);
        $chat_objeto->setMensaje($data['mensaje']);
        $chat_objeto->setHoraMensaje($data['msgHora']);*/
        $chat_objeto->guardar_chat($data['cedula'], $data['mensaje'], $data['msgHora']);  //Este metodo guardara los datos del Chat Room
        

        foreach ($this->clients as $client) {
            /*if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }*/

            if ($from == $client) {
                $data['from'] = 'Me';
                $data['event'] = 'mensaje';
            }else{
                $data['from'] = $data['usuario'];
                $data['event'] = 'mensaje';
            }
            $client->send(json_encode($data));
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        global $datos;

        $datos['event'] = 'outside';
        $datos['respuesta'] = "El usuario {$conn->resourceId} se ha desconectado";
        foreach ($this->clients as $client) {
            $client->send(json_encode($datos));
        }

        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}