<?php 
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct(){
      $this->clients = new \SplObjectStorage;
    }
  
    public function onOpen(ConnectionInterface $conn) {
    $this->clients->attach($conn);
    $fecha_actual = date("d-m-Y h:i:s");

    echo "Nueva conexion ({$fecha_actual}) ({$conn->resourceId}\n)";
    }
    

    public function onMessage(ConnectionInterface $from, $msg) {
      $numRecv = count($this->clients) - 1;
      echo sprintf('El usuario %d esta enviando el mensaje: "%s" to %d other connection%s' . "\n"
      , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

      foreach($this->clients as $client){
        if ($from !== $client){
          $client->send($msg);
        }
      }
    } 

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}
?>