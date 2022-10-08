<?php
session_start();

require_once('../../modelo/clase_ecam.php');
$objeto = new ecam();

//CANTIDAD DE ESTUDIANTES EN CADA SECCION DE LA ECAM
if (isset($_POST['grafico1'])) {
    
    $json= $objeto->cantidadEstudiantes_seccion();
    
   echo json_encode($json); 
}

//CANTIDAD DE ESTUDIANTES EN CADA SECCION DE LA ECAM
if (isset($_POST['grafico2'])) {
    
    $json= $objeto->cantidadGraduandos_actual();
    
   echo json_encode($json); 
}

?>