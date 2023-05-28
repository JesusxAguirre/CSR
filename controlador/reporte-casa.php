<?php
use Csr\Modelo\LaRoca;
use PhpParser\Node\Expr\Print_;

//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new LaRoca();
    $matriz_csr = $objeto->listar_casas_la_roca_por_usuario();
    $error = true;
    if(isset($_POST['registrar'])){

        $CSR = $_POST['CSR'][0];
        $hombres = trim($_POST['hombres']);
        $mujeres = trim($_POST['mujeres']);
        $niños = trim($_POST['niños']);
        $confesiones = trim($_POST['confesiones']);
        //colocando en una variable la id de casa sobre la roca fuera de un arreglo
    
        $objeto->security_validation_inyeccion_sql([$CSR,$hombres,$mujeres,$niños,$confesiones]);

        $objeto->security_validation_numero($CSR)

        $objeto->security_validation_cantidad()


        
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
