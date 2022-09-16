<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();

$cedula_lider = $_POST['cedula_lider'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

$resultado = $objeto->listar_numero_discipulos_por_lider($fecha_inicio, $fecha_final,$cedula_lider);

echo json_encode($resultado, JSON_NUMERIC_CHECK);

?>
