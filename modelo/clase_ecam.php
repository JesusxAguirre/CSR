<?php

use function PHPSTORM_META\sql_injection_subst;

require_once ('clase_conexion.php');

class ecam extends Conectar{
    private $conexion;
    private $idMateria;
    private $nombre;
    private $nivel;
    private $cedulaProf;
    private $listarMaterias;
    private $listarProfesoresMaterias;
    private $materiasBuscadas;

    public function __construct(){
        $this->conexion= parent::conexion();
    }
    
    //AGREGAR MATERIAS
    public function agregarMaterias(){
        $sql= "INSERT INTO materias (nombre, nivelDoctrina) VALUES (:nom, :nivelD)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":nom"=> $this->nombre,
            ":nivelD"=> $this->nivel
        ));

        /*Buscando ultimo ID de la materia agregada para guardar ese valor, luego ese valor es
        introducido en la consulta de aqui abajo para que sea dinamico*/
        foreach ($this->cedulaProf as $cedulaP) {
            $sql3= "INSERT INTO `profesores-materias` (`cedula_profesor`, `id_materia`) VALUES (:cedulaProf, (SELECT MAX(id_materia) FROM `materias`))";
            $stmt3 = $this->conexion->prepare($sql3);
            $stmt3->execute(array(
                ":cedulaProf"=> $cedulaP,
            ));
        }//Fin del  Foreach
        //Profesores vinculados con la materia
    }

    //LISTAR TODAS LAS MATERIAS
    public function listarMaterias(){
        $sql= "SELECT id_materia, nombre, nivelDoctrina FROM materias";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listarMaterias[] = $filas;
        }
        return $this->listarMaterias;
    }

    //BUSCAR MATERIAS POR AJAX
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

    //ELIMINAR MATERIAS
    public function eliminarMateria($idMateria){
        $sql = "DELETE FROM materias WHERE id_materia = $idMateria";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute();
    }

    //ACTUALIZAR MATERIAS
    public function actualizarMateria(){
        $sql= "UPDATE `materias` SET `nombre` = :nom, `nivelDoctrina` = :nivelD WHERE `materias`.`id_materia` = :idMa";
        
        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":idMa"=> $this->idMateria,
            ":nom"=> $this->nombre,
            ":nivelD"=> $this->nivel
        ));
    }

    //LISTAR PROFESORES DE LAS MATERIAS
    public function listarProfesores($idMateriaProf){

        $sql= "SELECT `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `profesores-materias`.`cedula_profesor`, `profesores-materias`.`id_materia` FROM `profesores-materias` 
        INNER JOIN usuarios ON `profesores-materias`.`cedula_profesor` = `usuarios`.`cedula` 
        INNER JOIN materias ON `profesores-materias`.`id_materia` = `materias`.`id_materia` WHERE `profesores-materias`.`id_materia` = '" . $idMateriaProf . "'";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
            $this->listarProfesoresMaterias[] = $filas;
        }
        return $this->listarProfesoresMaterias;
    }


    public function setMaterias($nombre, $nivel, $cedulaProf){
        $this->nombre= $nombre;
        $this->nivel= $nivel;
        $this->cedulaProf= $cedulaProf;
    }
    public function setActualizar($idMateria, $nombre, $nivel){
        $this->idMateria= $idMateria;
        $this->nombre= $nombre;
        $this->nivel= $nivel;
    }
}
