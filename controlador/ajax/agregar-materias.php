<?php
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam();

if (isset($_POST['agregarMateria'])) {
    $nombreMateria= $_POST['nombreMateria'];
    $nivelSeleccionado= $_POST['seleccionarNivel'];

    $objeto->setMaterias($nombreMateria, $nivelSeleccionado);
    $objeto->agregarMaterias();
    
}
?>