<?php

session_start();

// Verificar la expiración del tiempo de la sesiónx
$time_limit = 3600;  // Establecemos el límite de tiempo en segundos, por ejemplo, 1800 segundos = 30 minutos
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $time_limit)) {
    // El tiempo de sesión ha expirado

    // Regenera el ID de sesión antes de destruirla
    session_regenerate_id(true);

    // Desestablece todas las variables de sesión
    $_SESSION = array();

    session_destroy();  // Destruye la sesión
    echo "<script>
    alert('La sesión ha expirado');
    window.location= 'index.php'
    </script>";

    http_response_code(403);
    echo json_encode(array("msj" => "Sesion expirada", "status_code" => 403));
    die();
}

$_SESSION['LAST_ACTIVITY'] = time();  // Actualiza el último momento de actividad

use Csr\Modelo\Consolidacion;
use Csr\Modelo\LaRoca;

if (isset($_POST['cerrar'])) {

    // Regenera el ID de sesión antes de destruirla
    session_regenerate_id(true);

    // Desestablece todas las variables de sesión
    $_SESSION = array();

    session_destroy();

    http_response_code(200);
    echo json_encode(array('msj' => 'Ha cerrado sesion con correctamente. Vuelva pronto', 'status' => 200));
    die();
}

if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {

        if (!$_SESSION['permisos']['reporte_estadistico_celulas']['listar']) {
            echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
        }
        $objeto = new Consolidacion();
        $objeto2 = new LaRoca();

        $matriz_lideres = $objeto->listar_usuarios_N2();
        $matriz_csr = $objeto2->listar_casas_la_roca_sin_status();

        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
?>
