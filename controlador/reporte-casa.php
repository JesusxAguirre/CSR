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

        $CSR1 = $_POST['CSR'];
        $hombres = $_POST['hombres'];
        $mujeres = $_POST['mujeres'];
        $niños = $_POST['niños'];
        $confesiones = $_POST['confesiones'];
        //colocando en una variable la id de casa sobre la roca fuera de un arreglo
        for($i =0; $i < count($CSR1); $i++){
            $id_casa = $CSR1[$i];
            }
        $CSR = $id_casa;
        $objeto->setReporte($CSR,$hombres,$mujeres,$niños,$confesiones);
        
        $objeto->registrar_reporte_CSR();
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