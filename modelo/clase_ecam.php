<?php

use function PHPSTORM_META\sql_injection_subst;

require_once('clase_conexion.php');

class ecam extends Conectar
{
    private $conexion;
    private $idMateria;
    private $nombre;
    private $nivel;
    private $cedulaProfesor;
    private $listarMaterias;
    private $listarProfesoresMaterias;
    private $materiasBuscadas;
    private $todosProfesores;
    private $todosProfesores2;


    public function __construct()
    {
        $this->conexion = parent::conexion();
    }

    //LISTAR PROFESORES TODOS LOS PROFESORES
    public function listarProfesores()
    {

        $sql = "SELECT cedula,codigo,nombre,apellido,telefono FROM usuarios";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->todosProfesores[] = $filas;
        }
        return $this->todosProfesores;
    }
    public function listarSelectProfesores($idNoMateria)
    {

        $sql = "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `materias`.`id_materia` FROM `usuarios`, `materias` 
        WHERE NOT EXISTS (SELECT * FROM `profesores-materias` 
        WHERE `usuarios`.`cedula` = `profesores-materias`.`cedula_profesor` 
        AND `profesores-materias`.`id_materia` = $idNoMateria) AND `materias`.`id_materia` = $idNoMateria";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->todosProfesores2[] = $filas;
        }
        return $this->todosProfesores2;
    }

    //AGREGAR MATERIAS
    public function agregarMaterias()
    {
        $sql = "INSERT INTO materias (nombre, nivelDoctrina) VALUES (:nom, :nivelD)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":nom" => $this->nombre,
            ":nivelD" => $this->nivel
        ));

        /*Buscando ultimo ID de la materia agregada para guardar ese valor, luego ese valor es
        introducido en la consulta de aqui abajo para que sea dinamico*/
        foreach ($this->cedulaProfesor as $cedulaP) {
            $sql3 = "INSERT INTO `profesores-materias` (`cedula_profesor`, `id_materia`) VALUES (:cedulaProf, (SELECT MAX(id_materia) FROM `materias`))";
            $stmt3 = $this->conexion->prepare($sql3);
            $stmt3->execute(array(
                ":cedulaProf" => $cedulaP,
            ));
        } //Fin del  Foreach
        //Profesores vinculados con la materia
    }

    //ACTUALIZAR Y VINCULAR PROFESOR CON LA MATERIA
    public function vincularProfesor($cedulaProfesorV, $idMateriaV)
    {
        foreach ($cedulaProfesorV as $cedulaPV) {
            $sql3 = "INSERT INTO `profesores-materias` (`cedula_profesor`, `id_materia`) VALUES (:cedulaProf, :idMateria)";
            $stmt3 = $this->conexion->prepare($sql3);
            $stmt3->execute(array(
                ":cedulaProf" => $cedulaPV,
                ":idMateria" => $idMateriaV,
            ));
        } //Fin del  Foreach
        //Profesores vinculados con la materia
    }


    //LISTAR TODAS LAS MATERIAS
    public function listarMaterias()
    {
        $sql = "SELECT id_materia, nombre, nivelDoctrina FROM materias";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listarMaterias[] = $filas;
        }
        return $this->listarMaterias;
    }

    //BUSCAR MATERIAS POR AJAX
    public function buscarMateria($busqueda)
    {
        $sql = "SELECT id_materia, nombre, nivelDoctrina FROM materias WHERE nombre LIKE '%" . $busqueda . "%' 
        OR nivelDoctrina LIKE '%" . $busqueda . "%'";

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
    public function eliminarMateria($idMateria)
    {
        $sql = "DELETE FROM materias WHERE id_materia = $idMateria";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute();
    }

    //ELIMINAR PROFESORES DE LAS MATERIAS
    public function desvincularProfesor($cedulaProf, $idMateria2)
    {
        $sql = "DELETE FROM `profesores-materias` 
        WHERE `profesores-materias`.`cedula_profesor` = $cedulaProf 
        AND `profesores-materias`.`id_materia` = $idMateria2";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute();
    }

    //ACTUALIZAR MATERIAS
    public function actualizarMateria()
    {
        $sql = "UPDATE `materias` SET `nombre` = :nom, `nivelDoctrina` = :nivelD WHERE `materias`.`id_materia` = :idMa";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":idMa" => $this->idMateria,
            ":nom" => $this->nombre,
            ":nivelD" => $this->nivel
        ));
    }

    //LISTAR PROFESORES DE LAS MATERIAS
    public function listarProfesoresMateria($idMateriaProf)
    {

        $sql = "SELECT `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `profesores-materias`.`cedula_profesor`, `profesores-materias`.`id_materia` FROM `profesores-materias` 
        INNER JOIN usuarios ON `profesores-materias`.`cedula_profesor` = `usuarios`.`cedula` 
        INNER JOIN materias ON `profesores-materias`.`id_materia` = `materias`.`id_materia` WHERE `profesores-materias`.`id_materia` = '" . $idMateriaProf . "'";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $this->listarProfesoresMaterias[] = $filas;
        }
        return $this->listarProfesoresMaterias;
    }


    public function setMaterias($nombre, $nivel, $cedulaProfesor)
    {
        $this->nombre = $nombre;
        $this->nivel = $nivel;
        $this->cedulaProfesor = $cedulaProfesor;
    }
    public function setActualizar($idMateria, $nombre, $nivel)
    {
        $this->idMateria = $idMateria;
        $this->nombre = $nombre;
        $this->nivel = $nivel;
    }
}
