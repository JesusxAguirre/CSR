<?php
require_once("clase_conexion.php");

class datosUsuario extends Conectar
{
    private $nombre;
    private $cedula;
    private $idSeccion;
    private $statusProfesor;

    public function __construct()
    {
        $this->conexion = parent::conexion();
    }

    public function nombre()
    {
        $usuario= $_SESSION['usuario'];

        $sql= "SELECT `usuarios`.`nombre`, `usuarios`.`apellido` FROM `usuarios` WHERE `usuarios`.`usuario` = :usuario";
        $stmt= $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":usuario" => $usuario,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->nombre[] = $filas;
        }
        return $this->nombre;
    }

    public function idSeccion()
    {
        $usuario1= $_SESSION['usuario'];

        $sql= "SELECT IFNULL(`usuarios`.`id_seccion`, '0') AS idSeccion FROM `usuarios` WHERE `usuarios`.`usuario` = :usuario";
        $stmt= $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":usuario" => $usuario1,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->idSeccion[] = $filas;
        }
        return $this->idSeccion;
    }

    public function statusProfesor()
    {
        $usuario2= $_SESSION['usuario'];

        $sql= "SELECT `usuarios`.`status_profesor` FROM `usuarios` WHERE `usuarios`.`usuario` = :usuario";
        $stmt= $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":usuario" => $usuario2,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->statusProfesor[] = $filas;
        }
        return $this->statusProfesor;
    }

    public function cedula()
    {
        $usuario3= $_SESSION['usuario'];

        $sql= "SELECT `usuarios`.`cedula` FROM `usuarios` WHERE `usuarios`.`usuario` = :usuarioEcam";
        $stmt= $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":usuarioEcam" => $usuario3,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->cedula[] = $filas;
        }
        return $this->cedula;
    }
}

?>