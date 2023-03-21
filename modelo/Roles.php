<?php   
namespace Csr\Modelo;
use Csr\Modelo\Conexion;
use PDO;
use Exception;
use PDOException;
class Roles extends Conexion {

	private $conexion;
	private $nombre;
	private $descripcion;

	public function __construct() {
		$this->conexion = parent::conexion();
	}

	public function get_roles()
	{
		$stmt = $this->conexion->prepare("SELECT * FROM roles");
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function get_modulos()
	{
		$stmt = $this->conexion->prepare("SELECT * FROM modulos");
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function get_permisos($idRol)
	{
		$stmt = $this->conexion->prepare("SELECT * FROM permisos");
		$stmt->execute();

		$permisos = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$modulos = $this->get_modulos();

		$idModulo;
		$idPermiso;

		$sql = "SELECT * FROM intermediaria WHERE id_rol = :idRol AND id_modulos = :idModulo AND id_permisos = :idPermiso";

		$stmt = $this->conexion->prepare($sql);

		$stmt->bindParam(':idRol', $idRol);
		$stmt->bindParam(':idModulo', $idModulo);
		$stmt->bindParam(':idPermiso', $idPermiso);
		//print_r($permisos); exit;
		foreach ($modulos as $modulo) {
			$idModulo = $modulo['id'];

			foreach ($permisos as $permiso) {
				$idPermiso = $permiso['id'];

				$stmt->execute();

				if ($stmt->rowCount() >= 1) {
					$respuesta1[$permiso['nombre']] = true;
				} else {
					$respuesta1[$permiso['nombre']] = false;
				}
			}
			$respuesta2[$modulo['nombre']] = $respuesta1;
		}

		return $respuesta2;
	}

	public function update_permisos($idRol, $permisos)
	{
		try {
			$sql = "DELETE FROM intermediaria WHERE id_rol = :idRol";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':idRol', $idRol);
			$stmt->execute();

			$sql = "INSERT INTO intermediaria(id_rol, id_modulos, id_permisos) VALUES (:idRol, :idModulo, :idPermiso)";
			$stmt = $this->conexion->prepare($sql);
			$stmt->bindParam(':idRol', $idRol);

			foreach ($permisos as $keyModulo => $modulo) { //KeyModulo contiene el indice actual en forma de cadena, ej: '1'
				$idModulo = substr($keyModulo, 1); //Elimia el primer caracter de la cadena, en este caso '
				$idModulo = intval($idModulo); //transforma a entero
				$stmt->bindParam(':idModulo', $idModulo);
				
				foreach ($modulo as $idPermiso) {
					$stmt->bindParam(':idPermiso', $idPermiso);
					$stmt->execute();
				}
			}
			return true;
		} catch (PDOException $e) {
			echo $e;
			return false;
		}
		
	}

	
	public function update_rol($idRol)
	{
		$sql = "UPDATE roles SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";

		try {
			$stmt = $this->conexion->prepare($sql);

			$stmt->bindParam(':nombre', $this->nombre);
			$stmt->bindParam(':descripcion', $this->descripcion);
			$stmt->bindParam(':id', $idRol);

			$stmt->execute();

			return true;
		} catch (PDOException $e) {
			echo $e;
			return false;
		}
	}


	//Validar eliminar Rol
	public function validar_eliminar_rol($idRol)
	{
		$sql = "SELECT * FROM usuarios WHERE usuarios.id_rol = :id_rol";
		$stmt = $this->conexion->prepare($sql);
		$stmt->execute(array("id_rol" => $idRol));
		$resultado = $stmt->rowCount();

		return $resultado;
	}
	public function delete_rol($idRol)
	{
		// Verifica si existe el rol a eliminar
		$sql = "SELECT * FROM roles WHERE id = :id";
		$stmt = $this->conexion->prepare($sql);
		$stmt->bindParam(':id', $idRol);
		$stmt->execute();

		if ($stmt->rowCount() == 0) {
			return false;
		}

		// Elimina primero los permisos
		$sql = "DELETE FROM intermediaria WHERE id_rol = :id";
		$stmt = $this->conexion->prepare($sql);
		$stmt->bindParam(':id', $idRol);
		$stmt->execute();

		$sql = "DELETE FROM roles WHERE id = :id";

		try {
			$stmt = $this->conexion->prepare($sql);

			$stmt->bindParam(':id', $idRol);

			$stmt->execute();

			return true;
		} catch (PDOException $e) {
			echo $e;
			return false;
		}
	}

	//Validar datos enviados para crear rol
	public function validar_crear_rol($nombre)
	{
		$sql = "SELECT * FROM `roles` WHERE nombre = :nombre";
		$stmt = $this->conexion->prepare($sql);
		$stmt->execute(array(":nombre" => $nombre));
		$resultado = $stmt->rowCount();

		return $resultado;
	}
	public function create_rol()
	{
		$sql = "INSERT INTO roles (id, nombre, descripcion) VALUES (NULL, :nombre, :descripcion)";

		try {
			$stmt = $this->conexion->prepare($sql);

			$stmt->bindParam(':nombre', $this->nombre);
			$stmt->bindParam(':descripcion', $this->descripcion);

			$stmt->execute();

			return true;
		} catch (PDOException $e) {
			echo $e;
			return false;
		}
	}

	public function buscar_roles($busqueda)
	{
		$busqueda = '%'.$busqueda.'%';
		$stmt = $this->conexion->prepare("SELECT * FROM roles WHERE id LIKE :id OR nombre LIKE :nombre OR descripcion LIKE :descripcion");

		$stmt->bindParam(':id', $busqueda);
		$stmt->bindParam(':nombre', $busqueda);
		$stmt->bindParam(':descripcion', $busqueda);

		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function setDatos($nombre, $descripcion)
	{
		$this->nombre      = $nombre;
		$this->descripcion = $descripcion;
	}
}
?>