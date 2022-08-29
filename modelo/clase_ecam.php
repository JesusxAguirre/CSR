<?php


require_once("clase_usuario.php");

class Ecam extends Usuarios {



    public function __construct(){      
    				$this->conexion = parent::conexion();
    }






}
?>