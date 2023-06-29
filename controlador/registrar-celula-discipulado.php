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
        $dia = strtolower( trim($_POST['dia']));
        $hora = trim($_POST['hora']);
        $direccion = strtolower( trim($_POST['direccion']));
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

        $objeto->security_validation_inyeccion_sql([$dia,str_replace(" ","",$direccion)]);

         
        $objeto->security_validation_codigo($participantes);
        $objeto->security_validation_codigo([$cedula_lider,$cedula_anfitrion,$cedula_asistente]);


        $cedula_lider = explode('-',$cedula_lider)[0];
        $cedula_anfitrion = explode('-',$cedula_anfitrion)[0];
        $cedula_asistente = explode('-',$cedula_asistente)[0];

        $objeto->security_validation_cedula([$cedula_lider,$cedula_anfitrion,$cedula_asistente]);
         
        $objeto->security_validation_caracteres([$dia,$direccion]);
        $objeto->security_validation_hora($hora);
      
    
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