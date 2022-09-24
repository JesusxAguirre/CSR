<?php
require_once('clase_conexion.php');

class ecam extends Conectar
{
    private $conexion;
    private $idMateria;
    private $idMateriaSeccion;
    private $idMateriaAdicional;
    private $nombre;
    private $nombreSeccionU;
    private $nombreSeccion;
    private $nivel;
    private $nivelSeccion;
    private $nivelSeccionU;
    private $cedulaProfesor;
    private $cedulaProfSeccion;
    private $cedulaProfAdicional;
    private $cedulaEstSeccion;
    private $listarMaterias;
    private $listarMateriasNivel;
    private $listarProfesoresMaterias;
    private $listarMateriasOFF; //lista las materias que no estan en la seccion y deberian estar ahi jeje
    private $listarEstudiantesOFF;
    private $listarEstudiantesON;
    private $listarSeccionesON;
    private $listarProfesores_SM;
    private $listar_misMateriasEst; //lista las materias y demas informacion del estudiante activo en la sesion
    private $listar_misMateriasProf; //lista las materias y demas informacion del profesor activo en la sesion
    private $listar_misEstudiantes; //lista todos los estudiantes que maneja el profesor activo en la sesion
    private $listarContenido; // Lista los contenidos del profesor de las materias de sus secciones correspondiente
    private $materiasBuscadas;
    private $todosProfesores;
    private $todosProfesores2;
    private $notaIDseccion; //agregar
    private $notaIDmateria; //agregar
    private $notaCIestudiante; //agregar
    private $nota_miEstudiante; //agregar
    private $notaIDmateria2; //actualizar
    private $notaCIestudiante2; //actualizar
    private $nota_miEstudiante2; //actualizar


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
        AND `profesores-materias`.`id_materia` = $idNoMateria) AND `materias`.`id_materia` = $idNoMateria AND `usuarios`.`status_profesor` = '0'";

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
        $sql = "INSERT INTO materias (nombre, nivelAcademico, fecha_creacion) VALUES (:nom, :nivelD, CURDATE())";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":nom" => $this->nombre,
            ":nivelD" => $this->nivel
        ));

        /*Buscando ultimo ID de la materia agregada para guardar ese valor, luego ese valor es
        introducido en la consulta de aqui abajo para que sea dinamico*/
        foreach ($this->cedulaProfesor as $cedulaP) {
            $sql2 = "INSERT INTO `profesores-materias` (`cedula_profesor`, `id_materia`) VALUES (:cedulaP, (SELECT MAX(id_materia) FROM `materias`))";
            $stmt2 = $this->conexion->prepare($sql2);
            $stmt2->execute(array(
                ":cedulaP" => $cedulaP,
            ));
        } //Fin del  Foreach
        //Profesores vinculados con la materia

        //Agregando status_profesor = 1 a los profesores que se vayan asignando
        foreach ($this->cedulaProfesor as $cedulaProf) {
            $sql3 = "UPDATE `usuarios` SET `status_profesor` = '1' WHERE `usuarios`.`cedula` = :cedulaProf";
            $stmt3 = $this->conexion->prepare($sql3);
            $stmt3->execute(array(
                ":cedulaProf" => $cedulaProf,
            ));
        }//Fin del Foreach
        //Profesores con status 1 activados
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
        $sql = "SELECT `id_materia`, `nombre`, `nivelAcademico` FROM `materias` WHERE nivelAcademico = :nivelSeleccionado";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            "nivelSeleccionado" => $nivel,
        ));
        $filas = $stmt->rowCount();

        return $filas;
    }

    //LISTAR TODAS LAS MATERIAS
    public function listarMaterias()
    {
        $sql = "SELECT id_materia, nombre, nivelAcademico FROM materias";

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
        $sql = "SELECT `id_materia`, `nombre`, `nivelAcademico` FROM `materias` WHERE `nivelAcademico` = :nivelSeleccionado";

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
        $sql = "SELECT id_materia, nombre, nivelAcademico FROM materias WHERE nombre LIKE '%" . $busqueda . "%' 
        OR nivelAcademico LIKE '%" . $busqueda . "%'";

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
        $sql = "UPDATE `materias` SET `nombre` = :nom, `nivelAcademico` = :nivelD WHERE `materias`.`id_materia` = :idMa";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":idMa" => $this->idMateria,
            ":nom" => $this->nombre,
            ":nivelA" => $this->nivel
        ));
    }

    //LISTAR PROFESORES DE LAS MATERIAS
    public function listarProfesoresMateria($idMateriaProf)
    {

        $sql = "SELECT `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `profesores-materias`.`cedula_profesor`, `profesores-materias`.`id_materia` 
        FROM `profesores-materias` INNER JOIN usuarios ON `profesores-materias`.`cedula_profesor` = `usuarios`.`cedula` 
        INNER JOIN materias ON `profesores-materias`.`id_materia` = `materias`.`id_materia` WHERE `profesores-materias`.`id_materia` = :idMateria";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            "idMateria" => $idMateriaProf,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $this->listarProfesoresMaterias[] = $filas;
        }
        return $this->listarProfesoresMaterias;
    }



    ///////////////CREAR SECCIONES/////////////
    public function crearSeccion()
    {
        $sql = "INSERT INTO `secciones` (`id_seccion`, `nombre`, `nivel_academico`, `status_seccion`, `fecha_creacion`) 
        VALUES (NULL, :nomSeccion, :nivAc, '1', CURDATE())";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":nomSeccion" => $this->nombreSeccion,
            ":nivAc" => $this->nivelSeccion,
        ));

        //AGREGANDO ESTUDIANTES A LA SECCION
        foreach ($this->cedulaEstSeccion as $cedulaEst) {
            $sql2 = "UPDATE `usuarios` SET `id_seccion` = (SELECT MAX(id_seccion) FROM secciones) WHERE `usuarios`.`cedula` = :cedulaEst";
            $stmt2 = $this->conexion->prepare($sql2);
            $stmt2->execute(array(
                ":cedulaEst" => $cedulaEst,
            ));
        } //Fin del  Foreach
        //Estudiantes vinculados con la seccion

        $sql4 = ("SELECT MAX(id_seccion) AS id FROM secciones");

        $stmt4 = $this->conexion()->prepare($sql4);
        $stmt4->execute(array());
        $contador = $stmt4->fetch(PDO::FETCH_ASSOC);
        $id = $contador['id'];

        foreach ($this->idMateriaSeccion as $key) {
            $idSec[] = $key;
        }
        foreach ($this->cedulaProfSeccion as $key2) {
            $idP[] = $key2;
        }

        //AGREGANDO MATERIAS CON LOS PROFESORES
        for ($i = 0; $i < count($this->idMateriaSeccion); $i++) {
            $sql3 = "INSERT INTO `secciones-materias-profesores` (`id_seccion`, `id_materia`, `cedulaProf`) VALUES (:idSec, :idMat, :ciProf)";
            $stmt3 = $this->conexion->prepare($sql3);
            $stmt3->execute(array(
                ":idSec" => $id,
                ":idMat" => $idSec[$i],
                ":ciProf" => $idP[$i],
            ));
        }
    } //FIN DEL CREAR SECCION



    //LISTAR PROFESORES DE LA SECCION POR MATERIA
    public function listarProfesores_seccionMateria($idSeccionProfConsulta)
    {
        $sql = "SELECT `materias`.`id_materia`, `materias`.`nombre` AS `nombreMateria`, `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` FROM `secciones-materias-profesores` AS `smp` 
        INNER JOIN `usuarios` ON `smp`.`cedulaProf` = `usuarios`.`cedula` 
        INNER JOIN `materias` ON `smp`.`id_materia` = `materias`.`id_materia` WHERE `smp`.`id_seccion` = :idSeccionProfComsulta";

        $stmt = $this->conexion->prepare($sql);
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
            $sql = "UPDATE `usuarios` SET `id_seccion` = :seccionVincular WHERE `usuarios`.`cedula` = :cedulaEstNuevo";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(
                ":seccionVincular" => $idSeccionVincular,
                ":cedulaEstNuevo" => $estNuevo,
            ));
        } //FIN DEL FOREACH
        //ESTUDIANTES NUEVOS VINCULADOS A LA SECCION
    }

    //ELIMINAR O DESACTIVAR LA SECCION SELECCIONADA
    public function eliminarSeccion($idSeccionEliminar)
    {
        //ELIMINA O DESACTIVA LA SECCION PRIMERO
        $sql = "UPDATE `secciones` SET `status_seccion` = '0' WHERE `secciones`.`id_seccion` = $idSeccionEliminar";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        //LUEGO DEJAMOS EN NULL EL ID_SECCION DE LOS ESTUDIANTES QUE ESTABAN VINCULADOS A LA SECCION
        $sql2 = "UPDATE `usuarios` SET `id_seccion`= NULL WHERE `usuarios`.`cedula` IN (SELECT `usuarios`.`cedula` FROM usuarios WHERE `usuarios`.`id_seccion` = :idSeccionOFF)";
        $stmt2 = $this->conexion->prepare($sql2);
        $stmt2->execute(array(
            ":idSeccionOFF" => $idSeccionEliminar,
        ));
    }

    //ELIMINAR ESTUDIANTE DE LA SECCION SELECCIONADA
    public function eliminarEstSeccion($cedulaEstborrar)
    {
        $sql = "UPDATE `usuarios` SET `id_seccion` = NULL WHERE `usuarios`.`cedula` = $cedulaEstborrar";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
    }

    //ACTUALIZAR DATOS DE LA SECCION SELECCIONADA
    public function actualizarDatosSeccion($idSeccionRefU)
    {
        $sql = "UPDATE `secciones` SET `nombre` = :nombreSecU, `nivel_academico` = :nivelSecU WHERE `secciones`.`id_seccion` = $idSeccionRefU";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":nombreSecU" => $this->nombreSeccionU,
            ":nivelSecU" => $this->nivelSeccionU,
        ));
    }

    //SELECT DE LAS MATERIAS QUE NO ESTAN EN LA SECCION PARA AGREGAR
    public function selectMateriasOFF($idSeccionReferencial, $nivDoctrinaReferencial)
    {
        $sql = "SELECT `materias`.`id_materia`, `materias`.`nombre`, `materias`.`nivelAcademico` FROM `materias` WHERE NOT EXISTS (SELECT * FROM `secciones-materias-profesores` 
        WHERE `secciones-materias-profesores`.`id_materia` = `materias`.`id_materia` 
        AND `secciones-materias-profesores`.`id_seccion` = :idSeccionRef) AND `materias`.`nivelAcademico` = :nivelDoctrinaRef";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":idSeccionRef" => $idSeccionReferencial,
            ":nivelDoctrinaRef" => $nivDoctrinaReferencial,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->listarMateriasOFF[] = $filas;
        }
        return $this->listarMateriasOFF;
    }

    //AGREGAR O AGREGAR MATERIAS CON PROFESORES ADICIONALES A LA SECCION SELECCIONADA
    public function actualizarMateriasProfesores($idSeccion)
    {
        $sql = "INSERT INTO `secciones-materias-profesores` (`id_seccion`, `id_materia`, `cedulaProf`, `contenido`) VALUES (:idSeccion, :idMateria, :cedulaProf, NULL)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":idSeccion" => $idSeccion,
            ":idMateria" => $this->idMateriaAdicional,
            ":cedulaProf" => $this->cedulaProfAdicional,
        ));
    }

    //ELIMINAR MATERIAS Y PROFESORES DE LA SECCION SELECCIONADA
    public function eliminarMateriaProf_seccion($idSeccionMatProfSec, $idMateriaSec, $cedulaProfSec)
    {
        $sql = "DELETE FROM `secciones-materias-profesores` WHERE `secciones-materias-profesores`.`id_seccion` = :idSeccion 
        AND `secciones-materias-profesores`.`id_materia`= :idMateria 
        AND `secciones-materias-profesores`.`cedulaProf`= :cedulaProf";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(
            ":idSeccion" => $idSeccionMatProfSec,
            ":idMateria" => $idMateriaSec,
            ":cedulaProf" => $cedulaProfSec,
        ));
    }


    //LISTAR LAS MATERIAS QUE LE CORRESPONDE AL ESTUDIANTE ACTIVO DE LA ECAM
    public function listar_misMateriasEst()
    {
        $idSeccionEstudiante = $_SESSION['id_seccion']; //Aqui acapta la id_seccion del usuario activo jeje

        $sql = "SELECT `smp`.`id_seccion`, `materias`.`id_materia`, `usuarios`.`cedula`, `materias`.`nombre` as `nombreMateria`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` 
        FROM `secciones-materias-profesores` AS `smp` INNER JOIN `materias` ON `materias`.`id_materia` = `smp`.`id_materia` 
        INNER JOIN `usuarios` ON `usuarios`.`cedula` = `smp`.`cedulaProf` WHERE `smp`.`id_seccion` = :idSeccion";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":idSeccion" => $idSeccionEstudiante,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->listar_misMateriasEst[] = $filas;
        }
        return $this->listar_misMateriasEst;
    }

    //LISTAR MATERIAS QUE IMPARTE EL PROFESOR ACTIVO DE LA ECAM
    public function listar_misMateriasProf()
    {
        $cedulaProfesor = $_SESSION['cedula']; //Aqui capta la cedula del profesor activo jeje

        $sql = "SELECT `materias`.`id_materia`, `secciones`.`id_seccion`, `secciones`.`nombre` AS `nombreSeccion`, `materias`.`nombre` AS `nombreMateria`, `materias`.`nivelAcademico`, `usuarios`.`cedula`, 
        `usuarios`.`nombre` as `nombreProfesor`, `usuarios`.`apellido` as `apellidoProfesor`, `smp`.`contenido`
        FROM `secciones-materias-profesores` AS `smp` INNER JOIN `materias` ON `smp`.`id_materia` = `materias`.`id_materia` 
        INNER JOIN `usuarios` ON `smp`.`cedulaProf` = `usuarios`.`cedula` INNER JOIN `secciones` ON `smp`.`id_seccion` = `secciones`.`id_seccion` WHERE `smp`.`cedulaProf` = :cedulaProfesor";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array(
            ":cedulaProfesor" => $cedulaProfesor,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listar_misMateriasProf[] = $filas;
        }
        return $this->listar_misMateriasProf;
    }

    //AGREGAR O SUBIR CONTENIDOS A LAS MATERIAS DEL PROFESOR ACTIVO
    public function agregarContenidos($seccionContRef, $materiaContRef, $contenido)
    {
        $cedulaProfesor = $_SESSION['cedula']; //Aqui capta la cedula del profesor activo jeje

        $sql = "UPDATE `secciones-materias-profesores` SET `contenido`= :contenido WHERE `secciones-materias-profesores`.`id_seccion` = :idSeccionProf 
        AND `secciones-materias-profesores`.`id_materia` = :idMateriaProf AND `secciones-materias-profesores`.`cedulaProf` = :cedulaProfesor";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":contenido" => $contenido,
            ":idSeccionProf" => $seccionContRef,
            ":idMateriaProf" => $materiaContRef,
            ":cedulaProfesor" => $cedulaProfesor,
        ));
    }

    //LISTAR CONTENIDOS DE LAS MATERIAS PROFESORES
    public function listarContenido($idSeccion, $idMateria)
    {
        $cedulaProfesor = $_SESSION['cedula']; //Aqui capta la cedula del profesor activo jeje

        $sql = "SELECT `secciones-materias-profesores`.`contenido` FROM `secciones-materias-profesores` 
       WHERE `secciones-materias-profesores`.`id_seccion` = :idSeccionProf AND `secciones-materias-profesores`.`id_materia`= :idMateriaProf 
       AND `secciones-materias-profesores`.`cedulaProf` = :cedulaProfesor";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":idSeccionProf" => $idSeccion,
            ":idMateriaProf" => $idMateria,
            ":cedulaProfesor" => $cedulaProfesor,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->listarContenido[] = $filas;
        }
        return $this->listarContenido;
    }

    //LISTAR MATERIAS QUE IMPARTE EL PROFESOR ACTIVO DE LA ECAM
    public function listar_misEstudiantes()
    {
        $cedulaProfesor = $_SESSION['cedula']; //Aqui capta la cedula del profesor activo jeje

        /*$sql = "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `materias`.`nombre` as `nombreMateria`, `materias`.`nivelDoctrina`, `materias`.`id_materia`, 
        `secciones`.`id_seccion`, `secciones`.`nombre` AS `nombreSeccion` FROM `secciones-materias-profesores` AS `smp` INNER JOIN `usuarios` ON `smp`.`id_seccion` = `usuarios`.`id_seccion` INNER JOIN `materias` ON `smp`.`id_materia`= `materias`.`id_materia`
        INNER JOIN `secciones` ON `smp`.`id_seccion` = `secciones`.`id_seccion` WHERE `smp`.`cedulaProf`= :cedulaProfesor";*/

        $sql= "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `materias`.`nombre` 
        AS `nombreMateria`, `materias`.`nivelAcademico`, `materias`.`id_materia`, `secciones`.`id_seccion`, `secciones`.`nombre` 
        AS `nombreSeccion`, `nme`.`nota` FROM `secciones-materias-profesores` AS `smp` INNER JOIN `usuarios` ON `smp`.`id_seccion` = `usuarios`.`id_seccion` 
        INNER JOIN `materias` ON `smp`.`id_materia` = `materias`.`id_materia` INNER JOIN `secciones` ON `smp`.`id_seccion` = `secciones`.`id_seccion` 
        LEFT JOIN notamateria_estudiantes AS nme ON `nme`.`cedula` = `usuarios`.`cedula` AND `nme`.`id_seccion` = `smp`.`id_seccion` AND `nme`.`id_materia` = `materias`.`id_materia` WHERE `smp`.`cedulaProf` = :cedulaProfesor";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":cedulaProfesor" => $cedulaProfesor,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


            $this->listar_misEstudiantes[] = $filas;
        }
        return $this->listar_misEstudiantes;
    }

    //AGREGAR LAS NOTAS DE LAS MATERIAS A LOS ESTUDIANTES
    public function agregarNotaMateria($nota)
    {
        $sql = "INSERT INTO `notamateria_estudiantes` (`id_seccion`, `cedula`, `id_materia`, `nota`, `fecha_agregado`) 
        VALUES (:notaIDseccion, :notaCIestudiante, :notaIDmateria, :nota, CURDATE())";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":notaIDseccion" => $this->notaIDseccion,
            ":notaCIestudiante" => $this->notaCIestudiante,
            ":notaIDmateria" => $this->notaIDmateria,
            ":nota" => $nota,
        ));
    }

    //ACTUALIZAR LA NOTA DEL ESTUDIANTE SELECCIONADO DEL PROFESOR ACTIVO EN LA SESION
    public function actualizarNotaMateria($notaNueva)
    {
        $sql = "UPDATE `notamateria_estudiantes` SET `nota`=:notaNueva, `fecha_agregado`= CURDATE() 
        WHERE cedula = :notaCIestudiante AND id_seccion = :notaIDseccion AND id_materia = :notaIDmateria";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":notaIDseccion" => $this->notaIDseccion2,
            ":notaCIestudiante" => $this->notaCIestudiante2,
            ":notaIDmateria" => $this->notaIDmateria2,
            ":notaNueva" => $notaNueva,
        ));
    }

    //ELIMINAR LA NOTA DEL ESTUDIANTE SELECCIONADO POR EL PROFESOR ACTIVO EN LA SESION
    public function eliminarNotaMateria($cedulaEstudianteRef2, $idMateriaRef2, $idSeccionRef2)
    {
        $sql = "DELETE FROM `notamateria_estudiantes` WHERE id_seccion = :idSeccionRef2 AND cedula = :cedulaEstudianteRef2 AND id_materia = :idMateriaRef2";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":idSeccionRef2" => $idSeccionRef2,
            ":cedulaEstudianteRef2" => $cedulaEstudianteRef2,
            ":idMateriaRef2" => $idMateriaRef2,
        ));
    }

    //MOSTRAR LA NOTA DE LA MATERIA DEL ESTUDIANTE SELECCIONADO
    public function listarNota_miEstudiante($notaIDmateria, $notaIDseccion, $notaCIestudiante)
    {
        $sql = "SELECT `nota` FROM `notamateria_estudiantes` as `nme` WHERE `nme`.`id_seccion` = :notaIDseccionRef 
        AND `nme`.`id_materia` = :notaIDmateriaRef AND `nme`.`cedula`= :notaCIestudianteRef";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":notaIDseccionRef" => $notaIDseccion,
            ":notaCIestudianteRef" => $notaCIestudiante,
            ":notaIDmateriaRef" => $notaIDmateria,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->nota_miEstudiante[] = $filas;
        }
        return $this->nota_miEstudiante;
    }














    ///////////////////////METODOS SETTERS/////////////////////////
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
    //SET PARA ACTUALIZAR LAS MATERIAS Y PROFESORES DE LA SECCION
    public function setActualizarMP($idMateriaAdicional, $cedulaProfAdicional)
    {
        $this->idMateriaAdicional = $idMateriaAdicional;
        $this->cedulaProfAdicional = $cedulaProfAdicional;
    }
    //SET PARA CREAR UNA SECCION
    public function setSeccion($nombreSeccion, $nivelSeccion, $cedulaProfSeccion, $cedulaEstSeccion, $idMateriaSeccion)
    {
        $this->nombreSeccion = $nombreSeccion;
        $this->nivelSeccion = $nivelSeccion;
        $this->cedulaProfSeccion = $cedulaProfSeccion;
        $this->cedulaEstSeccion = $cedulaEstSeccion;
        $this->idMateriaSeccion = $idMateriaSeccion;
    }
    //SET PARA AGREGAR NOTAS A LOS ESTUDIANTES DEL PROFESOR ACTIVO EN LA SESION
    public function setNotaMateriaEstudiante($notaIDseccion, $notaIDmateria, $notaCIestudiante)
    {
        $this->notaIDseccion = $notaIDseccion;
        $this->notaIDmateria = $notaIDmateria;
        $this->notaCIestudiante = $notaCIestudiante;
    }
    //SET PARA ACTUALIZAR LAS NOTAS DE LOS ESTUDIANTES DEL PROFESOR ACTIVO EN LA SESION
    public function setActualizarMateriaEstudiante($notaIDseccion2, $notaIDmateria2, $notaCIestudiante2)
    {
        $this->notaIDseccion2 = $notaIDseccion2;
        $this->notaIDmateria2 = $notaIDmateria2;
        $this->notaCIestudiante2 = $notaCIestudiante2;
    }
}
