<?php
require_once("modelo/clase_celula_consolidacion.php");
//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new Consolidacion();
   
    $matriz_celula = $objeto->listar_celula_consolidacion();


    $matriz_lideres = $objeto->listar_usuarios_N2();
    $matriz_usuarios = $objeto->listar_no_participantes();
    
    $actualizar = true;
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
        $actualizar = false;
    }

    //agregar participantes
    $registrar_participante = true;
    if(isset($_POST['participantes'])){
        $participantes = $_POST['participantes'];
        $id = $_POST['id']; 
        
        $objeto->setParticipantes($participantes,$id);
       
        $objeto->agregar_participantes();
        $registrar_participante = false;
    }

  
   //registrar asistencia
   $registrar_asistencia = true;
    if(isset($_POST['agregar_asistencia'])){
        $fecha = $_POST['fecha'];
        $asistentes = $_POST['asistentes'];
        $id = $_POST['id']; 
     
        $objeto->setAsistencias($asistentes,$id,$fecha);
    
        $objeto->registrar_asistencias();
        $registrar_asistencia = false;
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
