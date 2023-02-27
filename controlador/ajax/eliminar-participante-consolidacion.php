<?php
require_once("../../vendor/autoload.php");
use Csr\Modelo\Consolidacion;
$objeto = new Consolidacion();
$cedula_participante = $_POST['participante_cedula'];

echo $objeto->eliminar_participantes($cedula_participante);
?>