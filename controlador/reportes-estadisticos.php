<?php
session_start();
use Csr\Modelo\Consolidacion;
use Csr\Modelo\LaRoca;
if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {

    if (!$_SESSION['permisos']['reporte_estadistico_celulas']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";

    }
   $objeto = new Consolidacion();
   $objeto2 = new LaRoca();
   
   $matriz_lideres = $objeto->listar_usuarios_N2();
   $matriz_csr = $objeto2->listar_casas_la_roca_sin_status();

    require_once 'vista/'.$pagina.'.php';
}
} else{ 
    echo "<script>
           window.location= 'error.php'
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