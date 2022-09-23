<?php
require_once('../../modelo/clase_usuario.php');
$objeto = new Usuarios();
$cedula = $_POST['cedula'];

$resultado = $objeto->buscar_cedula($cedula);

echo $resultado;
?>