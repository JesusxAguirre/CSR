<?php
use Csr\Modelo\Discipulado;
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new Discipulado();
   
    $matriz_lideres = $objeto->listar_usuarios_N2();
    $matriz_usuarios = $objeto->listar_no_participantes();
  
    if(isset($_POST['registrar'])){
        $cedula_lider = trim( $_POST['codigoLider']);
        $cedula_anfitrion= trim($_POST['codigoAnfitrion']);
        $cedula_asistente = trim($_POST['codigoAsistente']);
        $dia = trim($_POST['dia']);
        $hora = trim($_POST['hora']);
        $direccion = trim($_POST['direccion']);
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

        $objeto->setDiscipulado($cedula_lider,$cedula_anfitrion,$cedula_asistente,$dia,$hora,$direccion,$participantes);
       
        $objeto->registrar_discipulado();
   

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