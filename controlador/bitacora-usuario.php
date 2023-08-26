<?php
//destruye la sesion si se tenia una abierta
use Csr\Modelo\Usuarios;
session_start();
if ($_SESSION['verdadero'] > 0) {
    
    if (!$_SESSION['permisos']['bitacora_usuario']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }
    if (is_file('vista/' . $pagina . '.php')) {

        $objeto = new Usuarios();
        
        if (isset($_POST['cargar'])) {
            $listar_bitacora = $objeto->listar_bitacora();
            $json = array();

            if (!empty($listar_bitacora)) {
                foreach ($listar_bitacora as $key) {
                    $json['data'][] = $key;
                }
            } else {
                $json['data']['accion_realizada'] = null;
            }
            echo json_encode($json);
            die();
        }
       
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