<?php
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam();

//AGREGANDO MATERIAS
if (isset($_POST['agregarMateria'])) {
    $nombreMateria= $_POST['nombreMateria'];
    $nivelSeleccionado= $_POST['seleccionarNivel'];

    $objeto->setMaterias($nombreMateria, $nivelSeleccionado);
    $objeto->agregarMaterias();
}


//ELIMINANDO MATERIAS
if ($_POST['botonEliminar']) {
    $idMateria= $_POST['idMateria'];

    $objeto->eliminarMateria($idMateria);
}


//ACTUALIZANDO MATERIAS


?>


