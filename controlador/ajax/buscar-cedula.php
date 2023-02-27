<?php
require_once("../../vendor/autoload.php");

use Csr\Modelo\Usuarios;

$objeto = new Usuarios();
$cedula = $_POST['cedula'];

$resultado = $objeto->buscar_cedula($cedula);

echo $resultado;
?>