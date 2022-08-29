<?php 
require_once("clase_celula_consolidacion.php");
class Discipulado extends Consolidacion{

private $variable;
private $codigos;
private $direccion;
private $participantes;


  public function __construct()
  {
      $this->conexion = parent::conexion();
  }



  public function listar_codigos()
  {

      $consulta = ("SELECT cedula,codigo FROM usuarios");

      $sql = $this->conexion()->prepare($consulta);

      $sql->execute(array());

      while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {


          $this->codigos[] = $filas;
      }
      return $this->codigos;
  }
    //-------- SET DATOS Para registar consolidacion-------------------------------------//
  public function setDiscipulado($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion,$participantes)
  {
      $this->cedula_lider = $cedula_lider;
      $this->cedula_anfitrion = $cedula_anfitrion;
      $this->cedula_asistente = $cedula_asistente;
      $this->dia = $dia;
      $this->hora = $hora;
      $this->fecha = gmdate("y-m-d", time());
      $this->direccion = $direccion;
      $this->participantes = $participantes;
  }



}


?>