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

    //------------------------------------------------------Registrar discipulado ----------------------//
    public function registrar_discipulado()
    {
        //buscando ultimo id agregando
        $sql = ("SELECT MAX(id) AS id FROM celula_discipulado");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        $contador = $stmt->fetch(PDO::FETCH_ASSOC);

        $id = $contador['id'];
        //sumandole un numero para que sea dinamico 
        $id++;

        $sql = "INSERT INTO celula_discipulado (codigo_celula_discipulado,cedula_lider,
        cedula_anfitrion,cedula_asistente,dia_reunion,fecha,hora,direccion) 
        VALUES(:codigo,:cedula_lider,:cedula_anfitrion,:cedula_asistente,:dia,:fecha,:hora,:direc)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute(array(
            ":codigo" => 'CC' . $id,
            ":cedula_lider" => $this->cedula_lider, ":cedula_anfitrion" => $this->cedula_anfitrion,
            ":cedula_asistente" => $this->cedula_asistente, ":dia" => $this->dia,
            ":fecha" => $this->fecha, ":hora" => $this->hora, ":direc"=>$this->direccion
        ));

        //agregando codigo de celula a codigo de usuario
        //agregando a lider
        $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_lider'");

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());
        $codigo_lider  = $stmt->fetch(PDO::FETCH_ASSOC);


        $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":codigo" => $codigo_lider['codigo'] . '-' . 'CD' . $id,
            ":cedula" => $this->cedula_lider
        ));

        //comienzo de funcion de pasar id foraneo con respecto a la cedula en este caso primero del lider
        //primero vamos a buscar el id que queremos pasar como clave foranea

        $sql = ("SELECT id FROM celula_discipulado 
        WHERE cedula_lider= '$this->cedula_lider'
        AND cedula_anfitrion = '$this->cedula_anfitrion'
        AND cedula_asistente = '$this->cedula_asistente'");
       
       $stmt = $this->conexion()->prepare($sql);
       
        $stmt->execute(array());
       
        $id_discipulado  = $stmt->fetch(PDO::FETCH_ASSOC);
       
        $id_discipulado = $id_discipulado['id'];
        $sql = ("UPDATE usuarios SET id_discipulado = :id WHERE cedula = :cedula");

        //comprobando que el anfitrion y el asistente sean la misma cedula
        if ($this->cedula_anfitrion == $this->cedula_asistente) {
            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_anfitrion'");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());

            $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_anfitrion['codigo']  . '-' . 'CD' . $id,
                ":cedula" => $this->cedula_anfitrion
            ));
        } else {
            //agregando codigo de celula por separado de anfitrion y asistente
            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_anfitrion'");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array());

            $codigo_anfitrion  = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_anfitrion['codigo']  . '-' . 'CD' . $id,
                ":cedula" => $this->cedula_anfitrion
            ));

            $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$this->cedula_asistente'");

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array());

            $codigo_asistente  = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":codigo" => $codigo_asistente['codigo']  . '-' . 'CD' . $id,
                ":cedula" => $this->cedula_asistente
            ));
        }
    }
    //-------- SET DATOS Para registar discipulado-------------------------------------//
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