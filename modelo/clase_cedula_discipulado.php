<?php 
require_once("clase_celula_consolidacion.php");
class Discipulado extends Consolidacion{

private $variable;
private $codigos;


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





}


?>