<?php

use function PHPSTORM_META\sql_injection_subst;

require_once('clase_conexion.php');

class ecam extends Conectar
{
    private $conexion;
    private $idMateria;
    private $idMateriaSeccion;
    private $nombre;
    private $nombreSeccionU;
    private $nombreSeccion;
    private $nivel;
    private $nivelSeccion;
    private $nivelSeccionU;
    private $cedulaProfesor;
    private $cedulaProfSeccion;
    private $cedulaEstSeccion;
    private $listarMaterias;
    private $listarMateriasNivel;
    private $listarProfesoresMaterias;
    private $listarEstudiantesOFF;
    private $listarEstudiantesON;
    private $listarSeccionesON;
    private $listarProfesores_SM;
    private $materiasBuscadas;
    private $todosProfesores;
    private $todosProfesores2;


    public function __construct()
    {
        $this->conexion = parent::conexion();
    }

    //LISTAR ESTUDIANTES DISPONIBLES PARA INSCRIBIR
    public function listarEstudiantes()
    {

        $sql = "SELECT cedula,codigo,nombre,apellido FROM usuarios WHERE `id_seccion`IS NULL";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->listarEstudiantesOFF[] = $filas;
        }
        return $this->listarEstudiantesOFF;
    }

    //LISTAR PROFESORES TODOS LOS PROFESORES
    public function listarProfesores()
    {
        //Recordar agregar el status_profesor = 1 cuando termines este apartado, ya que no esta filtrando
        $sql = "SELECT cedula,codigo,nombre,apellido,telefono FROM usuarios";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->todosProfesores[] = $filas;
        }
        return $this->todosProfesores;
    }

    //LISTAR TODAS LAS SECCIONES ACTIVAS
    public function listarSeccionesON()
    {
        $sql = "SELECT * FROM `secciones` WHERE `status_seccion` = 1";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->listarSeccionesON[] = $filas;
        }
        return $this->listarSeccionesON;
    }

    //LISTAR TODOS LOS ESTUDIANTES ACTIVOS EN SECCIONES
    public function listarEstudiantesON($idSeccionConsulta)
    {
        $sql = "SELECT `cedula`, `codigo`, `nombre`, `apellido` FROM `usuarios` WHERE `usuarios`.`id_seccion` = $idSeccionConsulta";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->listarEstudiantesON[] = $filas;
        }
        return $this->listarEstudiantesON;
    }

    //LISTAR LOS PROFESORES QUE NO ESTEN ASIGNADOS A X MATERIA
    public function listarSelectProfesores($idNoMateria)
    {

        $sql = "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `materias`.`id_materia` FROM `usuarios`, `materias` 
        WHERE NOT EXISTS (SELECT * FROM `profesores-materias` 
        WHERE `usuarios`.`cedula` = `profesores-materias`.`cedula_profesor` 
        AND `profesores-materias`.`id_materia` = $idNoMateria) AND `materias`.`id_materia` = $idNoMateria AND `usuarios`.`status_profesor` = '1'";

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

    //ELIMINAR PROFESORES DE LAS MATERIAS
    public function desvincularProfesor($cedulaProfDV, $idMateriaDV)
    {
        $sql = "DELETE FROM `profesores-materias` 
        WHERE `profesores-materias`.`cedula_profesor` = $cedulaProfDV 
        AND `profesores-materias`.`id_materia` = $idMateriaDV";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute();
    }


    //CANTIDAD DE FILAS POR NIVELES PARA GENERAR SELECT
    public function cantidadFilasNiveles($nivel)
    {
        $sql = "SELECT `id_materia`, `nombre`, `nivelDoctrina` FROM `materias` WHERE nivelDoctrina = :nivelSeleccionado";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            "nivelSeleccionado" => $nivel,
        ));
        $filas= $stmt->rowCount();

        return $filas;
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

    //LISTAR MATERIAS POR NIVEL SELECCIONADO
    public function listarMateriasNivel($nivel)
    {
        $sql = "SELECT `id_materia`, `nombre`, `nivelDoctrina` FROM `materias` WHERE `nivelDoctrina` = :nivelSeleccionado";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":nivelSeleccionado" => $nivel,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->listarMateriasNivel[] = $filas;
        }
        return $this->listarMateriasNivel;
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

    

    ///////////////CREAR SECCIONES/////////////
    public function crearSeccion()
    {
        $sql= "INSERT INTO `secciones` (`id_seccion`, `nombre`, `nivel_doctrina`, `status_seccion`, `fecha_creacion`) 
        VALUES (NULL, :nomSeccion, :nivDoc, '1', current_timestamp())";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":nomSeccion" => $this->nombreSeccion,
            ":nivDoc" => $this->nivelSeccion,
        ));

        //AGREGANDO ESTUDIANTES A LA SECCION
        foreach ($this->cedulaEstSeccion as $cedulaEst) {
            $sql2= "UPDATE `usuarios` SET `id_seccion` = (SELECT MAX(id_seccion) FROM secciones) WHERE `usuarios`.`cedula` = :cedulaEst";
            $stmt2 = $this->conexion->prepare($sql2);
            $stmt2->execute(array(
                ":cedulaEst" => $cedulaEst,
            ));
        } //Fin del  Foreach
        //Estudiantes vinculados con la seccion
        
        $sql4 = ("SELECT MAX(id_seccion) AS id FROM secciones");

        $stmt4 = $this->conexion()->prepare($sql4);
        $stmt4->execute(array());
        $contador= $stmt4->fetch(PDO::FETCH_ASSOC);
        $id= $contador['id'];

        foreach ($this->idMateriaSeccion as $key) {
            $idSec[]= $key;
        }
        foreach ($this->cedulaProfSeccion as $key2) {
            $idP[]= $key2;
        }

        //AGREGANDO MATERIAS CON LOS PROFESORES
        for ($i=0; $i < count($this->idMateriaSeccion); $i++) { 
            $sql3= "INSERT INTO `secciones-materias-profesores` (`id_seccion`, `id_materia`, `cedulaProf`) VALUES (:idSec, :idMat, :ciProf)";
            $stmt3 = $this->conexion->prepare($sql3);
            $stmt3->execute(array(
                ":idSec" => $id,
                ":idMat" => $idSec[$i],
                ":ciProf" => $idP[$i],
            ));
            
        }
            
    }//FIN DEL CREAR SECCION



    //LISTAR PROFESORES DE LA SECCION POR MATERIA
    public function listarProfesores_seccionMateria($idSeccionProfConsulta)
    {
        $sql="SELECT `materias`.`id_materia`, `materias`.`nombre` AS `nombreMateria`, `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` FROM `secciones-materias-profesores` AS `smp` 
        INNER JOIN `usuarios` ON `smp`.`cedulaProf` = `usuarios`.`cedula` 
        INNER JOIN `materias` ON `smp`.`id_materia` = `materias`.`id_materia` WHERE `smp`.`id_seccion` = :idSeccionProfComsulta";

        $stmt= $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":idSeccionProfComsulta" => $idSeccionProfConsulta,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->listarProfesores_SM[] = $filas;
        }
        return $this->listarProfesores_SM;
    }

    //AGREGANDO O ACTUALIZANDO MAS ESTUDIANTES A LA SECCION SELECCIONADA
    public function agregandoMasEstudiantes($estudiantesNuevos, $idSeccionVincular)
    {
        foreach ($estudiantesNuevos as $estNuevo) {
        $sql= "UPDATE `usuarios` SET `id_seccion` = :seccionVincular WHERE `usuarios`.`cedula` = :cedulaEstNuevo";
        $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(
                ":seccionVincular" => $idSeccionVincular,
                ":cedulaEstNuevo" => $estNuevo,
            ));
        }//FIN DEL FOREACH
        //ESTUDIANTES NUEVOS VINCULADOS A LA SECCION
    }

    //ELIMINAR O DESACTIVAR LA SECCION SELECCIONADA
    public function eliminarSeccion($idSeccionEliminar)
    {
        $sql= "UPDATE `secciones` SET `status_seccion` = '0' WHERE `secciones`.`id_seccion` = $idSeccionEliminar";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
    }

    //ELIMINAR ESTUDIANTE DE LA SECCION SELECCIONADA
    public function eliminarEstSeccion($cedulaEstborrar)
    {
        $sql= "UPDATE `usuarios` SET `id_seccion` = NULL WHERE `usuarios`.`cedula` = $cedulaEstborrar";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
    }

    //ACTUALIZAR DATOS DE LA SECCION SELECCIONADA
    public function actualizarDatosSeccion($idSeccionRefU)
    {
        $sql= "UPDATE `secciones` SET `nombre` = :nombreSecU, `nivel_doctrina` = :nivelSecU WHERE `secciones`.`id_seccion` = $idSeccionRefU";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":nombreSecU" => $this->nombreSeccionU,
            ":nivelSecU" => $this->nivelSeccionU,
        ));
    }



    public function setMaterias($nombre, $nivel, $cedulaProfesor)
    {
        $this->nombre = $nombre;
        $this->nivel = $nivel;
        $this->cedulaProfesor = $cedulaProfesor;
    }
    //SET PARA ACTUALIZAR DATOS DE LA MATERIA
    public function setActualizar($idMateria, $nombre, $nivel)
    {
        $this->idMateria = $idMateria;
        $this->nombre = $nombre;
        $this->nivel = $nivel;
    }
    //SET PARA ACTUALIZAR DATOS DE LA SECCION
    public function setActualizarDatosSeccion($nombreSeccionU, $nivelSeccionU)
    {
        $this->nombreSeccionU = $nombreSeccionU;
        $this->nivelSeccionU = $nivelSeccionU;
    }
    public function setSeccion($nombreSeccion, $nivelSeccion, $cedulaProfSeccion, $cedulaEstSeccion, $idMateriaSeccion)
    {
        $this->nombreSeccion = $nombreSeccion;
        $this->nivelSeccion = $nivelSeccion;
        $this->cedulaProfSeccion = $cedulaProfSeccion;
        $this->cedulaEstSeccion = $cedulaEstSeccion;
        $this->idMateriaSeccion = $idMateriaSeccion;
    }
}
