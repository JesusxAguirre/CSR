<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();
$cedula_participante = $_POST['participante_cedula'];

echo $objeto->eliminar_participantes($cedula_participante);
?>