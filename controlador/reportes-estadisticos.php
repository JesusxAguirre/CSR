<?php

//destruye la sesion si se tenia una abierta
session_start();
require_once('modelo/clase_celula_consolidacion.php');

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
   
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