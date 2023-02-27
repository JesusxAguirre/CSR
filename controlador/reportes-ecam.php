<?php
session_start();
//destruye la sesion si se tenia una abierta
use Csr\Modelo\Ecam;
if ($_SESSION['verdadero'] > 0) {
    
    if (!$_SESSION['permisos']['reporte_estadistico_ecam']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";

    }
    if (is_file('vista/'. $pagina .'.php')) {
        
        $objeto= new Ecam();

        $cantidadProfesores = $objeto->cantidadProfesores();
        $cantidadEstudiantes = $objeto->cantidadEstudiantes();

        $cedula = $_SESSION['cedula'];
        $accion = 'El usuario ha entrado a "Reportes Estadisticos de la ECAM"';
        $id_modulo = 7;
        $objeto->set_registrar_bitacora($cedula, $accion, $id_modulo);
        require_once 'vista/' . $pagina . '.php';
    }

}else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
if (isset($_POST['cerrar'])) {
    session_destroy();
    echo "<script>
    alert('Sesion Cerrada');
    window.location= 'index.php'
</script>";
}

?>