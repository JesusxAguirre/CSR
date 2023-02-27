<?php

//destruye la sesion si se tenia una abierta
session_start();
use Csr\Modelo\Discipulado;
if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {
      $objeto = new Discipulado();

      $matriz_codigo = $objeto->listar_celula_discipulado_por_usuario();
    
        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           alert('Inicia sesion ');
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