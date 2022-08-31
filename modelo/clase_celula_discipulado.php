<?php 
require_once("clase_usuario.php");
class Discipulado extends Usuarios{

private $listar;
private $codigos;
private $direccion;
private $participantes;


  public function __construct()
  {
      $this->conexion = parent::conexion();
  }


  public function listar_celula_discipulado()
    {
        $sql = ("SELECT celula_discipulado.codigo_celula_discipulado, celula_discipulado.dia_reunion, celula_discipulado.hora, 
        lider.codigo AS codigo_lider,  anfitrion.codigo AS codigo_anfitrion, asistente.codigo AS codigo_asistente 
        FROM celula_discipulado 
        INNER JOIN usuarios AS lider  ON   celula_discipulado.cedula_lider = lider.cedula
        INNER JOIN usuarios AS anfitrion  ON   celula_discipulado.cedula_anfitrion = anfitrion.cedula
        INNER JOIN usuarios AS asistente  ON   celula_discipulado.cedula_asistente = asistente.cedula");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listar[] = $filas;
        }
        return $this->listar;
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
            ":codigo" => 'CD' . $id,
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



        //---------Comienzo de funcion de pasar id foraneo con respecto a los participantes de la celula------------------------//
        //primero vamos a buscar el id que queremos pasar como clave foranea

        $sql = ("SELECT id FROM celula_discipulado 
        WHERE cedula_lider= '$this->cedula_lider'
        AND cedula_anfitrion = '$this->cedula_anfitrion'
        AND cedula_asistente = '$this->cedula_asistente'");
       
       $stmt = $this->conexion()->prepare($sql);
       
        $stmt->execute(array());
       
        $id_discipulado  = $stmt->fetch(PDO::FETCH_ASSOC);
 
        foreach($this->participantes as $participantes){
        $sql = ("UPDATE usuarios SET id_discipulado = :id WHERE cedula = :cedula");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":id" => $id_discipulado['id'],
            ":cedula" => $participantes
        ));
        }//fin del foreach
        //id foraneo agregado por cada participante



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





/* 
    public function listar_celula_discipulado()
    {
        $celulas = $this->listar();
        $sql = ("SELECT cedula,codigo, nombre, apellido, telefono
        FROM usuarios 
        WHERE cedula = :cedula");
        $sql = $this->conexion()->prepare($sql);

        $index = 0;
        foreach ($celulas as $celula) {
            $this->cedula_lider = $celula['cedula_lider'];
            $this->cedula_anfitrion = $celula['cedula_anfitrion'];
            $this->cedula_asistente = $celula['cedula_asistente'];

            $sql->execute(array(":cedula" => $this->cedula_lider));


            while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {


                $celulas[$index]["lider"] = $filas;
            }
            $sql->execute(array(":cedula" => $this->cedula_anfitrion));
            while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {

                $celulas[$index]["anfitrion"] = $filas;
            }


            $sql->execute(array(":cedula" => $this->cedula_asistente));
            while ($filas = $sql->fetch(PDO::FETCH_ASSOC)) {

                $celulas[$index]['asistente']  = $filas;
            }


            $index++;
        }


        return $celulas;
    } */