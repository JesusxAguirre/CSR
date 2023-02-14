<?php 
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Usuarios;

session_start();
require "./modelo/clase_usuario.php";
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

      echo "Nueva conexion $fecha_actual ({$conn->resourceId})\n";
    }
    

    public function onMessage(ConnectionInterface $from, $msg) {
      $numRecv = count($this->clients) - 1;
      echo sprintf('El usuario %d esta enviando el mensaje: "%s" to %d other connection%s' . "\n"
      , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
      

      $data = json_decode($msg,true);
      $objeto_usuario = New Usuarios();
      $datos_usuario = $objeto_usuario->mi_perfil();

      $user_name = $datos_usuario[0]["nombre"];
      $user_last_name = $datos_usuario[0]["apellido"];
      $user_cedula = $datos_usuario[0]["cedula"];

      foreach($this->clients as $client){
        /* if ($from !== $client){
          $client->send($msg);
        } */
        if($from == $client){
          $data["from"] = "Me";
        }else{
          $data["from"] = $user_name . " " . $user_last_name;   
        }
        $client->send(json_encode($data));
      }
    } 

    public function onClose(ConnectionInterface $conn) {
      $this->clients->detach($conn);
      $fecha_actual = date("d-m-Y h:i:s");
      echo "el usuario ({$conn->resourceId}) se ha desconectado $fecha_actual \n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
      echo "Ha ocurrido un error: {$e->getMessage()}\n";

      $conn->close();
    }
}
?>