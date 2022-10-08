<?php
session_start();
//destruye la sesion si se tenia una abierta

if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/'. $pagina .'.php')) {
        require_once('modelo/clase_ecam.php');
        $objeto= new ecam();

        $cantidadProfesores = $objeto->cantidadProfesores();
        $cantidadEstudiantes = $objeto->cantidadEstudiantes();

        require_once 'vista/' . $pagina . '.php';
    }

}else {
    echo "<script>
           alert('Inicia sesion ');
           window.location= 'index.php'
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