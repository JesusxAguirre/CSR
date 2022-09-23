<?php
//destruye la sesion si se tenia una abierta
require_once('modelo/clase_usuario.php');
session_start();
if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {
        $objeto = new Usuarios();

       $matriz_bitacora = $objeto->listar_bitacora();
       
        require_once 'vista/' . $pagina . '.php';
    }
} else {
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