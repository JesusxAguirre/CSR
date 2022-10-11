<?php
require_once('../../modelo/clase_usuario.php');
$objeto = new Usuarios();
$correo = $_POST['correo'];

$resultado = $objeto->buscar_correo_perfil($correo);

echo $resultado;
?>