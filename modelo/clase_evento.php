<?php   
require_once("clase_conexion.php");

class Evento extends Conectar {

	private $conexion;
	private $titulo;
	private $inicio;
	private $final;

	public function __construct() {
		$this->conexion = parent::conexion();
	}

	public function get_eventos()
	{
		$stmt = $this->conexion->prepare("SELECT * FROM eventos");
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function setDatos($titulo, $inicio, $final)
	{
		$this->titulo = $titulo;
		$this->inicio = $inicio;
		$this->final  = $final;
	}
}
?>