<?php
session_start();
use Csr\Modelo\Ecam;

if($_SESSION['verdadero'] > 0){
    
    if (!$_SESSION['permisos']['ecam']['listar'] && $_SESSION['rol'] < 2) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";

    }
    if (is_file('vista/'.$pagina.'.php')) {
        
        $objeto= new Ecam();
        
        $cedula = $_SESSION['cedula'];
        $accion = 'El usuario ha entrado al apartado de "Listar Secciones" de la ECAM';
        $id_modulo = 3;
        $objeto->set_registrar_bitacora($cedula, $accion, $id_modulo);
        
        require_once 'vista/'.$pagina.'.php';

    }

} else { 
    echo "<script>
    alert('Inicia sesion ');
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