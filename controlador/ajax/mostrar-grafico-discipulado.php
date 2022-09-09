<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();

$fecha_inicio = $_GET['fecha_inicio'];
$fecha_final = $_GET['fecha_final'];

$resultado = $objeto->listar_asistencias_meses($fecha_inicio, $fecha_final);

print_r( json_encode($resultado, JSON_NUMERIC_CHECK));
?>
