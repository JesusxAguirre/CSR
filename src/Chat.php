<?php 
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Usuarios;

$data;
class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct(){
      
      $this->clients = new \SplObjectStorage;
      $fecha_actual = date("d-m-Y h:i:s");
      
      echo "servidor arrancado! {($fecha_actual)} \n";
      
    }
  
    public function onOpen(ConnectionInterface $conn) {
      $this->clients->attach($conn);
      $fecha_actual = date("d-m-Y h:i:s");

      echo "Nueva conexion $fecha_actual ({$conn->resourceId})  \n";
    }
    

    public function onMessage(ConnectionInterface $from, $msg) {
      global $data;
      $numRecv = count($this->clients) - 1;
      echo sprintf('El usuario %d esta enviando el mensaje: "%s" to %d other connection%s' . "\n"
      , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
      

      $data = json_decode($msg,true);
     
      $nombre_usuario = $data["from"];
     
      //$user_cedula = $datos_usuario[0]["cedula"];
      $data["date"] = date("d-m-y h:i:s");
      
      foreach($this->clients as $client){
        /* if ($from !== $client){
          $client->send($msg);
        } */
        if($from == $client){
          $data["from"] = "Yo";
        }else{
          $data["from"] = $nombre_usuario;
        }
        $client->send(json_encode($data));
      }
    } 

    public function onClose(ConnectionInterface $conn) {
      global $data;
      $data['event'] = "left";
      foreach($this->clients as $client){
        $client->send(json_encode($data));
      }
      
      $this->clients->detach($conn);
      $fecha_actual = date("d-m-Y h:i:s");
      echo "el usuario " . $data['cedula'] ."se ha desconectado $fecha_actual \n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
      echo "Ha ocurrido un error: {$e->getMessage()}\n";

      $conn->close();
    }
}
?>