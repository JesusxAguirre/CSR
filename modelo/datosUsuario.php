<?php

namespace Csr\Modelo;

use Csr\Modelo\Conexion;

use PDO;
use Exception;
class datosUsuario extends Conexion
{
    private $nombre;
    private $cedula;
    private $idSeccion;
    private $statusProfesor;
    private $conexion;
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
        $statusProfesor = [];
        $sql= "SELECT `usuarios`.`status_profesor` FROM `usuarios` WHERE `usuarios`.`usuario` = :usuario";
        $stmt= $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":usuario" => $usuario2,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $statusProfesor[] = $filas;
        }
        return $statusProfesor;
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