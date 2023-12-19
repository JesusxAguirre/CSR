<?php

//destruye la sesion si se tenia una abierta
session_start();
use Csr\Modelo\Ecam;

if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/'. $pagina .'.php')) {
        
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