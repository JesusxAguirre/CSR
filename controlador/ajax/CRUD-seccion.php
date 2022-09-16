<?php
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam();

if (isset($_POST['crear'])) {
    $nombreSeccion= $_POST['nombreSeccion'];
    $nivelSeccion= $_POST['nivelSeccion'];
    $idMateriaSeccion = $_POST['idMateriaSeccion'];
    $cedulaProfSeccion= $_POST['cedulaProfSeccion'];
    $cedulaEstSeccion= $_POST['cedulaEstSeccion'];

    //$objeto->setSeccion($nombreSeccion, $nivelSeccion, $cedulaProfSeccion, $cedulaEstSeccion, $idMateriaSeccion);

    foreach ($cedulaProfSeccion as $key1) {
        echo $key1;
    }


    
}
?>