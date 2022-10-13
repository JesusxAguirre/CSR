<?php
require_once("modelo/clase_casa_sobre_la_roca.php");

//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new LaRoca();

    $matriz_lider = $objeto->listar_usuarios_N2();

    //registrando casa sobre la roca

    $error = true;
    if(isset($_POST['registrar'])){

        $cedula_lider = $_POST['lider'];
        $direccion = $_POST['direccion'];
        $nombre_anfitrion = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $dia = $_POST['dia'];
        $hora = $_POST['hora'];
        $cantidad_integrantes = $_POST['integrantes'];

        $objeto->setCSR($cedula_lider,$direccion,$nombre_anfitrion,$telefono,$dia,$hora,$cantidad_integrantes);

        $objeto->registrar_CSR();
        $error = false;
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