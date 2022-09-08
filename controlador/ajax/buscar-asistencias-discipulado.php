<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado;

$codigo_discipulado = $_GET['codigo_discipulado'];
$fecha_inicio = $_GET['fecha_inicio'];
$fecha_final = $_GET['fecha_final'];

echo $codigo_discipulado . "<br>";
echo $fecha_inicio . "<br>";
echo $fecha_final . "<br>";
exit;
?>