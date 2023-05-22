<?php 
require_once("../../vendor/autoload.php");

session_start();
use Csr\Modelo\LaRoca;

$objeto_casa = new LaRoca();


$matriz_csr = $objeto_casa->listar_casas_la_roca();


header('Content-Type: application/json');
    
echo json_encode($matriz_csr);
?>