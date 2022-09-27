<?php
session_start();

require_once('../../modelo/clase_ecam.php');
$objeto = new ecam();

if (isset($_POST['ver1'])) {
    
    $json= $objeto->ver1();
    
   echo json_encode($json);
}

?>