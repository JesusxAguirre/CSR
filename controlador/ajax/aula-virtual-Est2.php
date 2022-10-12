<?php
session_start();
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam;

if (isset($_POST['comprobarBoletin'])) {
    $fechaCierre = $objeto->fechaCierre_seccion();
    echo json_encode($fechaCierre);
}

?>