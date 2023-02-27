<?php
require_once("../../vendor/autoload.php");

session_start();
use Csr\Modelo\Usuarios;
$objeto = new Usuarios();
$correo = $_POST['correo'];

$resultado = $objeto->buscar_correo_perfil($correo);

echo $resultado;
?>