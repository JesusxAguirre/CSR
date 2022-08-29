<?php
require_once("modelo\clase_cedula_discipulado.php");
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new Discipulado();
   
    $matriz_usuarios = $objeto->listar_codigos();
    $matriz_lideres = $objeto->listar_usuarios_N2();
    if(isset($_POST['registrar'])){
        $cedula_lider = $_POST['codigoLider'];
        $cedula_anfitrion= $_POST['codigoAnfitrion'];
        $cedula_asistente = $_POST['codigoAsistente'];
        $dia = $_POST['dia'];
        $hora = $_POST['hora'];
        $direccion = $_POST['direccion'];
        $participantes = $_POST['participantes'];
       
        $objeto->setDiscipulado($cedula_lider,$cedula_anfitrion,$cedula_asistente,$dia,$hora,$direccion,$participantes);

        $objeto->registrar_discipulado();
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