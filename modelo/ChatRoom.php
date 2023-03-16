<?php
require_once('clase_conexion.php');

class chatRoom extends Conectar
{
    public $conx;
    private $conexion;
    private $chat_id;
    private $user_id; //Cedula
    private $mensaje;
    private $hora_enviado;

    public function __construct()
    {
        $this->conexion = parent::conexion();
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }
    public function setHoraMensaje($hora_enviado)
    {
        $this->$hora_enviado = $hora_enviado;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
    public function getMensaje()
    {
        return $this->mensaje;
    }
    public function getHoraMensaje()
    {
        return $this->hora_enviado;
    }




    public function guardar_chat($cedula, $mensaje, $mensajeHora)
    {
       
        try {
            $sql = "INSERT INTO `chatroom_prueba` (`user`, `msg`, `hora_msg`, `fecha_agregada`) VALUES (:cedula, :mensaje, :hora_enviado, CURDATE())";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(
                ":cedula" => $cedula,
                ":mensaje" => $mensaje,
                ":hora_enviado" => $mensajeHora,
            ));
          } catch (Exception $e) {
  
              echo $e->getMessage();
  
              echo "Linea del error: " . $e->getLine();
          }
    }

    public function getChatDatos()
    {
        $filas = [];
        $sql = "SELECT * FROM chatroom_prueba INNER JOIN usuarios ON usuarios.cedula = chatroom_prueba.user ORDER BY chatroom_prueba.id ASC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array());

        while ($filas2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $filas[] = $filas2;
        }
        return $filas;
    }
}

?>