<?php
require_once("../../vendor/autoload.php");

session_start();
use Csr\Modelo\Usuarios;
$objeto = new Usuarios();
$cedula = $_POST['cedula'];

$resultado = $objeto->buscar_cedula_perfil($cedula);

echo $resultado;
?>