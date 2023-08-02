<?php 
require_once("../../vendor/autoload.php");

session_start();
use Csr\Modelo\LaRoca;


if(isset( $_SESSION['verdadero'])  && $_SESSION['verdadero'] > 0){
$objeto_casa = new LaRoca();


$matriz_csr = $objeto_casa->listar_casas_la_roca();


header('Content-Type: application/json');
    
echo json_encode($matriz_csr);
}else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
?>