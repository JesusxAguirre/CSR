<?php
require_once("clase_usuario.php");
class LaRoca extends Usuarios
{

    private $listar;
    private $nombre_anfitricion;
    private $direccion;
    private $cantidad_integrantes;
    private $telefono;
    private $dia;
    private $hora;
    private $id;
    private $fecha;
    private $busqueda;
    private $cedula_lider;

    public function __construct()
    {
        $this->conexion = parent::conexion();
    }
   
    public function registrar_CSR()
    {
        //buscando ultimo id agregando
        $sql = ("SELECT MAX(id) AS id FROM casas_la_roca");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        $contador = $stmt->fetch(PDO::FETCH_ASSOC);

        $id = $contador['id'];
        //sumandole un numero para que sea dinamico 
        $id++;

        $sql = "INSERT INTO casas_la_roca (codigo,cedula_lider,
        nombre_anfitrion,telefono_anfitrion,cantidad_personas_hogar,dia_visita,fecha,hora_pautada) 
        VALUES(:codigo,:cedula_lider,:nombre,:telefono,:cantidad,:dia,:fecha,:hora)";

        $stmt = $this->conexion->prepare($sql);
        foreach($this->cedula_lider AS $cedula_lider){
           
      
        $stmt->execute(array(
            ":codigo" => 'CSR' . $id,
            ":cedula_lider" => $cedula_lider, ":nombre" => $this->nombre_anfitrion,
            ":telefono" => $this->telefono, ":cantidad"=>$this->cantidad_integrantes,
             ":dia" => $this->dia,
            ":fecha" => $this->fecha, ":hora" => $this->hora
        ));
        //---------pasando codigo de CSR a lider de la casa sobre la roca------------------------//

        $sql = ("SELECT codigo FROM usuarios WHERE cedula = '$cedula_lider'");

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());
        $codigo_lider  = $stmt->fetch(PDO::FETCH_ASSOC);


        $sql = ("UPDATE usuarios SET codigo = :codigo WHERE cedula = :cedula");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":codigo" => $codigo_lider['codigo'] . '-' . 'CSR' . $id,
            ":cedula" => $cedula_lider
        ));
    }//fin del foreach
        return true;
    }
  
    public function listar_casas_la_roca()
    {
        $sql = ("SELECT casas_la_roca.id, casas_la_roca.codigo, casas_la_roca.cedula_lider, casas_la_roca.nombre_anfitrion, 
        casas_la_roca.telefono_anfitrion,casas_la_roca.cantidad_personas_hogar,casas_la_roca.dia_visita,
        casas_la_roca.fecha,casas_la_roca.hora_pautada, lider.codigo AS codigo_lider
        FROM casas_la_roca 
        INNER JOIN usuarios AS lider  ON casas_la_roca.cedula_lider = lider.cedula");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listar[] = $filas;
        }
        return $this->listar;
    }

    public function listar_casas_la_roca_por_usuario()
    {
        $usuario = $_SESSION['usuario'];
        $sql = ("SELECT casas_la_roca.id, casas_la_roca.codigo, casas_la_roca.cedula_lider, lider.codigo AS codigo_lider
        FROM casas_la_roca 
        INNER JOIN usuarios AS lider  ON casas_la_roca.cedula_lider = lider.cedula
        WHERE casas_la_roca.cedula_lider = (SELECT cedula FROM usuarios WHERE usuario = '$usuario') ");

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listar[] = $filas;
        }
        return $this->listar;
    }


    public function setCSR($cedula_lider,$direccion,$nombre_anfitrion,$telefono,$dia,$hora,$cantidad_integrantes){
        $this->cedula_lider = $cedula_lider;
        $this->direccion = $direccion;
        $this->nombre_anfitrion = $nombre_anfitrion;
        $this->telefono = $telefono;
        $this->hora = $hora;
        $this->dia = $dia;
        $this->cantidad_integrantes = $cantidad_integrantes;
        $this->fecha = gmdate("y-m-d", time());
    }
}
