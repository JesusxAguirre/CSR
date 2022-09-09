<?php
require_once('../../modelo/clase_celula_consolidacion.php');
$objeto = new Consolidacion();

$id = $_GET['codigo_consolidacion'];
$fecha_inicio = $_GET['fecha_inicio'];
$fecha_final = $_GET['fecha_final'];


$matriz_asistencias = $objeto->listar_asistencias($id, $fecha_inicio, $fecha_final);
?>