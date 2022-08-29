<?php
require_once('modelo/clase_ecam.php');
session_start();

if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {

        //instanciando objeto y llamada de metodo para listar usuarios
        $objeto = new Ecam();
        $matriz_usuarios = $objeto->listar_usuarios();
        
        require_once 'vista/' . $pagina . '.php';
    } else {
        echo "Pagina en contruccion";
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