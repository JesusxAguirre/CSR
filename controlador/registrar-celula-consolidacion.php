<?php
require_once("modelo/clase_celula_consolidacion.php");
//destruye la sesion si se tenia una abierta
session_start();
if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new Consolidacion();
   
    $matriz_lideres = $objeto->listar_usuarios_N2();
    $matriz_usuarios = $objeto->listar_no_participantes();
    $error = true;
    if(isset($_POST['registrar'])){
        $cedula_lider = $_POST['codigoLider'];
         
        $cedula_anfitrion= $_POST['codigoAnfitrion'];
        $cedula_asistente = $_POST['codigoAsistente'];
        $dia = $_POST['dia'];
        $hora = $_POST['hora'];
        $direccion = $_POST['direccion'];
        $participantes = $_POST['participantes'];
    
       
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
       
      
        $objeto->setConsolidacion($cedula_lider,$cedula_anfitrion,$cedula_asistente,$dia,$hora,$direccion,$participantes);

        $objeto->registrar_consolidacion();
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