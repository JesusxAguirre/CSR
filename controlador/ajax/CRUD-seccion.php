<?php
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam();

if (isset($_POST['crear'])) {
    $nombreSeccion= $_POST['nombreSeccion'];
    $nivelSeccion= $_POST['nivelSeccion'];
    $idMateriaSeccion = $_POST['idMateriaSeccion'];
    $cedulaProfSeccion= $_POST['cedulaProfSeccion'];
    $cedulaEstSeccion= $_POST['cedulaEstSeccion'];

    $objeto->setSeccion($nombreSeccion, $nivelSeccion, $cedulaProfSeccion, $cedulaEstSeccion, $idMateriaSeccion);
    $objeto->crearSeccion();
    
}

///AGREGAR O ACTUALIZAR ESTUDIANTES A LA SECCION SELECCIONADA
if (isset($_POST['actualizarEstudiantes'])) {
    $idSeccionVincular= $_POST['idSeccionV'];
    $estudiantesNuevos= $_POST['estudiantesNuevos'];

    $objeto->agregandoMasEstudiantes($estudiantesNuevos, $idSeccionVincular);
}

///ELIMINAR SECCION SELECCIONADA
if (isset($_POST['eliminarSeccion'])) {
    $idSeccionEliminar= $_POST['idSeccionEliminar'];

    $objeto->eliminarSeccion($idSeccionEliminar);
}

///ELIMINAR ESTUDIANTES SECCION SELECCIONADA
if (isset($_POST['eliminarEstSeccion'])) {
    $cedulaEstborrar= $_POST['cedulaEstborrar'];

    $objeto->eliminarEstSeccion($cedulaEstborrar);
}

//ACTUALIZAR INFORMACION DE LOS DATOS DE LA SECCION
if (isset($_POST['actualizarDatosSeccion'])) {
    $nombreSeccionU= $_POST['nombreSeccionU'];
    $nivelSeccionU= $_POST['nivelSeccionU'];
    $idSeccionRefU= $_POST['idSeccionRefU'];

    $objeto->setActualizarDatosSeccion($nombreSeccionU, $nivelSeccionU);
    $objeto->actualizarDatosSeccion($idSeccionRefU);
}
?>