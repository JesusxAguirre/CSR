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
    $matriz_participantes = $objeto->listar_participantes();
    
      
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
    if(isset($_POST['agregar'])){
        $cedula_lider = $_POST['codigoLider'];
        $cedula_anfitrion= $_POST['codigoAnfitrion'];
        $cedula_asistente = $_POST['codigoAsistente'];
        $participantes = $_POST['participantes'];
        print_r($participantes);
        $id = $_POST['id']; 
        echo "Entra a la funcion" . "<br>";
        echo $cedula_lider . '<br>';
        echo $cedula_anfitrion . '<br>';
        echo $cedula_asistente . '<br>';
        echo $id . '<br>';
        exit;
         //borrando del array participantes las coicidencias en los valores con las cedulas de lider, anfitrion y asistente
         if (($clave = array_search($cedula_lider, $participantes)) !== false) {
            unset($participantes[$clave]);
            
        }
        if (($clave = array_search($cedula_anfitrion, $participantes)) !== false) {
            unset($participantes[$clave]);
            
        }
        if (($clave = array_search($cedula_asistente, $participantes)) !== false) {
            unset($participantes[$clave]);
            
        }
     
    }

    if(isset($_POST['eliminar_participante'])){
        $cedula_participante = $_POST['eliminar_participante'];
      
        $objeto->setParticipante($cedula_participante);

        $objeto->eliminar_participantes();
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
