<?php
require_once("modelo/clase_casa_sobre_la_roca.php");

//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new LaRoca();
    $matriz_lideres = $objeto->listar_lideres_sin_CSR();
    $reporte = $objeto->reporte_dashboard();
    $casas_abiertas = $objeto->contar_CSR();
    $lideres_con_CSR = $objeto->contar_lideres_CSR();
    
    require_once 'vista/'.$pagina.'.php';
}
} else{ 
    echo "<script>
           alert('Inicia sesion ');
           window.location= 'index.php'
</script>";
    

    }
if(isset( $_POST['cerrar'])){
    session_destroy();
    echo "<script>
    alert('Sesion Cerrada');
    window.location= 'index.php'
</script>";
}     
?>