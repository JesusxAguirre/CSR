<?php

//destruye la sesion si se tenia una abierta
session_start();
use Csr\Modelo\Consolidacion;
if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {
     //Validacion de permisos
     if (!$_SESSION['permisos']['celula_consolidacion']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=dashboard'
		</script>";

    }    



      $objeto = new Consolidacion();

      $matriz_codigo = $objeto->listar_celula_consolidacion();
    
        require_once 'vista/' . $pagina . '.php';
    }
} else {
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