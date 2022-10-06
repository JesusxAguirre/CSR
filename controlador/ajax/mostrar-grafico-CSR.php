<?php
session_start();
require_once('../../modelo/clase_casa_sobre_la_roca.php');
$objeto = new LaRoca();

$id_casa = $_POST['id_casa'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

$resultado = $objeto->listar_reporte_CSR($fecha_inicio, $fecha_final,$id_casa);


echo json_encode($resultado, JSON_NUMERIC_CHECK);

?>
