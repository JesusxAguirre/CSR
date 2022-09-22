<?php
require_once('../../modelo/clase_usuario.php');
$objeto = new Usuarios();
$cedula = $_POST['cedula'];

echo $objeto->buscar_cedula($cedula);
?>