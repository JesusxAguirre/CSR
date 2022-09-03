<?php

use function PHPSTORM_META\sql_injection_subst;

require_once ('clase_conexion.php');

class ecam extends Conectar{
    private $conexion;
    private $nombre;
    private $nivel;
    private $listarMaterias;
    private $materiasBuscadas;

    public function __construct(){
        $this->conexion= parent::conexion();
    }
    
    public function agregarMaterias(){
        $sql= "INSERT INTO materias (nombre, nivelDoctrina) VALUES (:nom, :nivelD)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":nom"=> $this->nombre,
            ":nivelD"=> $this->nivel
        ));
    }

    public function listarMaterias(){
        $sql= "SELECT id_materia, nombre, nivelDoctrina FROM materias";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listarMaterias[] = $filas;
        }
        return $this->listarMaterias;
    }

    public function buscarMateria($busqueda){
        $sql = "SELECT id_materia, nombre, nivelDoctrina FROM materias WHERE nombre LIKE '%" . $busqueda . "%' 
        OR nivelDoctrina LIKE '%" . $busqueda. "%'";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        if ($stmt->rowCount() > 0) {
            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $this->materiasBuscadas[] = $filas;
            }
        }
        return $this->materiasBuscadas;
    }

    public function eliminarMateria($idMateria){
        $sql = "DELETE FROM materias WHERE id_materia = $idMateria";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute();
    }

    public function setMaterias($nombre, $nivel){
        $this->nombre= $nombre;
        $this->nivel= $nivel;
    }
}
?>