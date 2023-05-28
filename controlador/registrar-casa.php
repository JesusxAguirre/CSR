<?php
use Csr\Modelo\LaRoca;

//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    $objeto = new LaRoca();

    $matriz_lider = $objeto->listar_usuarios_N2();

    //registrando casa sobre la roca

    
    if(isset($_POST['lider'])){

        $cedula_lider = trim($_POST['lider']);
        
        $direccion = strtolower(trim($_POST['direccion'])); 
        $nombre_anfitrion = strtolower(trim($_POST['anfitrion'])); 
        $telefono_anfitrion = trim($_POST['telefono']); 
        
        $dia = strtolower(trim($_POST['dia'])); 
        $hora = trim($_POST['hora']); 
        $cantidad_integrantes = trim($_POST['integrantes']);

        $objeto->security_validation_inyeccion_sql([$cedula_lider,$dia,str_replace(" ","",$nombre_anfitrion) ,$telefono_anfitrion,$cantidad,str_replace(" ","",$direccion)]);
        
         
         $objeto->security_validation_cedula($cedula_lider);
         
         $objeto->security_validation_caracteres([$dia,$nombre_anfitrion,$direccion]);
         $objeto->security_validation_hora($hora);
       
         $objeto->security_validation_telefono($telefono_anfitrion);
         
         $objeto->security_validation_cantidad($cantidad);
 

        $objeto->setCSR($cedula_lider,$direccion,$nombre_anfitrion,$telefono,$dia,$hora,$cantidad_integrantes);

        $objeto->registrar_CSR();
       
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