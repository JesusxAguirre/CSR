<?php
session_start();
require_once("../../vendor/autoload.php");
use Csr\Modelo\Roles;
$objeto = new Roles();
$id = $_POST['id'];

$validacion = $objeto->validar_eliminar_rol($id);

if ($validacion > 0) {
    echo json_encode('denegado');
}else{
    $mensaje = $objeto->delete_rol($id);
    echo json_encode('eliminado');
}

?>