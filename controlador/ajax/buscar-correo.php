<?php
require_once("../../vendor/autoload.php");

use Csr\Modelo\Usuarios;
$objeto = new Usuarios();
$correo = $_POST['correo'];

$resultado = $objeto->buscar_correo($correo);

echo $resultado;
?>