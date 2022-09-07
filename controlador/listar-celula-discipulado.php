<?php
require_once("modelo/clase_celula_discipulado.php");
//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new Discipulado();
   
    $matriz_celula = $objeto->listar_celula_discipulado();
    $matriz_participantes = $objeto->listar_participantes();

    $matriz_usuarios = $objeto->listar_no_participantes();


    if(isset($_POST['update'])){
        $cedula_lider = $_POST['codigoLider'];
        $cedula_anfitrion= $_POST['codigoAnfitrion'];
        $cedula_asistente = $_POST['codigoAsistente'];
        $dia = $_POST['dia'];
        $hora = $_POST['hora'];
     
        $id = $_POST['id']; 


        $objeto->setActualizar($cedula_lider,$cedula_anfitrion,$cedula_asistente,$dia,$hora,$id);

        $objeto->actualizar_discipulado();
    }
    if(isset($_POST['agregar_participantes'])){
     
        $participantes = $_POST['participantes'];
        $id = $_POST['id']; 
     
        $objeto->setParticipantes($participantes,$id);
       
        $objeto->agregar_participantes();
    }
    if(isset($_POST['eliminar_participante'])){
        $cedula_participante = $_POST['eliminar_participante'];

        
        $objeto->setParticipante($cedula_participante);

        $objeto->eliminar_participantes();
    }
    if(isset($_POST['agregar_asistencia'])){
    $fecha = $_POST['fecha'];
    $participantes = $_POST['asistentes'];

    echo $fecha . "<br>";
    print_r($participantes);
    exit;
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
