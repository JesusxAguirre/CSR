<?php
session_start();
//destruye la sesion si se tenia una abierta
require_once ('modelo/clase_ecam.php');

if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/'. $pagina .'.php')) {
        $objeto= new ecam;

        $profesores = $objeto->listarProfesores();

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