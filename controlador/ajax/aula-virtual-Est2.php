<?php
require_once("../../vendor/autoload.php");

session_start();
use Csr\Modelo\Ecam;
$objeto = new Ecam();

if (isset($_POST['comprobarBoletin'])) {
    $fechaCierre = $objeto->fechaCierre_seccion();
    echo json_encode($fechaCierre);
}

?>