<?php
require_once("modelo/clase_casa_sobre_la_roca.php");
//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new LaRoca();
    $matriz_csr = $objeto->listar_casas_la_roca_por_usuario();
    $error = true;
    if(isset($_POST['registrar'])){

        $csr = $_POST['CSR'];
        $hombres = $_POST['hombres'];
        $mujeres = $_POST['mujeres'];
        $niños = $_POST['niños'];
        $confesiones = $_POST['confesiones'];
        $observaciones = $_POST['observaciones'];

        print_r($csr) . "<br>";
        echo $hombres . "<br>";
        echo $mujeres . "<br>";
        echo $niños . "<br>";
        echo $confesiones . "<br>";
        echo $observaciones . "<br>";
        exit;
        $objeto->setCSR($cedula_lider,$direccion,$nombre_anfitrion,$telefono,$dia,$hora,$cantidad_integrantes);

        $objeto->registrar_CSR();
        $error = false;
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