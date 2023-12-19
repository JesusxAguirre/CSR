<?php
require_once("../../vendor/autoload.php");

session_start();

use Csr\Modelo\LaRoca;


if (isset($_SESSION['verdadero']) && $_SESSION['verdadero'] > 0) {
    if (!$_SESSION['permisos']['casa_sobre_la_roca']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }
    $objeto_casa = new LaRoca();


    //$matriz_csr = $objeto_casa->listar_casas_la_roca();
    $matriz_csr = $objeto_casa->listar_casas_la_roca_por_usuario();
    header('Content-Type: application/json');
    
    echo json_encode($matriz_csr);
    die();

} else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
