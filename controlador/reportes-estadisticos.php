<?php
session_start();
require_once('modelo/clase_celula_consolidacion.php');
require_once("modelo/clase_casa_sobre_la_roca.php");
if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
   $objeto = new Consolidacion();
   $objeto2 = new LaRoca();
   
   $matriz_lideres = $objeto->listar_usuarios_N2();
   $matriz_csr = $objeto2->listar_casas_la_roca_sin_status();

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