<?php
session_start();

if($_SESSION['verdadero'] > 0){
    
    if (!$_SESSION['permisos']['ecam']['listar'] && $_SESSION['rol'] == 4) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=dashboard'
		</script>";

    }
    if (is_file('vista/'.$pagina.'.php')) {
        require_once('modelo/clase_ecam.php');
        $objeto= new ecam();
        $misNotas= $objeto->listar_misNotas();

        $notificaciones = $objeto->listar_notificacionSeccion();

        
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