<?php
require_once("clase_usuario.php");
class LaRoca extends Usuarios
{

    private $listar;
    private $codigos;
    private $direccion;
    private $cedula_participante;
    private $dia;
    private $hora;
    private $id;
    private $fecha;
    private $busqueda;

    public function __construct()
    {
        $this->conexion = parent::conexion();
    }
   

  

}
