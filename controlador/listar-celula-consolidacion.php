<?php
require_once("modelo/clase_celula_consolidacion.php");
//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new Consolidacion();
   
    $matriz_celula = $objeto->listar_celula_consolidacion();


    $matriz_lideres = $objeto->listar_usuarios_N2();
    $matriz_usuarios = $objeto->listar_usuarios_N1();

    if(isset($_POST['buscar'])){
  

    }
      
    if(isset($_POST['update'])){
        $cedula_lider = $_POST['codigoLider'];
        $cedula_anfitrion= $_POST['codigoAnfitrion'];
        $cedula_asistente = $_POST['codigoAsistente'];
        $dia = $_POST['dia'];
        $hora = $_POST['hora'];
        $codigo = $_POST['codigo'];
        $id = $_POST['id'];

        $objeto->setDatos2($cedula_lider,$cedula_anfitrion,$cedula_asistente,$dia,$hora,$codigo,$id);

        $objeto->update_consolidacion();
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