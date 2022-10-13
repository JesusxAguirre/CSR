<?php
require_once("modelo/clase_correo.php");

//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
    if ($_SESSION['rol'] != 1) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";

    }
if (is_file('vista/'.$pagina.'.php')) {
  $objeto = new Correo();


    $matriz_correo = $objeto->listar_correos();


    if(isset($_POST['enviar'])){
        $asunto = $_POST['html'];
        $destinatario = $_POST['usuario'];
        $mensaje = $_POST['mensaje']; 
        
        $objeto->prueba($destinatario,$asunto,$mensaje);
    }
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