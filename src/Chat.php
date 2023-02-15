<?php 
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Usuarios;

$data= array();
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
      $data["event"] = "iniciar";
      $data["mensaje"] = "el usuario {$conn->resourceId} ha iniciado sesion";

      foreach($this->clients as $client){
        $client->send(json_encode($data));
      }
      echo "Nueva conexion $fecha_actual ({$conn->resourceId})  \n";
    }
    

    public function onMessage(ConnectionInterface $from, $msg) {
       global $data;
       $numRecv = count($this->clients) - 1;
       echo sprintf('El usuario %d esta enviando el mensaje: "%s" to %d other connection%s' . "\n"
      , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
      
      
      $data[$from->resourceId]=  json_decode($msg,true);
     
      $nombre_usuario = $data[$from->resourceId]["from"];
     
      //$user_cedula = $datos_usuario[0]["cedula"];
      $data[$from->resourceId]["date"] = date("d-m-y h:i:s");
      
      foreach($this->clients as $client){
        /* if ($from !== $client){
          $client->send($msg);
        } */
        if($from == $client){
          $data[$from->resourceId]["from"] = "Yo";
        }else{
          $data[$from->resourceId]["from"] = $nombre_usuario;
        }
        $client->send(json_encode($data[$from->resourceId]));
      }
    } 

    public function onClose(ConnectionInterface $conn) {
      global $data;
      $data[$conn->resourceId]["event"] = "left";
      $data[$conn->resourceId]["mensaje"] =  "el usuario {$conn->resourceId} se desconecto ";
     
      foreach($this->clients as $client){
        $client->send(json_encode($data[$conn->resourceId]));
      } 
      $this->clients->detach($conn);
      $fecha_actual = date("d-m-Y h:i:s");
      echo "el usuario {$conn->resourceId}  se ha desconectado $fecha_actual \n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
      echo "Ha ocurrido un error: {$e->getMessage()}\n";

      $conn->close();
    }
}
?>