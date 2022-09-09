<?php
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam();

//AGREGANDO MATERIAS
if (isset($_POST['agregarMateria'])) {
    $nombreMateria= $_POST['nombreMateria'];
    $nivelSeleccionado= $_POST['seleccionarNivel'];
    $cedulaProf= $_POST['cedulaProf'];
    $objeto->setMaterias(ucfirst($nombreMateria), $nivelSeleccionado, $cedulaProf);
    $objeto->agregarMaterias();
}


//ELIMINANDO MATERIAS
if (isset($_POST['botonEliminar'])) {
    $idMateria= $_POST['idMateria'];

    $objeto->eliminarMateria($idMateria);
}


//ACTUALIZANDO MATERIAS
if (isset($_POST['actualizarMateria'])) {
    $idMateria2= $_POST['idMateria2'];
    $nombreMateria2= $_POST['nombreMateria2'];
    $nivelSeleccionado2= $_POST['seleccionarNivel2'];

    $objeto->setActualizar($idMateria2, $nombreMateria2, $nivelSeleccionado2);
    $objeto->actualizarMateria();
}



?>


