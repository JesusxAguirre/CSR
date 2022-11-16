<?php
session_start();
//destruye la sesion si se tenia una abierta

if ($_SESSION['verdadero'] > 0) {
    
    if (!$_SESSION['permisos']['ecam']['listar'] && $_SESSION['rol'] == 3 || $_SESSION['rol'] == 4) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";

    }
    if (is_file('vista/'. $pagina .'.php')) {
        require_once('modelo/clase_ecam.php');
        $objeto= new ecam();

        $cedula = $_SESSION['cedula'];
        $accion = 'El usuario ha entrado en el apartado de "Listar Materias" de la ECAM';
        $id_modulo = 3;
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