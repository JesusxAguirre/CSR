<?php

namespace Csr\Modelo;

use Csr\Modelo\Conexion;
use PDO;
use Exception;

class ecam extends Conexion
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
    private $fechaCierreRefU;
    private $fechaCierreSeccion;
    private $cedulaProfesor;
    private $cedulaProfSeccion;
    private $cedulaProfAdicional;
    private $cedulaEstSeccion;
    private $listarMateriasNivel;
    private $listarMateriasOFF; //lista las materias que no estan en la seccion y deberian estar ahi jeje
    private $listarEstudiantesON;
    private $listarSeccionesON;
    private $listarProfesores_SM;
    private $listar_misMateriasEst; //lista las materias y demas informacion del estudiante activo en la sesion
    private $listar_misMateriasProf; //lista las materias y demas informacion del profesor activo en la sesion
    private $listar_misEstudiantes; //lista todos los estudiantes que maneja el profesor activo en la sesion
    private $materiasBuscadas;
    private $todosProfesores;
    private $todosProfesores2;
    private $notaIDseccion; //agregar
    private $notaIDmateria; //agregar
    private $notaCIestudiante; //agregar
    private $notaIDmateria2; //actualizar
    private $notaIDseccion2;
    private $notaCIestudiante2; //actualizar
    private $nota_miEstudiante2; //actualizar

    private $id_modulo;

    public function __construct()
    {
        $this->conexion = parent::conexion();
        $this->id_modulo = 3;
    }


    //REGISTRAR NOTIFICACIONES PARA ESTUDIANTES DE LA ECAM POR SECCIONES
    public function registrar_notificacionSeccion($seccion, $accion, $cedulaEst)
    {
        $cedula = $_SESSION['cedula'];

        if (!empty($cedulaEst)) {
            $sql = "INSERT INTO notificaciones_estudiantes (id_seccion, cedula_estudiante, accion, fecha, hora_registro) 
            VALUES(:idSeccion, :cedulaEstudiante, :accion, CURDATE(), CURTIME())";

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(
                array(
                    ":idSeccion" => $seccion,
                    ":cedulaEstudiante" => $cedulaEst,
                    ":accion" => $accion
                )
            );
        } else {
            $sql = "INSERT INTO notificaciones_estudiantes (id_seccion, accion, fecha, hora_registro) 
            VALUES(:idSeccion, :accion, CURDATE(), CURTIME())";

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(
                array(
                    ":idSeccion" => $seccion,
                    ":accion" => $accion
                )
            );
        }
    }
    public function listar_notificacionSeccion()
    {
        $filas1 = [];
        $seccion = $_SESSION['id_seccion'];
        $cedulaEst = $_SESSION['cedula'];

        $sql = "SELECT * FROM `notificaciones_estudiantes` WHERE `id_seccion` = $seccion AND `cedula_estudiante` = $cedulaEst 
        OR `cedula_estudiante` IS NULL ORDER BY `notificaciones_estudiantes`.`hora_registro` DESC LIMIT 6";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $filas1[] = $filas;
        }
        return $filas1;
    }
    public function listar_notificacionSeccion2()
    {
        $filas1 = [];
        $seccion = $_SESSION['id_seccion'];
        $cedula = $_SESSION['cedula'];

        $sql = "SELECT * FROM `notificaciones_estudiantes` WHERE `id_seccion` = $seccion AND `cedula_estudiante` = $cedula
        OR `cedula_estudiante` IS NULL ORDER BY `notificaciones_estudiantes`.`hora_registro` DESC";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $filas1[] = $filas;
        }

        $id_modulo = 12;
        $accion = 'El usuario ha revisado sus notificaciones';
        parent::registrar_bitacora($cedula, $accion, $id_modulo);
        return $filas1;
    }
    //REGISTRAR NOTIFICACIONES PARA PROFESORES DE LA ECAM
    public function registrar_notificacionProfesor($mensaje, $cedulaProf)
    {
        $sql = "INSERT INTO notificaciones_profesores (cedula_profesor, mensaje, fecha_registro, hora_registro) 
        VALUES(:cedulaProfesor, :mensaje, CURDATE(), CURTIME())";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(
            array(
                ":cedulaProfesor" => $cedulaProf,
                ":mensaje" => $mensaje,
            )
        );
    }
    public function listar_notificacionProfesores()
    {
        $filas1 = [];
        $cedula = $_SESSION['cedula'];

        $sql = "SELECT * FROM `notificaciones_profesores` WHERE `cedula_profesor` = $cedula 
        OR `cedula_profesor` IS NULL ORDER BY `notificaciones_profesores`.`hora_registro` DESC LIMIT 6";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $filas1[] = $filas;
        }
        return $filas1;
    }
    public function listar_notificacionProfesores2()
    {
        $filas1 = [];
        $cedula = $_SESSION['cedula'];

        $sql = "SELECT * FROM `notificaciones_profesores` WHERE `cedula_profesor` = $cedula 
        OR `cedula_profesor` IS NULL ORDER BY `notificaciones_profesores`.`hora_registro` DESC";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $filas1[] = $filas;
        }

        $id_modulo = 12;
        $accion = 'El usuario ha revisado sus notificaciones';
        parent::registrar_bitacora($cedula, $accion, $id_modulo);
        return $filas1;
    }







    //LISTAR ESTUDIANTES DISPONIBLES PARA INSCRIBIR
    public function listarEstudiantes()
    {
        $listarEstudiantesOFF = [];
        $sql = "SELECT cedula,codigo,nombre,apellido FROM usuarios WHERE `id_seccion`IS NULL AND `status_profesor` = 0";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $listarEstudiantesOFF[] = $filas;
        }
        return $listarEstudiantesOFF;
    }

    //CANTIDAD DE PROFESORES EN LA ECAM
    public function cantidadProfesores()
    {
        try {
            $sql = "SELECT * FROM `usuarios` WHERE `status_profesor` = 1";
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array());
            $cantidad = $stmt->rowCount();

            return $cantidad;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //CANTIDAD DE ESTUDIANTES EN LA ECAM
    public function cantidadEstudiantes()
    {
        try {
            $sql = "SELECT * FROM `usuarios` WHERE `id_seccion` IS NOT NULL AND `status_profesor` = 0";
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array());
            $cantidad = $stmt->rowCount();

            return $cantidad;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }




    //AGREGAR NOTAS FINALES A LOS ESTUDIANTES
    public function agregar_notaFinal($seccion, $cedula, $notaFinal, $nivelAcademico)
    {
        $sql = "INSERT INTO `notafinal_estudiantes` (`id_seccion`, `cedulaEstudiante`, `notaFinal`, `nivelAcademico`, `fecha_agregada`) VALUES ($seccion, $cedula, $notaFinal, $nivelAcademico, CURDATE())";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        $accion = "Ha agregado una nota final a un estudiante del nivel $nivelAcademico";
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

        $accion2 = "Ya tienes tu nota final del curso. Podras verla cuando activen el boletin de nota";
        $this->registrar_notificacionSeccion($seccion, $accion2, $cedula);
    }
    public function eliminar_notaFinal($seccion, $cedula, $nivelAcademico)
    {
        $sql = "DELETE FROM `notafinal_estudiantes` WHERE `cedulaEstudiante` = $cedula AND `id_seccion` = $seccion";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        $accion = "Se ha eliminado una nota final a un estudiante del nivel $nivelAcademico";
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);
    }
    //LISTAR NOTAS FINALES DE LOS ESTUDIANTES
    public function listarEstudiantes_notaFinal()
    {
        $estudiantes = [];
        $sql = "SELECT `secciones`.`id_seccion`, `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `secciones`.`nombre` AS `nombreSeccion`, `secciones`.`nivel_academico`, IFNULL(`nte`.`notaFinal`, '0') AS `notaFinal` 
        FROM `usuarios` INNER JOIN `secciones` ON `secciones`.`id_seccion` = `usuarios`.`id_seccion` LEFT JOIN `notaFinal_estudiantes` AS `nte` ON `nte`.`id_seccion` = `usuarios`.`id_seccion` AND `nte`.`cedulaEstudiante` = `usuarios`.`cedula`";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $estudiantes[] = $filas;
        }

        $accion = "Has listado las notas finales de los estudiantes";
        $cedula = $_SESSION['cedula'];
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

        return $estudiantes;
    }
    
    //VER LAS NOTAS DE LAS MATERIAS DEL ESTUDIANTES SELECCIONADO O QUE EL PUEDA VER SUS NOTAS
    public function ver_misNotasMaterias($cedula, $seccion)
    {
        try {
            $notas = [];
            $sql = "SELECT `secciones`.`id_seccion`, `secciones`.`nombre` AS `nombreSeccion`, `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `materias`.`id_materia`, `materias`.`nombre` AS `nombreMateria`, `materias`.`nivelAcademico`, IFNULL(`nme`.`nota`, '0') AS `nota` 
            FROM `usuarios` INNER JOIN `secciones-materias-profesores` AS `smp` ON `smp`.`id_seccion` = `usuarios`.`id_seccion` 
            INNER JOIN secciones ON `usuarios`.`id_seccion` = `secciones`.`id_seccion` INNER JOIN `materias` ON `smp`.`id_materia` = `materias`.`id_materia` 
            LEFT JOIN `notamateria_estudiantes` AS `nme` ON `nme`.`cedula` = `usuarios`.`cedula` AND `nme`.`id_seccion` = `smp`.`id_seccion` 
            AND `nme`.`id_materia` = `smp`.`id_materia` WHERE `usuarios`.`cedula` = :cedula";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":cedula" => $cedula,
            ));

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $notas[] = $filas;
            }
            return $notas;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }




    //LISTAR ESTUDIANTES SIN NIVEL 1, 2 o 3. Funciona mandando el nivel academico por parametro
    public function sinNivel($n)
    {
        $listarEstudiantes_nivel1 = [];

        //CONSULTA VIEJISIMA (NO SIRVE)
        /*$sql= "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` FROM `usuarios` WHERE `usuarios`.`cedula` 
        NOT IN (SELECT `cedulaEstudiante` FROM `notafinal_estudiantes` WHERE `nivelAcademico` = :nivel AND `notaFinal` >= 12) 
        AND `usuarios`.`status_profesor` = 0  AND `usuarios`.`id_seccion` IS NULL AND `usuarios`.`codigo` LIKE '%N1%'";*/



        //ULTIMA CONSULTA QUE USE PARA RESPALDO SI NO LOGRO DAR CON NADA (OPCIONAL PORQUE ESTA MALA TAMBIEN)
        /*$sql = "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` FROM `usuarios` WHERE `usuarios`.`cedula` 
        NOT IN (SELECT `cedulaEstudiante` FROM `notafinal_estudiantes` WHERE `nivelAcademico` = :nivel AND `notaFinal` >= 16) 
        AND `usuarios`.`status_profesor` = 0  AND `usuarios`.`id_seccion` IS NULL AND `usuarios`.`codigo` LIKE '%N1%'";*/


        switch ($n) {
            case 1:
                $sql = "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` FROM `usuarios` WHERE `usuarios`.`cedula` 
                NOT IN (SELECT `cedulaEstudiante` FROM `notafinal_estudiantes` WHERE `nivelAcademico` = 1 AND `notaFinal` >= 16) 
                AND `usuarios`.`status_profesor` = 0  AND `usuarios`.`id_seccion` IS NULL AND `usuarios`.`codigo` LIKE '%N1%'";

                $stmt = $this->conexion()->prepare($sql);
                $stmt->execute(array());

                while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $listarEstudiantes_nivel1[] = $filas;
                }
                return $listarEstudiantes_nivel1;
            
            case 2:
                $sql = "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` FROM `usuarios` 
                INNER JOIN notafinal_estudiantes as ntf on ntf.cedulaEstudiante = usuarios.cedula and ntf.nivelAcademico = 1 and ntf.notaFinal >= 16 
                INNER JOIN notafinal_estudiantes as ntf2 on ntf2.cedulaEstudiante NOT IN (SELECT cedulaEstudiante FROM notafinal_estudiantes WHERE nivelAcademico = 2 AND notaFinal >= 16)
                WHERE usuarios.id_seccion IS NULL AND usuarios.codigo LIKE '%N1%' GROUP BY cedula";

                $stmt = $this->conexion()->prepare($sql);
                $stmt->execute(array());

                while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $listarEstudiantes_nivel1[] = $filas;
                }
                return $listarEstudiantes_nivel1;

            case 3:
                $sql = "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` FROM `usuarios` 
                INNER JOIN notafinal_estudiantes as ntf on ntf.cedulaEstudiante = usuarios.cedula and ntf.nivelAcademico = 2 and ntf.notaFinal >= 16 
                INNER JOIN notafinal_estudiantes as ntf2 on ntf2.cedulaEstudiante NOT IN (SELECT cedulaEstudiante FROM notafinal_estudiantes WHERE nivelAcademico = 3 AND notaFinal >= 16)
                WHERE usuarios.id_seccion IS NULL AND usuarios.codigo LIKE '%N1%' GROUP BY cedula";

                $stmt = $this->conexion()->prepare($sql);
                $stmt->execute(array());

                while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $listarEstudiantes_nivel1[] = $filas;
                }
                return $listarEstudiantes_nivel1;
        }
    }



    //LISTAR PROFESORES TODOS LOS PROFESORES
    public function listarProfesores()
    {
        $sql = "SELECT `cedula`,`codigo`,`nombre`,`apellido`,`telefono` FROM `usuarios` WHERE `usuarios`.`status_profesor` = 1";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->todosProfesores[] = $filas;
        }
        return $this->todosProfesores;
    }

    public function listarTodos()
    {
        $todos = [];
        $sql = "SELECT `cedula`,`codigo`,`nombre`,`apellido`,`telefono` FROM `usuarios`";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $todos[] = $filas;
        }
        return $todos;
    }

    public function listar_noProfesores()
    {
        $todos = [];
        $sql = "SELECT `cedula`,`codigo`,`nombre`,`apellido`,`telefono` FROM `usuarios` WHERE `usuarios`.`status_profesor` = 0 AND `usuarios`.`id_seccion` IS NULL AND `codigo` LIKE '%N2%'";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $todos[] = $filas;
        }
        return $todos;
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
        $todosProfesores2 = [];
        $sql = "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `materias`.`id_materia` FROM `usuarios`, `materias` 
        WHERE NOT EXISTS (SELECT * FROM `profesores-materias` 
        WHERE `usuarios`.`cedula` = `profesores-materias`.`cedula_profesor` 
        AND `profesores-materias`.`id_materia` = $idNoMateria) AND `materias`.`id_materia` = $idNoMateria AND `usuarios`.`status_profesor` = 1";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $todosProfesores2[] = $filas;
        }
        return $todosProfesores2;
    }


    //Validar que no exista otra materia igual
    function validar_materia($nombre, $nivel)
    {
        $sql = "SELECT * FROM materias WHERE nombre = :nombre AND nivelAcademico = :nivel";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(
            array(
                ":nombre" => $nombre,
                ":nivel" => $nivel,
            )
        );

        $resultado = $stmt->rowCount();
        return $resultado;
    }

    //AGREGAR MATERIAS
    public function agregarMaterias()
    {
        try {
            $sql = "INSERT INTO materias (nombre, nivelAcademico, fecha_creacion) VALUES (:nom, :nivelD, CURDATE())";

            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(
                array(
                    ":nom" => $this->nombre,
                    ":nivelD" => $this->nivel
                )
            );

            /*Buscando ultimo ID de la materia agregada para guardar ese valor, luego ese valor es
        introducido en la consulta de aqui abajo para que sea dinamico*/
            foreach ($this->cedulaProfesor as $cedulaP) {
                $sql2 = "INSERT INTO `profesores-materias` (`cedula_profesor`, `id_materia`) VALUES (:cedulaP, (SELECT MAX(id_materia) FROM `materias`))";
                $stmt2 = $this->conexion->prepare($sql2);
                $stmt2->execute(
                    array(
                        ":cedulaP" => $cedulaP,
                    )
                );
            } //Fin del  Foreach
            //Profesores vinculados con la materia

            $cedula = $_SESSION['cedula'];
            $accion = "Ha agregado una materia nueva llamada " . $this->nombre;
            parent::registrar_bitacora($cedula, $accion, $this->id_modulo);
            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();
        }
    }

    //AGREGAR PROFESORES A LA ECAM (ACTIVAR STATUS PROFESOR)
    public function agregar_profesores($cedulasProfesores)
    {
        try {
            //Agregando status_profesor = 1 a los profesores que se vayan asignando
            foreach ($cedulasProfesores as $cedulaProf) {
                $sql = "UPDATE `usuarios` SET `status_profesor` = 1 WHERE `usuarios`.`cedula` = :cedulaProf";
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute(
                    array(
                        ":cedulaProf" => $cedulaProf,
                    )
                );
            } //Fin del Foreach
            //Profesores con status 1 activados

            //$profesoresAgregados = [];
            foreach ($cedulasProfesores as $cedulaProfA) {
                $sql2 = "SELECT * FROM `usuarios` WHERE `usuarios`.`cedula` = $cedulaProfA";
                $stmt2 = $this->conexion->prepare($sql2);
                $stmt2->execute(array());
                $filas = $stmt2->fetch(PDO::FETCH_ASSOC);

                $cedula = $_SESSION['cedula'];
                $accion = "Ha agregado a " . $filas['codigo'] . " " . $filas['nombre'] . " " . $filas['apellido'] . " como profesor en la ECAM";
                parent::registrar_bitacora($cedula, $accion, $this->id_modulo);
            }
            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();
            return false;
        }
    }

    //ELIMINAR PROFESORES DE LA ECAM
    public function eliminar_profesor($cedulaProfesor)
    {
        try {
            $sql = "UPDATE `usuarios` SET `status_profesor` = '0' WHERE `usuarios`.`cedula` = :cedulaProfesor";
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":cedulaProfesor" => $cedulaProfesor,
            ));

            $sql2 = "DELETE FROM `profesores-materias` WHERE `cedula_profesor` = :cedulaProfesor";
            $stmt2 = $this->conexion()->prepare($sql2);
            $stmt2->execute(array(
                ":cedulaProfesor" => $cedulaProfesor,
            ));

            $sql3 = "DELETE FROM `secciones-materias-profesores` WHERE `cedulaProf` = :cedulaProfesor";
            $stmt3 = $this->conexion()->prepare($sql3);
            $stmt3->execute(array(
                ":cedulaProfesor" => $cedulaProfesor,
            ));

            $sql4 = "SELECT * FROM `usuarios` WHERE `usuarios`.`cedula` = :cedulaProfesor";
            $stmt4 = $this->conexion->prepare($sql4);
            $stmt4->execute(array(
                ":cedulaProfesor" => $cedulaProfesor,
            ));
            $filas = $stmt4->fetch(PDO::FETCH_ASSOC);

            $cedula = $_SESSION['cedula'];
            $accion = "Ha desvinculado a " . $filas['codigo'] . " " . $filas['nombre'] . " " . $filas['apellido'] . " como profesor en la ECAM";
            parent::registrar_bitacora($cedula, $accion, $this->id_modulo);
          
            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //ACTUALIZAR Y VINCULAR PROFESOR CON LA MATERIA
    public function vincularProfesor($cedulaProfesorV, $idMateriaV)
    {
        try {
            //Obteniendo informacion de la materia
            $sql = "SELECT * FROM `materias` WHERE `materias`.`id_materia` = $idMateriaV";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array());
            $infoMateria = $stmt->fetch(PDO::FETCH_ASSOC);

            foreach ($cedulaProfesorV as $cedulaPV) {
                $sql3 = "INSERT INTO `profesores-materias` (`cedula_profesor`, `id_materia`) VALUES (:cedulaProf, :idMateria)";
                $stmt3 = $this->conexion->prepare($sql3);
                $stmt3->execute(
                    array(
                        ":cedulaProf" => $cedulaPV,
                        ":idMateria" => $idMateriaV,
                    )
                );

                $sql4 = "UPDATE `usuarios` SET `status_profesor` = '1' WHERE `usuarios`.`cedula` = :cedulaProfesor";
                $stmt4 = $this->conexion->prepare($sql4);
                $stmt4->execute(
                    array(
                        ":cedulaProfesor" => $cedulaPV,
                    )
                );
            } //Fin del  Foreach
            //Profesores vinculados con la materia
            //Usuarios con status profesor activado


            //Obteniendo informacion del profesor
            foreach ($cedulaProfesorV as $cedula) {
                $sql2 = "SELECT * FROM usuarios WHERE `usuarios`.`cedula` = :cedula";
                $stmt2 = $this->conexion->prepare($sql2);
                $stmt2->execute(array(
                    ":cedula" => $cedula,
                ));
                $infoProfesor = $stmt2->fetch(PDO::FETCH_ASSOC);

                $cedula2 = $_SESSION['cedula'];
                $accion = "Ha vinculado al profesor " . $infoProfesor['codigo'] . " " . $infoProfesor['nombre'] . " " . $infoProfesor['apellido'] . " a la materia " . $infoMateria['nombre'] . " Nivel " . $infoMateria['nivelAcademico'];
                parent::registrar_bitacora($cedula2, $accion, $this->id_modulo);

                $mensaje = 'Te han vinculado con la materia "' . $infoMateria['nombre'] . '" Nivel ' . $infoMateria['nivelAcademico'];
                $this->registrar_notificacionProfesor($mensaje, $cedula);
            }

            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();
            return false;
        }
    }

    //ELIMINAR PROFESORES DE LAS MATERIAS
    public function desvincularProfesor($cedulaProfDV, $idMateriaDV)
    {
        try {
            $sql = "DELETE FROM `profesores-materias` 
            WHERE `profesores-materias`.`cedula_profesor` = :cedulaProf 
            AND `profesores-materias`.`id_materia` = :idMateria";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":cedulaProf" => $cedulaProfDV,
                    ":idMateria" => $idMateriaDV,
                )
            );

            //DESVINCULANDO PROFESORES DE LAS SECCION A LA QUE FUE ASIGNADA SU MATERIA Y PRESENCIA
            $sql2 = "DELETE FROM `secciones-materias-profesores` WHERE `id_materia` = :idmateria AND `cedulaProf` = :cedulaProfesor";
            $stmt2 = $this->conexion()->prepare($sql2);
            $stmt2->execute(
                array(
                    ":idmateria" => $idMateriaDV,
                    ":cedulaProfesor" => $cedulaProfDV,
                )
            );

            //Obteniendo informacion de la materia
            $sql3 = "SELECT * FROM materias WHERE `materias`.`id_materia` = :idMateria";
            $stmt3 = $this->conexion->prepare($sql3);
            $stmt3->execute(
                array(
                    ":idMateria" => $idMateriaDV,
                )
            );
            $infoMateria = $stmt3->fetch(PDO::FETCH_ASSOC);

            //Obteniendo informacion del profesor
            $sql4 = "SELECT * FROM usuarios WHERE `usuarios`.`cedula` = :cedula";
            $stmt4 = $this->conexion->prepare($sql4);
            $stmt4->execute(
                array(
                    ":cedula" => $cedulaProfDV,
                )
            );
            $infoProfesor = $stmt4->fetch(PDO::FETCH_ASSOC);

            $cedula = $_SESSION['cedula'];
            $accion = "Ha desvinculado al profesor " . $infoProfesor['codigo'] . " " . $infoProfesor['nombre'] . " " . $infoProfesor['apellido'] . " de la materia " . $infoMateria['nombre'] . " Nivel " . $infoMateria['nivelAcademico'];
            parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

            $mensaje = 'Te han desvinculado de la materia "' . $infoMateria['nombre'] . '" Nivel ' . $infoMateria['nivelAcademico'];
            $this->registrar_notificacionProfesor($mensaje, $cedulaProfDV);

            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();
            return false;
        }
    }


    //CANTIDAD DE FILAS POR NIVELES PARA GENERAR SELECT
    public function cantidadFilasNiveles($nivel)
    {
        $sql = "SELECT `id_materia`, `nombre`, `nivelAcademico` FROM `materias` WHERE nivelAcademico = :nivelSeleccionado";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(
            array(
                "nivelSeleccionado" => $nivel,
            )
        );
        $filas = $stmt->rowCount();

        return $filas;
    }

    //LISTAR TODAS LAS MATERIAS
    public function listarMaterias()
    {
        $listarMaterias = [];
        $sql = "SELECT id_materia, nombre, nivelAcademico FROM materias";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $listarMaterias[] = $filas;
        }


        return $listarMaterias;
    }

    //LISTAR MATERIAS POR NIVEL SELECCIONADO
    public function listarMateriasNivel($nivel)
    {
        $sql = "SELECT `id_materia`, `nombre`, `nivelAcademico` FROM `materias` WHERE `nivelAcademico` = :nivelSeleccionado";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(
            array(
                ":nivelSeleccionado" => $nivel,
            )
        );

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
        try {
            //Obteniendo informacion de la materia
            $sql = "SELECT * FROM `materias` WHERE `materias`.`id_materia` = :idMateria";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(
                ":idMateria" => $idMateria,
            ));
            $infoMateria = $stmt->fetch(PDO::FETCH_ASSOC);

            $sql = "DELETE FROM materias WHERE id_materia = :id_materia";

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(array(
                ":id_materia" => $idMateria
            ));

            $cedula = $_SESSION['cedula'];
            $accion = 'Ha eliminado la materia "' . $infoMateria['nombre'] . '" Nivel ' . $infoMateria['nivelAcademico'] . ' de la ECAM';
            parent::registrar_bitacora($cedula, $accion, $this->id_modulo);
            return true;
        } catch (Exception $e) {

            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return $e;
        }
    }

    //ACTUALIZAR MATERIAS
    public function actualizarMateria()
    {
        $sql = "UPDATE `materias` SET `nombre` = :nom, `nivelAcademico` = :nivelD WHERE `materias`.`id_materia` = :idMa";

        $stmt = $this->conexion()->prepare($sql);

        $stmt->execute(
            array(
                ":idMa" => $this->idMateria,
                ":nom" => $this->nombre,
                ":nivelD" => $this->nivel
            )
        );

        $cedula = $_SESSION['cedula'];
        $accion = 'El usuario ha actualizado los datos de una materia del Nivel ' . $this->nivel;
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);
    }

    //LISTAR PROFESORES DE LAS MATERIAS
    public function listarProfesoresMateria($idMateriaProf)
    {
        $listarProfesoresMaterias = [];

        $sql = "SELECT `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `profesores-materias`.`cedula_profesor`, `profesores-materias`.`id_materia` 
        FROM `profesores-materias` INNER JOIN usuarios ON `profesores-materias`.`cedula_profesor` = `usuarios`.`cedula` 
        INNER JOIN materias ON `profesores-materias`.`id_materia` = `materias`.`id_materia` WHERE `profesores-materias`.`id_materia` = :idMateria";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(
            array(
                "idMateria" => $idMateriaProf,
            )
        );

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $listarProfesoresMaterias[] = $filas;
        }
        return $listarProfesoresMaterias;
    }

    //OPCION 2 DE LISTAR PROFESORES DE LA MATERIA
    public function profesores_materiaSeleccionada($idMateria)
    {
        $profesores_materia = [];

        $sql = "SELECT `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `profesores-materias`.`cedula_profesor`, `profesores-materias`.`id_materia` 
        FROM `profesores-materias` INNER JOIN usuarios ON `profesores-materias`.`cedula_profesor` = `usuarios`.`cedula` 
        INNER JOIN materias ON `profesores-materias`.`id_materia` = `materias`.`id_materia` WHERE `profesores-materias`.`id_materia` = $idMateria";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $profesores_materia[] = $filas;
        }
        return $profesores_materia;
    }

    //LISTAR PROFESORES QUE IMPARTEN SEMINARIOS
    public function profesoresSeminarios()
    {
        $listarprofesores_seminario = [];

        $sql = "SELECT `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `profesores-materias`.`cedula_profesor`, `profesores-materias`.`id_materia` FROM `profesores-materias` 
        INNER JOIN `usuarios` ON `profesores-materias`.`cedula_profesor` = `usuarios`.`cedula` INNER JOIN `materias` ON `profesores-materias`.`id_materia` = `materias`.`id_materia` WHERE `materias`.`nivelAcademico` = 'Seminario'";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $listarprofesores_seminario[] = $filas;
        }
        return $listarprofesores_seminario;
    }

    //LISTAR PROFESORES DEL SEMINARIO SELECCIONADO
    public function profesor_selectSeminario($idSeminario)
    {
        $profesoresDelSeminario = [];

        $sql = "SELECT `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `profesores-materias`.`cedula_profesor`, `profesores-materias`.`id_materia` 
        FROM `profesores-materias` INNER JOIN `usuarios` ON `profesores-materias`.`cedula_profesor` = `usuarios`.`cedula` WHERE `profesores-materias`.`id_materia` = $idSeminario";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $profesoresDelSeminario[] = $filas;
        }
        return $profesoresDelSeminario;
    }

    //LISTAR MATERIAS CON NIVEL SEMINARIO
    public function materias_seminario()
    {
        $listarMaterias_seminario = [];

        $sql = "SELECT `id_materia`, `nombre`, `nivelAcademico` FROM `materias` WHERE `nivelAcademico` = 'Seminario'";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $listarMaterias_seminario[] = $filas;
        }
        return $listarMaterias_seminario;
    }






    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////APARTADO DE SECCIONES/////////////////////////////////////////////////
    public function validar_seccion($id_seccion, $nombre, $nivel)
    {
        $seccion = [];

        //Consulta para comparar que la seccion tiene el mismo nivel
        $sql = "SELECT * FROM secciones WHERE id_seccion = :id_seccion";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(":id_seccion" => $id_seccion,));
        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $seccion[] = $filas;
        }

        //Consulta para comparar que existe la seccion con los datos enviados
        $sql1 = "SELECT * FROM secciones WHERE nombre = :nombre AND nivel_academico = :nivel";
        $stmt1 = $this->conexion->prepare($sql1);
        $stmt1->execute(
            array(
                ":nombre" => $nombre,
                ":nivel" => $nivel,
            )
        );
        $resultado = $stmt1->rowCount();

        if ($nivel == $seccion[0]['nivel_academico']) { //Si el nivel es igual, retornara la coincidencia de la seccion
            
            return $resultado;
        }else{ //Si el nivel es diferente se hara lo siguiente

            //Condicion para consultar que la coincidencia sea 0 para seguir el proceso.
            if ($resultado == 0) {
                $sql3 = "SELECT * FROM `notamateria_estudiantes` WHERE id_seccion = :id_seccion";
                $stmt3 = $this->conexion->prepare($sql3);
                $stmt3->execute(array(":id_seccion" => $id_seccion,));
                $matriz = $stmt3->rowCount();
    
                if ($matriz > 0) {
                    return 'denegado';
                }else{
                    $sql4 = "DELETE FROM `notamateria_estudiantes` WHERE id_seccion = :id_seccion";
                    $stmt4 = $this->conexion->prepare($sql4);
                    $stmt4->execute(array(":id_seccion" => $id_seccion));

                    $sql5 = "UPDATE `usuarios` SET id_seccion = NULL WHERE usuarios.id_seccion = :id_seccion";
                    $stmt5 = $this->conexion->prepare($sql5);
                    $stmt5->execute(array(":id_seccion" => $id_seccion));

                    $sql6 = "DELETE FROM `secciones-materias-profesores` WHERE id_seccion = :id_seccion";
                    $stmt6 = $this->conexion->prepare($sql6);
                    $stmt6->execute(array(":id_seccion" => $id_seccion));

                    return $resultado;
                }
            }else{
                return $resultado;
            }
        }

        
    }
    public function crearSeccion()
    {
        $sql = "INSERT INTO `secciones` (`id_seccion`, `nombre`, `nivel_academico`, `status_seccion`, `fecha_creacion`, `fecha_cierre`) 
        VALUES (NULL, :nomSeccion, :nivAc, '1', CURDATE(), :fechaCierre)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(
            array(
                ":nomSeccion" => $this->nombreSeccion,
                ":nivAc" => $this->nivelSeccion,
                ":fechaCierre" => $this->fechaCierreSeccion,
            )
        );

        //AGREGANDO ESTUDIANTES A LA SECCION
        foreach ($this->cedulaEstSeccion as $cedulaEst) {
            $sql2 = "UPDATE `usuarios` SET `id_seccion` = (SELECT MAX(id_seccion) FROM secciones), `id_rol` = 4 WHERE `usuarios`.`cedula` = :cedulaEst";
            $stmt2 = $this->conexion->prepare($sql2);
            $stmt2->execute(
                array(
                    ":cedulaEst" => $cedulaEst,
                )
            );
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
            $stmt3->execute(
                array(
                    ":idSec" => $id,
                    ":idMat" => $idSec[$i],
                    ":ciProf" => $idP[$i],
                )
            );
        }

        $cedula = $_SESSION['cedula'];
        $accion = "Ha creado una seccion nueva llamada " . $this->nombreSeccion;
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

        return $id;
    } //FIN DEL CREAR SECCION



    //LISTAR PROFESORES DE LA SECCION POR MATERIA
    public function listarProfesores_seccionMateria($idSeccionProfConsulta)
    {
        $listarProfesores_SM = [];
        $sql = "SELECT `materias`.`id_materia`, `materias`.`nombre` AS `nombreMateria`, `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` FROM `secciones-materias-profesores` AS `smp` 
        INNER JOIN `usuarios` ON `smp`.`cedulaProf` = `usuarios`.`cedula` 
        INNER JOIN `materias` ON `smp`.`id_materia` = `materias`.`id_materia` WHERE `smp`.`id_seccion` = :idSeccionProfComsulta";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(
            array(
                ":idSeccionProfComsulta" => $idSeccionProfConsulta,
            )
        );

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $listarProfesores_SM[] = $filas;
        }
        return $listarProfesores_SM;
    }

    //AGREGANDO O ACTUALIZANDO MAS ESTUDIANTES A LA SECCION SELECCIONADA
    public function agregandoMasEstudiantes($estudiantesNuevos, $idSeccionVincular)
    {
        foreach ($estudiantesNuevos as $estNuevo) {
            $sql = "UPDATE `usuarios` SET `id_seccion` = :seccionVincular WHERE `usuarios`.`cedula` = :cedulaEstNuevo";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(
                array(
                    ":seccionVincular" => $idSeccionVincular,
                    ":cedulaEstNuevo" => $estNuevo,
                )
            );
        } //FIN DEL FOREACH
        //ESTUDIANTES NUEVOS VINCULADOS A LA SECCION

        $cedula = $_SESSION['cedula'];
        $accion = "El usuario ha agregado mas estudiante a una seccion";
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);
    }

    //CERRAR/DESACTIVAR LA SECCION SELECCIONADA
    public function cerrarSeccion($idSeccionEliminar)
    {
        //PASO 1
        //ELIMINA O DESACTIVA LA SECCION PRIMERO
        $sql = "UPDATE `secciones` SET `status_seccion` = '0' WHERE `secciones`.`id_seccion` = $idSeccionEliminar";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();


        //PASO 2
        $cedulas = [];
        //GUARDAMOS LOS ESTUDIANTES QUE PASARON POR LA SECCION
        $sql2 = "SELECT * FROM `notafinal_estudiantes` AS `nte` WHERE `nte`.`id_seccion` = :id_seccion";
        $stmt2 = $this->conexion->prepare($sql2);
        $stmt2->execute(array(
            ":id_seccion" => $idSeccionEliminar,
        ));
        while ($filas = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $cedulas[] = $filas; //Esta variable es para guardar las cedulas de los estudiantes que pertenecieron a la seccion
        }


        //AHORA INSERTAMOS LA SECCION Y TODOS LOS ESTUDIANTES QUE ESTUVIERON EN ELLA EN LA TABLA DE SECCIONES CERRADAS
        foreach ($cedulas as $ci) {
            $sql4 = "INSERT INTO `secciones-cerradas-estudiantes`(`id_seccion`, `cedula_estudiante`, `nota_final`) VALUES (:id_seccion, :cedula, :nota_final)";
            $stmt4 = $this->conexion->prepare($sql4);
            $stmt4->execute(
                array(
                    ":id_seccion" => $idSeccionEliminar,
                    ":cedula" => $ci['cedulaEstudiante'],
                    ":nota_final" => $ci['notaFinal']
                )
            );
        }


        //PASO 3
        $cedulas_codigo = [];
        //Comprobamos si los estudiantes que cursaron fueron del nivel 3 y pudieron completar su nivel para graduarse y actualizar el N1 por N2
        $sql5 = "SELECT cedulaEstudiante FROM notafinal_estudiantes 
        WHERE id_seccion = $idSeccionEliminar AND nivelAcademico = 3  AND notaFinal >= 16";
        $stmt5 = $this->conexion->prepare($sql5);
        $stmt5->execute();

        if ($stmt5->rowCount() > 0) {
            while ($filas5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                $cedulas_codigo[] = $filas5; //Esta variable es para guardar las cedulas de los estudiantes que pertenecieron a la seccion
            }

            foreach ($cedulas_codigo as $ce) {
                $sql6 = "UPDATE `usuarios` SET `codigo` = REPLACE(`codigo`,'N1','N2') WHERE `cedula` = :ce";
                $stmt6 = $this->conexion->prepare($sql6);
                $stmt6->execute(
                    array(
                        ":ce" => $ce['cedulaEstudiante'],
                    )
                );

                $sql7 = "UPDATE `usuarios` SET `id_rol` = 2 WHERE `cedula` = :ce";
                $stmt7 = $this->conexion->prepare($sql7);
                $stmt7->execute(
                    array(
                        ":ce" => $ce['cedulaEstudiante'],
                    )
                );
            }
        }


        //PASO 4
        //LUEGO DEJAMOS EN NULL EL ID_SECCION DE LOS ESTUDIANTES QUE ESTABAN VINCULADOS A LA SECCION
        $sql3 = "UPDATE `usuarios` SET `id_seccion`= NULL WHERE `usuarios`.`cedula` IN (SELECT `usuarios`.`cedula` FROM usuarios WHERE `usuarios`.`id_seccion` = :idSeccionOFF)";
        $stmt3 = $this->conexion->prepare($sql3);
        $stmt3->execute(
            array(
                ":idSeccionOFF" => $idSeccionEliminar,
            )
        );

        //PASO 5
        //DESVINCULAREMOS TODOS LOS PROFESROES DE LA SECCION
        $sql8 = "DELETE FROM `secciones-materias-profesores` WHERE id_seccion = :id_seccion";
        $stmt8 = $this->conexion->prepare($sql8);
        $stmt8->execute(
            array(
                ":id_seccion" => $idSeccionEliminar,
            )
        );

        $cedula = $_SESSION['cedula'];
        $accion = "El usuario ha cerrado una seccion";
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

        return true;
    }

    //ELIMINAR ESTUDIANTE DE LA SECCION SELECCIONADA
    public function eliminarEstSeccion($cedulaEstborrar)
    {
        $sql = "UPDATE `usuarios` SET `id_seccion` = NULL WHERE `usuarios`.`cedula` = $cedulaEstborrar";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        $cedula = $_SESSION['cedula'];
        $accion = "El usuario ha desvinculado a un estudiante de una seccion";
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);
    }

    //ACTUALIZAR DATOS DE LA SECCION SELECCIONADA
    public function actualizarDatosSeccion($idSeccionRefU)
    {
        $sql = "UPDATE `secciones` SET `nombre` = :nombreSecU, `nivel_academico` = :nivelSecU, `fecha_cierre` = :fechaCierre WHERE `secciones`.`id_seccion` = $idSeccionRefU";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(
            array(
                ":nombreSecU" => $this->nombreSeccionU,
                ":nivelSecU" => $this->nivelSeccionU,
                ":fechaCierre" => $this->fechaCierreRefU,
            )
        );

        $cedula = $_SESSION['cedula'];
        $accion = "El usuario ha actualizado los datos de una seccion";
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

        return true;
    }

    //SELECT DE LAS MATERIAS QUE NO ESTAN EN LA SECCION PARA AGREGAR
    public function selectMateriasOFF($idSeccionReferencial, $nivDoctrinaReferencial)
    {
        $sql = "SELECT `materias`.`id_materia`, `materias`.`nombre`, `materias`.`nivelAcademico` FROM `materias` WHERE NOT EXISTS (SELECT * FROM `secciones-materias-profesores` 
        WHERE `secciones-materias-profesores`.`id_materia` = `materias`.`id_materia` 
        AND `secciones-materias-profesores`.`id_seccion` = :idSeccionRef) AND `materias`.`nivelAcademico` = :nivelDoctrinaRef";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(
            array(
                ":idSeccionRef" => $idSeccionReferencial,
                ":nivelDoctrinaRef" => $nivDoctrinaReferencial,
            )
        );

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->listarMateriasOFF[] = $filas;
        }
        return $this->listarMateriasOFF;
    }

    //AGREGAR O ACTUALIZAR MATERIAS CON PROFESORES ADICIONALES A LA SECCION SELECCIONADA
    public function actualizarMateriasProfesores($idSeccion)
    {
        $sql = "INSERT INTO `secciones-materias-profesores` (`id_seccion`, `id_materia`, `cedulaProf`, `contenido`) VALUES (:idSeccion, :idMateria, :cedulaProf, NULL)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(
            array(
                ":idSeccion" => $idSeccion,
                ":idMateria" => $this->idMateriaAdicional,
                ":cedulaProf" => $this->cedulaProfAdicional,
            )
        );

        $cedula = $_SESSION['cedula'];
        $accion = "El usuario ha actualizado las materias y profesores de una seccion";
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);
    }

    //ELIMINAR MATERIAS Y PROFESORES DE LA SECCION SELECCIONADA
    public function eliminarMateriaProf_seccion($idSeccionMatProfSec, $idMateriaSec, $cedulaProfSec)
    {
        $sql = "DELETE FROM `secciones-materias-profesores` WHERE `secciones-materias-profesores`.`id_seccion` = :idSeccion 
        AND `secciones-materias-profesores`.`id_materia`= :idMateria 
        AND `secciones-materias-profesores`.`cedulaProf`= :cedulaProf";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(
            array(
                ":idSeccion" => $idSeccionMatProfSec,
                ":idMateria" => $idMateriaSec,
                ":cedulaProf" => $cedulaProfSec,
            )
        );

        $cedula = $_SESSION['cedula'];
        $accion = "El usuario eliminado una materia de la seccion";
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);
    }

    //LISTAR TODAS LAS SECCIONES ACTIVAS
    public function listarSeccionesON()
    {
        $listarSeccionesON = [];
        $sql = "SELECT * FROM `secciones` WHERE `status_seccion` = 1  ORDER BY `id_seccion` ASC";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $listarSeccionesON[] = $filas;
        }
        return $listarSeccionesON;
    }

    //CONSULTAR FECHA DE CREACION Y DE CIERRE PARA VOLVER ALGUNAS OPCIONES
    public function fechaCierre_seccion()
    {
        $seccion = $_SESSION['id_seccion'];
        $sql = "SELECT fecha_creacion, fecha_cierre FROM secciones WHERE id_seccion = $seccion";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $filas1[] = $filas;
        }
        return $filas1;
    }

    //LISTAR APROBADOS DE LA SECCION
    public function seccionAprobados($idSeccion)
    {
        $aprobados = [];

        $sql = "SELECT `ntf`.`id_seccion`, `ntf`.`cedulaEstudiante`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `ntf`.`notaFinal` FROM `notafinal_estudiantes` AS `ntf`, `usuarios` 
        WHERE `ntf`.`cedulaEstudiante` = `usuarios`.`cedula` AND notaFinal >= 16 AND `ntf`.`id_seccion` = $idSeccion";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $aprobados[] = $filas;
        }
        return $aprobados;
    }

    //LISTAR APLAZADOS DE LA SECCION
    public function seccionAplazados($idSeccion)
    {
        $reprobados = [];

        $sql = "SELECT `ntf`.`id_seccion`, `ntf`.`cedulaEstudiante`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `ntf`.`notaFinal` FROM `notafinal_estudiantes` AS `ntf`, `usuarios` 
        WHERE `ntf`.`cedulaEstudiante` = `usuarios`.`cedula` AND notaFinal < 16 AND `ntf`.`id_seccion` = $idSeccion";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reprobados[] = $filas;
        }
        return $reprobados;
    }

    //LISTAR TODAS LAS SECCIONES CERRADAS
    public function listarSeccionesOFF()
    {
        $listarSeccionesOFF = [];

        $sql = "SELECT * FROM `secciones` WHERE `status_seccion` = 0";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $listarSeccionesOFF[] = $filas;
        }
        return $listarSeccionesOFF;
    }
    //LISTAR TODAS LAS SECCIONES CERRADAS
    public function estudiantes_seccionOFF($seccionOFF)
    {
        $estudiantesOFF = [];

        $sql = "SELECT `sc`.`id_seccion`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `sc`.`nota_final` FROM `secciones-cerradas-estudiantes` AS `sc` 
        INNER JOIN `usuarios` ON `sc`.`cedula_estudiante` = `usuarios`.`cedula` WHERE `sc`.`id_seccion` = :id_seccion";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":id_seccion" => $seccionOFF,
        ));

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $estudiantesOFF[] = $filas;
        }
        return $estudiantesOFF;
    }
    //ELIMINAR DEFINITAVAMENTE UNA SECCION
    public function eliminarSeccion($seccion)
    {
        $sql = "DELETE FROM `secciones` WHERE `id_seccion` = $seccion";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute();

        $cedula = $_SESSION['cedula'];
        $accion = "El usuario ha eliminado una seccion definitivamente";
        parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

        return true;
    }








    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////AULA VIRTUAL PROFESOR///////////////////////////////////////////////////

    //LISTAR MATERIAS QUE IMPARTE EL PROFESOR ACTIVO DE LA ECAM
    public function listar_misMateriasProf()
    {
        try {
            $cedulaProfesor = $_SESSION['cedula']; //Aqui capta la cedula del profesor activo jeje

            $sql = "SELECT `materias`.`id_materia`, `secciones`.`id_seccion`, `secciones`.`nombre` AS `nombreSeccion`, `materias`.`nombre` AS `nombreMateria`, `materias`.`nivelAcademico`, `usuarios`.`cedula`, 
            `usuarios`.`nombre` as `nombreProfesor`, `usuarios`.`apellido` as `apellidoProfesor`, `smp`.`contenido`
            FROM `secciones-materias-profesores` AS `smp` INNER JOIN `materias` ON `smp`.`id_materia` = `materias`.`id_materia` 
            INNER JOIN `usuarios` ON `smp`.`cedulaProf` = `usuarios`.`cedula` INNER JOIN `secciones` ON `smp`.`id_seccion` = `secciones`.`id_seccion` WHERE `smp`.`cedulaProf` = :cedulaProfesor AND `secciones`.`status_seccion` = 1";

            $stmt = $this->conexion()->prepare($sql);

            $stmt->execute(
                array(
                    ":cedulaProfesor" => $cedulaProfesor,
                )
            );

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {


                $this->listar_misMateriasProf[] = $filas;
            }
            return $this->listar_misMateriasProf;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //AGREGAR O SUBIR CONTENIDOS A LAS MATERIAS DEL PROFESOR ACTIVO
    public function agregarContenidos($seccionContRef, $materiaContRef, $contenido)
    {
        try {
            $cedulaProfesor = $_SESSION['cedula']; //Aqui capta la cedula del profesor activo jeje

            $sql = "UPDATE `secciones-materias-profesores` SET `contenido`= :contenido WHERE `secciones-materias-profesores`.`id_seccion` = :idSeccionProf 
            AND `secciones-materias-profesores`.`id_materia` = :idMateriaProf AND `secciones-materias-profesores`.`cedulaProf` = :cedulaProfesor";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":contenido" => $contenido,
                    ":idSeccionProf" => $seccionContRef,
                    ":idMateriaProf" => $materiaContRef,
                    ":cedulaProfesor" => $cedulaProfesor,
                )
            );

            //CONSULTA PARA EL REGISTRO EN LA BITACORA Y DE NOTIFICACIONES
            $sql2 = "SELECT `secciones`.`nombre` AS `nombreSeccion`, `materias`.`nombre` AS `nombreMateria`, `materias`.`nivelAcademico` 
            FROM `materias`, `secciones` WHERE `id_materia` = :materia AND `secciones`.`id_seccion` = :seccion";
            $stmt2 = $this->conexion()->prepare($sql2);
            $stmt2->execute(array(
                ":materia" => $materiaContRef,
                ":seccion" => $seccionContRef,
            ));
            $datos = $stmt2->fetch(PDO::FETCH_ASSOC);

            //REGISTRO DE ACCION EN LA BITACORA
            $cedula = $_SESSION['cedula'];
            $accion = "El profesor ha agregado contenido a " . $datos['nombreMateria'] . " nivel " . $datos['nivelAcademico'] . " en la seccion " . $datos['nombreSeccion'];
            parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

            $accion2 = "El profesor ha agregado contenido nuevo a " . $datos['nombreMateria'];
            $this->registrar_notificacionSeccion($seccionContRef, $accion2, '');

            return true;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //LISTAR CONTENIDOS DE LAS MATERIAS PROFESORES
    public function listarContenido($idSeccion, $idMateria)
    {
        try {
            $cedulaProfesor = $_SESSION['cedula']; //Aqui capta la cedula del profesor activo jeje
            $listarContenido = [];

            $sql = "SELECT `secciones-materias-profesores`.`contenido` FROM `secciones-materias-profesores` 
            WHERE `secciones-materias-profesores`.`id_seccion` = :idSeccionProf AND `secciones-materias-profesores`.`id_materia`= :idMateriaProf 
            AND `secciones-materias-profesores`.`cedulaProf` = :cedulaProfesor";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":idSeccionProf" => $idSeccion,
                    ":idMateriaProf" => $idMateria,
                    ":cedulaProfesor" => $cedulaProfesor,
                )
            );

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $listarContenido[] = $filas;
            }

            $cedula = $_SESSION['cedula'];
            $accion = "El usuario ha revisado el contenido de su materia";
            parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

            return $listarContenido;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //ELIMINAR INFORMACION DE LAS MATERIAS PROFESORES
    public function eliminarContenido($idSeccion, $idMateria)
    {
        try {
            $cedulaProfesor = $_SESSION['cedula']; //Aqui capta la cedula del profesor activo jeje

            $sql = "UPDATE `secciones-materias-profesores` SET `contenido`= NULL WHERE `id_materia` = :materia AND `cedulaProf` = :cedula AND `id_seccion` = :seccion";
            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":seccion" => $idSeccion,
                    ":materia" => $idMateria,
                    ":cedula" => $cedulaProfesor,
                )
            );

            $accion = "El usuario ha eliminado la informacion de la materia";
            parent::registrar_bitacora($cedulaProfesor, $accion, $this->id_modulo);

            return true;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }


    //LISTAR MATERIAS QUE IMPARTE EL PROFESOR ACTIVO DE LA ECAM
    public function listar_misEstudiantes()
    {
        try {
            $cedulaProfesor = $_SESSION['cedula']; //Aqui capta la cedula del profesor activo jeje

            /*$sql = "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `materias`.`nombre` as `nombreMateria`, `materias`.`nivelDoctrina`, `materias`.`id_materia`, 
            `secciones`.`id_seccion`, `secciones`.`nombre` AS `nombreSeccion` FROM `secciones-materias-profesores` AS `smp` INNER JOIN `usuarios` ON `smp`.`id_seccion` = `usuarios`.`id_seccion` INNER JOIN `materias` ON `smp`.`id_materia`= `materias`.`id_materia`
            INNER JOIN `secciones` ON `smp`.`id_seccion` = `secciones`.`id_seccion` WHERE `smp`.`cedulaProf`= :cedulaProfesor";*/

            $sql = "SELECT `usuarios`.`cedula`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido`, `materias`.`nombre` 
            AS `nombreMateria`, `materias`.`nivelAcademico`, `materias`.`id_materia`, `secciones`.`id_seccion`, `secciones`.`nombre` 
            AS `nombreSeccion`, `nme`.`nota` FROM `secciones-materias-profesores` AS `smp` INNER JOIN `usuarios` ON `smp`.`id_seccion` = `usuarios`.`id_seccion` 
            INNER JOIN `materias` ON `smp`.`id_materia` = `materias`.`id_materia` INNER JOIN `secciones` ON `smp`.`id_seccion` = `secciones`.`id_seccion` 
            LEFT JOIN notamateria_estudiantes AS nme ON `nme`.`cedula` = `usuarios`.`cedula` AND `nme`.`id_seccion` = `smp`.`id_seccion` AND `nme`.`id_materia` = `materias`.`id_materia` WHERE `smp`.`cedulaProf` = :cedulaProfesor";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":cedulaProfesor" => $cedulaProfesor,
                )
            );

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->listar_misEstudiantes[] = $filas;
            }

            return $this->listar_misEstudiantes;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //AGREGAR LAS NOTAS DE LAS MATERIAS A LOS ESTUDIANTES
    public function agregarNotaMateria($nota)
    {
        try {
            $sql = "INSERT INTO `notamateria_estudiantes` (`id_seccion`, `cedula`, `id_materia`, `nota`, `fecha_agregado`) 
            VALUES (:notaIDseccion, :notaCIestudiante, :notaIDmateria, :nota, CURDATE())";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":notaIDseccion" => $this->notaIDseccion,
                    ":notaCIestudiante" => $this->notaCIestudiante,
                    ":notaIDmateria" => $this->notaIDmateria,
                    ":nota" => $nota,
                )
            );

            //CONSULTA PARA EL REGISTRO EN LA BITACORA Y DE NOTIFICACIONES
            $sql2 = "SELECT `secciones`.`nombre` AS `nombreSeccion`, `materias`.`nombre` AS `nombreMateria`, `materias`.`nivelAcademico` 
            FROM `materias`, `secciones` WHERE `id_materia` = :idMateria AND `secciones`.`id_seccion` = :idSeccion";
            $stmt2 = $this->conexion()->prepare($sql2);
            $stmt2->execute(
                array(
                    ":idMateria" => $this->notaIDmateria,
                    ":idSeccion" => $this->notaIDseccion,
                )
            );
            $datos = $stmt2->fetch(PDO::FETCH_ASSOC);

            //REGISTRO DE ACCION EN LA BITACORA
            $cedula = $_SESSION['cedula'];
            $accion = "Le ha agregado nota de la materia " . $datos['nombreMateria'] . " a un estudiante de la seccion " . $datos['nombreSeccion'];
            parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

            $accion2 = "El profesor de " . $datos['nombreMateria'] . " te ha agregado la nota de la materia";
            $this->registrar_notificacionSeccion($this->notaIDseccion, $accion2, $this->notaCIestudiante);

            return true;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //ACTUALIZAR LA NOTA DEL ESTUDIANTE SELECCIONADO DEL PROFESOR ACTIVO EN LA SESION
    public function actualizarNotaMateria($notaNueva)
    {
        try {
            $sql = "UPDATE `notamateria_estudiantes` SET `nota`=:notaNueva, `fecha_agregado`= CURDATE() 
            WHERE cedula = :notaCIestudiante AND id_seccion = :notaIDseccion AND id_materia = :notaIDmateria";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":notaIDseccion" => $this->notaIDseccion2,
                    ":notaCIestudiante" => $this->notaCIestudiante2,
                    ":notaIDmateria" => $this->notaIDmateria2,
                    ":notaNueva" => $notaNueva,
                )
            );

            //CONSULTA PARA EL REGISTRO EN LA BITACORA Y DE NOTIFICACIONES
            $sql2 = "SELECT `secciones`.`nombre` AS `nombreSeccion`, `materias`.`nombre` AS `nombreMateria`, `materias`.`nivelAcademico` 
            FROM `materias`, `secciones` WHERE `id_materia` = :idMateria AND `secciones`.`id_seccion` = :idSeccion";
            $stmt2 = $this->conexion()->prepare($sql2);
            $stmt2->execute(
                array(
                    ":idMateria" => $this->notaIDmateria2,
                    ":idSeccion" => $this->notaIDseccion2,
                )
            );
            $datos = $stmt2->fetch(PDO::FETCH_ASSOC);

            //REGISTRO DE ACCION EN LA BITACORA
            $cedula = $_SESSION['cedula'];
            $accion = "Ha actualizado la nota de la materia " . $datos['nombreMateria'] . " a un estudiante de la seccion " . $datos['nombreSeccion'];
            parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

            $accion2 = "El profesor de " . $datos['nombreMateria'] . " te ha actualizado la nota de la materia";
            $this->registrar_notificacionSeccion($this->notaIDseccion, $accion2, $this->notaCIestudiante);

            return true;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //ELIMINAR LA NOTA DEL ESTUDIANTE SELECCIONADO POR EL PROFESOR ACTIVO EN LA SESION
    public function eliminarNotaMateria($cedulaEstudianteRef2, $idMateriaRef2, $idSeccionRef2)
    {
        try {
            $sql = "DELETE FROM `notamateria_estudiantes` WHERE id_seccion = :idSeccionRef2 AND cedula = :cedulaEstudianteRef2 AND id_materia = :idMateriaRef2";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":idSeccionRef2" => $idSeccionRef2,
                    ":cedulaEstudianteRef2" => $cedulaEstudianteRef2,
                    ":idMateriaRef2" => $idMateriaRef2,
                )
            );

            //CONSULTA PARA EL REGISTRO EN LA BITACORA Y DE NOTIFICACIONES
            $sql2 = "SELECT `secciones`.`nombre` AS `nombreSeccion`, `materias`.`nombre` AS `nombreMateria`, `materias`.`nivelAcademico` 
            FROM `materias`, `secciones` WHERE `id_materia` = :idMateria AND `secciones`.`id_seccion` = :idSeccion";
            $stmt2 = $this->conexion()->prepare($sql2);
            $stmt2->execute(
                array(
                    ":idMateria" => $idMateriaRef2,
                    ":idSeccion" => $idSeccionRef2,
                )
            );
            $datos = $stmt2->fetch(PDO::FETCH_ASSOC);

            //REGISTRO DE ACCION EN LA BITACORA
            $cedula = $_SESSION['cedula'];
            $accion = "Ha eliminado la nota de la materia " . $datos['nombreMateria'] . " a un estudiante de la seccion " . $datos['nombreSeccion'];
            parent::registrar_bitacora($cedula, $accion, $this->id_modulo);

            $accion2 = "El profesor de " . $datos['nombreMateria'] . " te ha eliminado la nota de la materia";
            $this->registrar_notificacionSeccion($idSeccionRef2, $accion2, $cedulaEstudianteRef2);

            return true;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //MOSTRAR LA NOTA DE LA MATERIA DEL ESTUDIANTE SELECCIONADO
    public function listarNota_miEstudiante($notaIDmateria, $notaIDseccion, $notaCIestudiante)
    {
        try {
            $nota_miEstudiante = [];
            $sql = "SELECT `nota` FROM `notamateria_estudiantes` as `nme` WHERE `nme`.`id_seccion` = :notaIDseccionRef 
            AND `nme`.`id_materia` = :notaIDmateriaRef AND `nme`.`cedula`= :notaCIestudianteRef";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":notaIDseccionRef" => $notaIDseccion,
                    ":notaCIestudianteRef" => $notaCIestudiante,
                    ":notaIDmateriaRef" => $notaIDmateria,
                )
            );

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $nota_miEstudiante[] = $filas;
            }
            return $nota_miEstudiante;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    public function cantidad_materiasSecciones()
    {
        try {
            $miCedula = $_SESSION['cedula'];
            $cantidad_materiasSecciones = [];

            $sql = "SELECT `secciones`.`id_seccion`, `secciones`.`nombre` AS `nombreSeccion`, `usuarios`.`nombre` AS `nombreProfesor`, `usuarios`.`apellido` AS `apellidoProfesor`, 
            COUNT(`smp`.`id_materia`) AS `cantidadMaterias` FROM `secciones-materias-profesores` AS `smp` INNER JOIN `usuarios` ON `smp`.`cedulaProf` = `usuarios`.`cedula` 
            INNER JOIN `secciones` ON `smp`.`id_seccion` = `secciones`.`id_seccion` WHERE `smp`.`cedulaProf` = :cedula AND `secciones`.`status_seccion` = 1 GROUP BY `smp`.`id_seccion`";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":cedula" => $miCedula,
            ));

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $cantidad_materiasSecciones[] = $filas;
            }
            return $cantidad_materiasSecciones;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////AULA VIRTUAL ESTUDIANTE/////////////////////////////////////////////////

    //LISTAR COMPANEROS DE MI SECCION 
    public function listar_misCompaneros()
    {
        try {
            $miSeccion = $_SESSION['id_seccion'];
            $listar_misCompaneros = [];

            $sql = "SELECT `cedula`, `codigo`, `nombre`, `apellido` FROM `usuarios` WHERE `usuarios`.`id_seccion` = :seccion";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":seccion" => $miSeccion,
                )
            );

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $listar_misCompaneros[] = $filas;
            }
            return $listar_misCompaneros;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //LISTAR PROFESORES DE MI SECCION
    public function listar_misProfesores()
    {
        try {
            $miSeccion = $_SESSION['id_seccion'];
            $listar_misProfesores = [];

            $sql = "SELECT `materias`.`nombre` as nombreMateria, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` FROM `secciones-materias-profesores` AS smp 
        INNER JOIN usuarios ON `usuarios`.`cedula` = `smp`.`cedulaProf` INNER JOIN `materias` ON `materias`.`id_materia` = `smp`.`id_materia` WHERE `smp`.`id_seccion` = :seccion";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":seccion" => $miSeccion,
            ));

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $listar_misProfesores[] = $filas;
            }
            return $listar_misProfesores;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //LISTAR LAS MATERIAS QUE LE CORRESPONDE AL ESTUDIANTE ACTIVO DE LA ECAM
    public function listar_misMateriasEst()
    {
        try {
            $idSeccionEstudiante = $_SESSION['id_seccion']; //Aqui acapta la id_seccion del usuario activo jeje

            $sql = "SELECT `smp`.`id_seccion`, `materias`.`id_materia`, `smp`.`contenido`, `usuarios`.`cedula` AS `cedulaProf`, `materias`.`nombre` as `nombreMateria`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` 
            FROM `secciones-materias-profesores` AS `smp` INNER JOIN `materias` ON `materias`.`id_materia` = `smp`.`id_materia` 
            INNER JOIN `usuarios` ON `usuarios`.`cedula` = `smp`.`cedulaProf` WHERE `smp`.`id_seccion` = :idSeccion";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(
                array(
                    ":idSeccion" => $idSeccionEstudiante,
                )
            );

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->listar_misMateriasEst[] = $filas;
            }
            return $this->listar_misMateriasEst;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //DATOS DE LA SECCION DEL ESTUDIANTE ACTIVO
    public function datos_miSeccionEst()
    {
        try {
            $miSeccion = $_SESSION['id_seccion']; //Aqui acapta la id_seccion del usuario activo jeje
            $misDatosSeccion = [];

            $sql = "SELECT `secciones`.`nombre` AS `nombreSeccion`, IF(COUNT(`smp`.`id_materia`) > 0, COUNT(`smp`.`id_materia`), '0') AS `cantidadMaterias`, `secciones`.`fecha_cierre` FROM `secciones-materias-profesores` AS `smp` 
            LEFT JOIN `secciones` ON `secciones`.`id_seccion` = `smp`.`id_seccion` WHERE `smp`.`id_seccion` = :seccion";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":seccion" => $miSeccion,
            ));

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $misDatosSeccion[] = $filas;
            }

            return $misDatosSeccion;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }

    //LISTAR LAS NOTAS DEL ESTUDIANTE ACTIVO
    public function listar_misNotas()
    {
        try {
            $miSeccion = $_SESSION['id_seccion'];
            $miCedula = $_SESSION['cedula'];
            $misNotas = [];

            $sql = "SELECT `secciones`.`id_seccion`, `materias`.`id_materia`, `materias`.`nivelAcademico`, `notas`.`nota`, `notas`.`fecha_agregado`, `materias`.`nombre` AS `nombreMateria`, `usuarios`.`codigo`, `usuarios`.`nombre`, `usuarios`.`apellido` 
            FROM `notamateria_estudiantes` AS `notas` INNER JOIN `materias` ON `materias`.`id_materia` = `notas`.`id_materia` INNER JOIN `usuarios` ON `usuarios`.`cedula` = `notas`.`cedula` 
            INNER JOIN `secciones` ON `notas`.`id_seccion` = `secciones`.`id_seccion` WHERE `secciones`.`id_seccion` = :seccion AND `notas`.`cedula` = :cedula";

            $stmt = $this->conexion()->prepare($sql);
            $stmt->execute(array(
                ":seccion" => $miSeccion,
                ":cedula" => $miCedula,
            ));

            while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $misNotas[] = $filas;
            }

            return $misNotas;
        } catch (Exception $e) {
            echo $e->getMessage();

            echo "Linea del error: " . $e->getLine();

            return false;
        }
    }





    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////APARTADO PARA REPORTES ESTADISTICOS/////////////////////////////
    public function cantidadEstudiantes_seccion()
    {
        $filas1 = [];
        // $sql= "SELECT `secciones`.`id_seccion`, `secciones`.`nombre` AS `nombreSeccion`, IF(COUNT(`usuarios`.`cedula`) IS NULL ,'0', COUNT(`usuarios`.`cedula`)) AS `cantidadEstudiantes` 
        // FROM `secciones` LEFT JOIN `usuarios` ON `usuarios`.`id_seccion` = `secciones`.`id_seccion` GROUP BY `secciones`.`id_seccion`";

        $sql = "SELECT `secciones`.`id_seccion`, `secciones`.`nombre` AS `nombreSeccion`, IF(COUNT(`usuarios`.`cedula`) IS NULL ,'0', COUNT(`usuarios`.`cedula`)) AS `cantidadEstudiantes` 
        FROM `secciones` LEFT JOIN `usuarios` ON `usuarios`.`id_seccion` = `secciones`.`id_seccion` WHERE `secciones`.`status_seccion` = '1' GROUP BY `secciones`.`id_seccion`";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());

        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $filas1[] = $filas;
        }
        return $filas1;
    }

    public function cantidadGraduandos_actual()
    {
        $filas1 = [];
        /*$sql= "SET lc_time_names = 'es_ES'; SELECT UPPER(MONTHNAME(`fecha_agregada`)) AS `mes`, count(*) AS `cantidadGraduandos` 
        FROM `notafinal_estudiantes` WHERE `fecha_agregada` BETWEEN 'YEAR(CURDATE())-01-01' AND CURDATE() GROUP BY `mes`";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());
        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $filas1[] = $filas;
        }
        return $filas1;*/

        $sql = "SELECT SUM(CASE WHEN MONTH(`fecha_agregada`) = 1 THEN 1 ELSE 0 END) AS `Enero`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 2 THEN 1 ELSE 0 END) AS `Febrero`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 3 THEN 1 ELSE 0 END) AS `Marzo`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 4 THEN 1 ELSE 0 END) AS `Abril`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 5 THEN 1 ELSE 0 END) AS `Mayo`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 6 THEN 1 ELSE 0 END) AS `Junio`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 7 THEN 1 ELSE 0 END) AS `Julio`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 8 THEN 1 ELSE 0 END) AS `Agosto`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 9 THEN 1 ELSE 0 END) AS `Septiembre`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 10 THEN 1 ELSE 0 END) AS `Octubre`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 11 THEN 1 ELSE 0 END) AS `Noviembre`,
        SUM(CASE WHEN MONTH(`fecha_agregada`) = 12 THEN 1 ELSE 0 END) AS `Diciembre`
        FROM `notafinal_estudiantes` WHERE nivelAcademico = 3 AND notaFinal >= 16 AND `fecha_agregada` BETWEEN 'YEAR(CURDATE())-01-01' AND CURDATE()";

        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array());
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    }






    ////////////////////////////VALIDACIONES DE ELIMINACION Y AGREGACION///////////////////////////

    //Desvincular profesor de la seccion
    public function validar_eliminar_profesorMateria($id_seccion, $id_materia)
    {   
        $sql = "SELECT * FROM `notamateria_estudiantes` AS `nte` WHERE nte.id_seccion = :id_seccion AND nte.id_materia = :id_materia";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":id_seccion" => $id_seccion,
            ":id_materia" => $id_materia,
        ));

        $validacion = $stmt->rowCount();
        return $validacion;
    }

    //Desvincular profesor de la materia
    public function validar_desvincular_profesorMateria($cedula_profesor, $id_materia)
    {   
        $sql = "SELECT * FROM `secciones-materias-profesores` WHERE `cedulaProf` = :cedula_profesor AND `id_materia` = :id_materia";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":cedula_profesor" => $cedula_profesor,
            ":id_materia" => $id_materia,
        ));

        $validacion = $stmt->rowCount();
        return $validacion;
    }

    public function validar_eliminar_estudiantes($id_seccion, $cedula_estudiante)
    {
        $sql = "SELECT * FROM `notamateria_estudiantes` AS `nte` WHERE nte.id_seccion = :id_seccion AND nte.cedula = :cedula_estudiante";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":id_seccion" => $id_seccion,
            ":cedula_estudiante" => $cedula_estudiante,
        ));

        $validacion = $stmt->rowCount();
        return $validacion;
    }

    //Validar datos antes de cerrar una seccion
    public function validar_cerrar_seccion($id_seccion)
    {
        $sql = "SELECT cedula FROM usuarios WHERE usuarios.id_seccion = :id_seccion";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":id_seccion" => $id_seccion,
        ));

        $estudiantes_seccion = $stmt->rowCount();

        $sql2 = "SELECT cedulaEstudiante FROM notafinal_estudiantes AS ntf WHERE ntf.id_seccion = :id_seccion";
        $stmt2 = $this->conexion()->prepare($sql2);
        $stmt2->execute(array(
            ":id_seccion" => $id_seccion,
        ));

        $estudiantes_nota = $stmt2->rowCount();

        if ($estudiantes_seccion == $estudiantes_nota) {
            return 'true';
        }else{
            $valor = ($estudiantes_seccion - $estudiantes_nota);
            return $valor;
        }
    }

    public function validar_eliminar_seccion($id_seccion)
    {
        $sql = "SELECT * FROM `secciones-cerradas-estudiantes` WHERE id_seccion = :id_seccion";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":id_seccion" => $id_seccion,
        ));

        $validacion = $stmt->rowCount();
        return $validacion;
    }

    //Validar que una materia este vinculada a las secciones y demas para ser eliminada
    public function validar_eliminar_materia($id_materia)
    {
        $sql = "SELECT * FROM `profesores-materias` WHERE id_materia = :id_materia";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":id_materia" => $id_materia,
        ));

        $validacion = $stmt->rowCount();

        $sql2 = "SELECT * FROM `secciones-materias-profesores` WHERE id_materia = :id_materia";
        $stmt2 = $this->conexion()->prepare($sql2);
        $stmt2->execute(array(
            ":id_materia" => $id_materia,
        ));

        $validacion2 = $stmt2->rowCount();

        $sql3 = "SELECT * FROM `notamateria_estudiantes` WHERE id_materia = :id_materia";
        $stmt3 = $this->conexion()->prepare($sql3);
        $stmt3->execute(array(
            ":id_materia" => $id_materia,
        ));

        $validacion3 = $stmt3->rowCount();

        if ($validacion == $validacion2 && $validacion2 == $validacion3) {
            return 'true';
        }else{
            return 'stop';
        }
    }

    //Validar que un profesor no este vinculado a otros datos para ser eliminado su status
    public function validar_eliminar_profesor($cedula)
    {
        $sql = "SELECT * FROM `profesores-materias` WHERE cedula_profesor = :cedula";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":cedula" => $cedula,
        ));

        $validacion = $stmt->rowCount();

        $sql2 = "SELECT * FROM `secciones-materias-profesores` WHERE cedulaProf = :cedula";
        $stmt2 = $this->conexion()->prepare($sql2);
        $stmt2->execute(array(
            ":cedula" => $cedula,
        ));

        $validacion2 = $stmt2->rowCount();

        if ($validacion == $validacion2) {
            return 'start';
        }else{
            return 'stop';
        }
    }

    //Validar que no haya nota final para poder eliminar la nota de la materia
    public function validar_eliminar_notaMateria($cedula_estudiante, $id_seccion)
    {
        $sql = "SELECT * FROM `notafinal_estudiantes` WHERE cedulaEstudiante = :cedula_estudiante AND id_seccion = :id_seccion";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":cedula_estudiante" => $cedula_estudiante,
            ":id_seccion" => $id_seccion,
        ));

        $validacion = $stmt->rowCount();
        return $validacion;
    }
    
    //Validar que la seccion este abierta para poder eliminar la nota final
    public function validar_eliminar_notaFinal($seccion)
    {
        $sql = "SELECT * FROM `secciones` WHERE id_seccion = :id_seccion AND `status_seccion` = 1";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":id_seccion" => $seccion,
        ));

        $validacion = $stmt->rowCount();
        return $validacion;
    }

    //Validar que el estudiante tenga todas las notas de sus materias para poder agregar la nota final
    public function validar_agregar_notaFinal($cedula, $seccion)
    {
        $sql = "SELECT * FROM `secciones-materias-profesores` WHERE id_seccion = :seccion";
        $stmt = $this->conexion()->prepare($sql);
        $stmt->execute(array(
            ":seccion" => $seccion,
        ));

        $validacion1 = $stmt->rowCount();

        $sql2 = "SELECT * FROM `notamateria_estudiantes` WHERE id_seccion = :seccion AND cedula = :cedula";
        $stmt2 = $this->conexion()->prepare($sql2);
        $stmt2->execute(array(
            ":seccion" => $seccion,
            ":cedula" => $cedula,
        ));

        $validacion2 = $stmt2->rowCount();

        if ($validacion1 == $validacion2) {
            return '0';
        }else{
            return ($validacion1 - $validacion2);
        }
    }








    ///////////////////////METODOS SETTERS/////////////////////////
    public function set_registrar_bitacora($cedula, $accion, $id_modulo)
    {
        parent::registrar_bitacora($cedula, $accion, $id_modulo);
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
    public function setActualizarDatosSeccion($nombreSeccionU, $nivelSeccionU, $fechaCierreRefU)
    {
        $this->nombreSeccionU = $nombreSeccionU;
        $this->nivelSeccionU = $nivelSeccionU;
        $this->fechaCierreRefU = $fechaCierreRefU;
    }
    //SET PARA ACTUALIZAR LAS MATERIAS Y PROFESORES DE LA SECCION
    public function setActualizarMP($idMateriaAdicional, $cedulaProfAdicional)
    {
        $this->idMateriaAdicional = $idMateriaAdicional;
        $this->cedulaProfAdicional = $cedulaProfAdicional;
    }
    //SET PARA CREAR UNA SECCION
    public function setSeccion($nombreSeccion, $nivelSeccion, $cedulaProfSeccion, $cedulaEstSeccion, $idMateriaSeccion, $fechaCierreSeccion)
    {
        $this->nombreSeccion = $nombreSeccion;
        $this->nivelSeccion = $nivelSeccion;
        $this->fechaCierreSeccion = $fechaCierreSeccion;
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
