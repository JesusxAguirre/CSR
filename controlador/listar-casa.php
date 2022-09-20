<?php
require_once("modelo/clase_casa_sobre_la_roca.php");
//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new LaRoca();
   
    $matriz_csr = $objeto->listar_casas_la_roca();
    $matriz_lideres = $objeto->listar_lideres_sin_CSR();

    $actualizar = true;
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $cedula_lider = $_POST['lider'];
        $dia = $_POST['dia'];
        $hora = $_POST['hora'];
        $nombre_anfitrion = $_POST['anfitrion'];
        $telefono_anfitrion = $_POST['telefono_anfitrion'];
        $cantidad = $_POST['cantidad'];
        $direccion = $_POST['direccion'];
        $actualizar = false;
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
