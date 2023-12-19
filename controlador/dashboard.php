<?php

//destruye la sesion si se tenia una abierta
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

use Csr\Modelo\LaRoca;
use Csr\Modelo\Discipulado;
use Csr\Modelo\ecam;

if (isset($_SESSION['verdadero']) && $_SESSION['verdadero'] > 0) {

    if (!$_SESSION['permisos']['dashboard']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }
    if (is_file('vista/' . $pagina . '.php')) {
        $objeto = new LaRoca();
        $objeto_discipulado = new Discipulado();
        $objeto_ecam = new ecam();
        $matriz_lideres = $objeto->listar_lideres_sin_CSR();
        $reporte = $objeto->reporte_dashboard();
        $casas_abiertas = $objeto->contar_CSR();
        $lideres_con_CSR = $objeto->contar_lideres_CSR();
        $lider_mes = $objeto->contar_asistencias_CSR();
        $cantidad_discipulos = $objeto_discipulado->contar_discipulos();
        $cantidad_estudiantes = $objeto_ecam->cantidadEstudiantes();
        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
