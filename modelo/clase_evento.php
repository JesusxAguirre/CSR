<?php   
require_once("clase_conexion.php");

class Evento extends Conectar {

	private $conexion;
	private $titulo;
	private $descripcion;
	private $inicio;
	private $final;
	private $oculto;

	public function __construct() {
		$this->conexion = parent::conexion();
	}

	public function get_eventos()
	{
		$stmt = $this->conexion->prepare("SELECT * FROM eventos WHERE oculto = 0");
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function get_eventosOcultos()
	{
		$stmt = $this->conexion->prepare("SELECT * FROM eventos WHERE oculto = 1");
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function create_evento()
	{
		$sql = "INSERT INTO eventos (titulo, descripcion, inicio, final, oculto) VALUES (:titulo, :descripcion, :inicio, :final, :oculto)";

		try {
			$stmt = $this->conexion->prepare($sql);

			$stmt->bindParam(':titulo', $this->titulo);
			$stmt->bindParam(':descripcion', $this->descripcion);
			$stmt->bindParam(':inicio', $this->inicio);
			$stmt->bindParam(':final', $this->final);
			$stmt->bindParam(':oculto', $this->oculto);

			$stmt->execute();

			return true;
		} catch (PDOException $e) {
			echo $e;
			return false;
		}
	}

	public function setDatos($titulo, $descripcion, $inicio, $final, $oculto)
	{
		$this->titulo      = $titulo;
		$this->descripcion = $descripcion;
		$this->inicio      = $inicio;
		$this->final       = $final;
		$this->oculto      = $oculto;
	}
}
?>