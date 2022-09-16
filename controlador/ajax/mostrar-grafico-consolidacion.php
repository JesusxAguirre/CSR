<?php
require_once('../../modelo/clase_celula_consolidacion.php');
$objeto = new Consolidacion();

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

$resultado = $objeto->listar_cantidad_celulas_consolidacion($fecha_inicio, $fecha_final);

echo json_encode($resultado, JSON_NUMERIC_CHECK);

?>
