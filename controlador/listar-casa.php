<?php
use Csr\Modelo\LaRoca;
//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
    if (!$_SESSION['permisos']['casa_sobre_la_roca']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";

    }
if (is_file('vista/'.$pagina.'.php')) {
    
    $objeto = new LaRoca();
   
 
    $matriz_lideres = $objeto->listar_usuarios_N2();



    $actualizar = true;
    if(isset($_POST['id'])){
        $id = trim($_POST['id']); 
        $cedula_lider = trim($_POST['lider']); 
        $dia = strtolower(trim($_POST['dia'])); 
        $hora = trim($_POST['hora']); 
        $nombre_anfitrion = strtolower(trim($_POST['anfitrion'])); 
        $telefono_anfitrion = trim($_POST['telefono_anfitrion']); 
        $cantidad = trim($_POST['cantidad']); 
        $direccion = strtolower(trim($_POST['direccion'])); 
        

        $objeto->security_validation_inyeccion_sql([$id,$dia,$hora,$nombre_anfitrion,$telefono_anfitrion,$cantidad,$direccion,$cedula_lider]);
        
        $objeto->security_validation_numero($id);
        $objeto->security_validation_cedula($cedula_lider);
        $objeto->security_validation_caracteres([$dia,$nombre_anfitrion,$direccion]);
      
        $objeto->security_validation_telefono($telefono_anfitrion);
        
        $objeto->security_validation_cantidad($cantidad);

        $objeto->setActualizar($cedula_lider,$nombre_anfitrion,$telefono_anfitrion,$cantidad,$direccion,$dia,$hora,$id);

        $objeto->actualizar_CSR();
        $actualizar = false;
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
