<?php
session_start();
require_once("modelo/clase_usuario.php");
$matriz_usuario = $objeto->mi_perfil();
if($_SESSION['verdadero'] > 0){

    if (is_file('vista/'.$pagina.'.php')) {
    
        
        require_once 'vista/'.$pagina.'.php';
    }

} else { 
    echo "<script>
    alert('Inicia sesion ');
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