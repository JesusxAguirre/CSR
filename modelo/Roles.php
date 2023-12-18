<?php

namespace Csr\Modelo;

use Csr\Modelo\Conexion;
use PDO;
use Exception;
use PDOException;
use Throwable;

class Roles extends Conexion
{

	private $conexion;
	private $nombre;
	private $descripcion;
	private $descriptedRol = 'prueba';

	//Variables para validaciones
	private $expresion_especial =  "/[^a-zA-Z0-9!@#$%^&*]/";
	private $expresion_caracteres = "/^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]{3,100}$/";

	public function __construct()
	{
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

		$idModulo = 0;
		$idPermiso = 0;

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

			$stmt = $this->conexion()->prepare($sql);

			$stmt->execute(array(
				':nombre' => $this->nombre,
				':descripcion' => $this->descriptedRol,
				':id' => $idRol
			));




			echo json_encode(array("msj" => "Se ha actualizado el Rol", "status_code" => 200));
			die();
		} catch (Throwable $ex) {
			$errorType = basename(get_class($ex));
			http_response_code($ex->getCode());
			echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
			die();
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
		$busqueda = '%' . $busqueda . '%';
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

	public function setUpdatedRol($nombre, $descripcion)
	{
		$this->nombre = $nombre;
		$this->descriptedRol = $descripcion;
	}


	//VALIDACION INYECCION SQL    
	/**
	 * security_validation_sql
	 * 
	 * Funcion que valida un array donde cada indice contiene una cadeba de texto
	 * por cada indicie verifica que ese cadena no contenga un caracter especial y luego valida si es vacio
	 * Si alguno de estos casos se cumple arroja una Exception.
	 *
	 * @param  mixed $array
	 * @return void
	 */
	public function security_validation_inyeccion_sql($array)
	{
		try {
			for ($i = 0; $i < count($array); $i++) {
				$response = preg_match($this->expresion_especial, $array[$i]);

				if ($response > 0) {
					//guardar en base de datos hacker
					throw new Exception(sprintf("Estas intentando enviar caracteres invalidos. caracter invalido-> '%s' ", $array[$i]), 422);
				}

				if ($array[$i] == "") {
					//guardar en base de datos de hacker
					throw new Exception("Estas enviando datos vacios", 422);
				}
			}
		} catch (Throwable $ex) {
			$errorType = basename(get_class($ex));
			http_response_code($ex->getCode());
			echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
			die();
		}
	}


	/**
	 * security_validation_caracteres
	 *
	 * Metodo que recibe un array donde cada indice es una cadena de texto este metodo verifica
	 * que cada indice del array sea un caracter, es decir sin numeros o caracteres especiales.
	 * si no es una cadena de texto, arroja una Exception
	 * 
	 * @param  mixed $array
	 * @return void
	 */
	public function security_validation_caracteres($array)
	{
		try {
			for ($i = 0; $i < count($array); $i++) {
				$response = preg_match($this->expresion_caracteres, $array[$i]);

				if ($response == 0) {
					//guardar datos de hacker

					throw new Exception(sprintf("El dato que estas enviando debe ser una cadena de texto con solo letras. cadena de texto. no mayor a 19 caracteres-> '%s", $array[$i]), 422);
				}
			}
		} catch (Throwable $ex) {
			$errorType = basename(get_class($ex));
			http_response_code($ex->getCode());
			echo json_encode(array("msj" => $ex->getMessage(), "status_code" => $ex->getCode(), "ErrorType" => $errorType));
			die();
		}
	}
}
