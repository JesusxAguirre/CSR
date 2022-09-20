<?php
require_once("modelo/clase_correo.php");

//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
  $objeto = new Correo();


    $matriz_correo = $objeto->listar_correos();


    if(isset($_POST['enviar'])){
        $asunto = $_POST['html'];
        $destinatario2 = $_POST['usuario'];
        $mensaje = $_POST['mensaje']; 
        for($i= 0; $i < count($destinatario2); $i++){
            $destinatario = $destinatario2[$i];
        }
        $objeto->prueba($destinatario,$asunto,$mensaje);
    }
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