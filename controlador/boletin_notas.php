<?php
session_start();

if($_SESSION['verdadero'] > 0){
    if (is_file('vista/'.$pagina.'.php')) {
        require_once('modelo/clase_ecam.php');
        $objeto= new ecam();

        $listarBotones= $objeto->listarSeccionesON();
        
        

        
        require_once 'vista/'.$pagina.'.php';
    }

} else { 
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