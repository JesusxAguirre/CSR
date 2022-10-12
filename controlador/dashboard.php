<?php
require_once("modelo/clase_casa_sobre_la_roca.php");
require_once("modelo/clase_celula_discipulado.php");
require_once('modelo/clase_ecam.php');
//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (!empty($_SESSION['id_seccion'])) {
    echo "<script>
                window.location= 'index.php?pagina=aula-virtual-Est'
        </script>";
}
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new LaRoca();
    $objeto_discipulado = new Discipulado();
    $objeto_ecam = new ecam();
    $matriz_lideres = $objeto->listar_lideres_sin_CSR();
    $reporte = $objeto->reporte_dashboard();
    $casas_abiertas = $objeto->contar_CSR();
    $lideres_con_CSR = $objeto->contar_lideres_CSR();
    $lider_mes = $objeto->contar_asistencias_CSR();
    $cantidad_discipulos = $objeto_discipulado->contar_discipulos();
    $cantidad_estudiantes = $objeto_ecam->cantidadEstudiantes();
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