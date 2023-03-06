<?php
require_once("../../vendor/autoload.php");

session_start();
use Csr\Modelo\Ecam;
$objeto = new ecam();

if (isset($_POST['crear'])) {
    $nombreSeccion= $_POST['nombreSeccion'];
    $nivelSeccion= $_POST['nivelSeccion'];
    $fechaCierre= $_POST['fechaCierre'];
    $idMateriaSeccion = $_POST['idMateriaSeccion'];
    $cedulaProfSeccion= $_POST['cedulaProfSeccion'];
    $cedulaEstSeccion= $_POST['cedulaEstSeccion'];

    $objeto->setSeccion($nombreSeccion, $nivelSeccion, $cedulaProfSeccion, $cedulaEstSeccion, $idMateriaSeccion, $fechaCierre);
    $objeto->crearSeccion();
    
}

///AGREGAR O ACTUALIZAR ESTUDIANTES A LA SECCION SELECCIONADA
if (isset($_POST['actualizarEstudiantes'])) {
    $idSeccionVincular= $_POST['idSeccionV'];
    $estudiantesNuevos= $_POST['estudiantesNuevos'];

    $objeto->agregandoMasEstudiantes($estudiantesNuevos, $idSeccionVincular);
}

///CERRAR SECCION SELECCIONADA
if (isset($_POST['eliminarSeccion'])) {
    $idSeccionEliminar= $_POST['idSeccionEliminar'];

    $validacion = $objeto->validar_cerrar_seccion($idSeccionEliminar);
    if ($validacion > 0) {
        echo json_encode($validacion);
    }else{
        $objeto->cerrarSeccion($idSeccionEliminar);
        echo json_encode('true');
    }
    
}
//ELIMINAR SECCION SELECCIONADA DEFINITIVAMENTE
if (isset($_POST['eliminarSeccion2'])) {
    $seccionOFF= $_POST['idSeccionCerrada'];

    $objeto->eliminarSeccion($seccionOFF);
}

///ELIMINAR ESTUDIANTES SECCION SELECCIONADA
if (isset($_POST['eliminarEstSeccion'])) {
    $cedulaEstborrar= $_POST['cedulaEstborrar'];
    $id_seccion = $_POST['idSeccionRef'];

    $validacion = $objeto->validar_eliminar_estudiantes($id_seccion, $cedulaEstborrar);
    if ($validacion > 0) {
        echo json_encode('true');
    }else{
        echo json_encode('false');
        $objeto->eliminarEstSeccion($cedulaEstborrar);
    }
}

//ACTUALIZAR INFORMACION DE LOS DATOS DE LA SECCION
if (isset($_POST['actualizarDatosSeccion'])) {
    $nombreSeccionU= $_POST['nombreSeccionU'];
    $nivelSeccionU= $_POST['nivelSeccionU'];
    $idSeccionRefU= $_POST['idSeccionRefU'];
    $fechaCierreRefU= $_POST['fechaCierreRefU'];

    $respuesta = $objeto->validar_seccion($nombreSeccionU, $nivelSeccionU);

    if ($respuesta > 0) {
        echo json_encode('true');
    }else{
        $objeto->setActualizarDatosSeccion($nombreSeccionU, $nivelSeccionU, $fechaCierreRefU);
        $objeto->actualizarDatosSeccion($idSeccionRefU);
        echo json_encode('false');
    }
}

//AGREGAR O ACTUALIZAR LAS MATERIAS Y PROFESORES DE LA SECCION SELECCIONADA
if (isset($_POST['actualizarMP'])) {
    $idMateriaAdicional= $_POST['idMateriaAdicional'];
    $cedulaProfesorAdicional= $_POST['cedulaProfesorAdicional'];
    $idSeccionRef5= $_POST['idSeccionRef5'];

    $objeto->setActualizarMP($idMateriaAdicional, $cedulaProfesorAdicional);
    $objeto->actualizarMateriasProfesores($idSeccionRef5);
}

//ELIMINAR MATERIA Y PROFESOR DE LA SECCION SELECCIONADA
if (isset($_POST['eliminarMateriaProf'])) {
    $idMateriaSec= $_POST['idMateriaSec'];
    $cedulaProfSec= $_POST['cedulaProfSec'];
    $idSeccionMatProfSec= $_POST['idSeccionMatProfSec'];

    $validar = $objeto->validar_eliminar_profesorMateria($idSeccionMatProfSec, $idMateriaSec);
    if ($validar > 0) {
        echo json_encode('true');
    }else{
        $objeto->eliminarMateriaProf_seccion($idSeccionMatProfSec, $idMateriaSec, $cedulaProfSec);
        echo json_encode('false');
    }
    
}
?>