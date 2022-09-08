<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado;

$id = $_GET['codigo_discipulado'];
$fecha_inicio = $_GET['fecha_inicio'];
$fecha_final = $_GET['fecha_final'];


$matriz_asistencias = $objeto->listar_asistencias($id,$fecha_inicio,$fecha_final);

print_r($matriz_asistencias);
exit;
?>