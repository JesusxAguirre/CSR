<?php
require_once("modelo/clase_celula_consolidacion.php");
//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new Consolidacion();
   
    $matriz_lideres = $objeto->listar_usuarios_N2();
    $matriz_usuarios = $objeto->listar_usuarios_N1();
        
    if(isset($_POST['registrar'])){
        $cedula_lider = $_POST['codigoLider'];
         
        $cedula_anfitrion= $_POST['codigoAnfitrion'];
        $cedula_asistente = $_POST['codigoAsistente'];
        $dia = $_POST['dia'];
        $hora = $_POST['hora'];


        $cedula_lider = substr($cedula_lider, 0, 8); //guardando el valor de la cedula del lider
        $cedula_anfitrion = substr($cedula_anfitrion, 0, 8); //guardando el valor de la cedula del lider
        $cedula_asistente = substr($cedula_asistente, 0, 8); //guardando el valor de la cedula del lider
        
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


        $objeto->setDatos($cedula_lider,$cedula_anfitrion,$cedula_asistente,$dia,$hora);

        $objeto->registrar_consolidacion();

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