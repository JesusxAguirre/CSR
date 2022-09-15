<?php
require_once('../../modelo/clase_celula_consolidacion.php');
$objeto = new Consolidacion();
$cedula_participante = $_POST['participante_cedula'];

echo $objeto->eliminar_participantes($cedula_participante);
?>