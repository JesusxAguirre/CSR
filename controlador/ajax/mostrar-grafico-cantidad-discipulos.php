<?php
session_start();
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

$resultado = $objeto->listar_numero_discipulos($fecha_inicio, $fecha_final);

echo json_encode($resultado, JSON_NUMERIC_CHECK);

?>
