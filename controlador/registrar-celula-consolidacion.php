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

use Csr\Modelo\Consolidacion;

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
    if (!$_SESSION['permisos']['casa_sobre_la_roca']['crear']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }
    if (is_file('vista/' . $pagina . '.php')) {
        if (!$_SESSION['permisos']['celula_consolidacion']['crear']) {
            echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
        }
        $objeto = new Consolidacion();

        $matriz_lideres = $objeto->listar_usuarios_N2();
        $matriz_usuarios = $objeto->listar_no_participantes();
        $error = false;
        if (isset($_POST['registrar'])) {
            $cedula_lider = $_POST['codigoLider'];

            $cedula_anfitrion = $_POST['codigoAnfitrion'];
            $cedula_asistente = $_POST['codigoAsistente'];
            $dia = $_POST['dia'];
            $hora = $_POST['hora'];
            $direccion = $_POST['direccion'];
            $participantes = $_POST['participantes'];


            //borrando del array participantes las coicidencias en los valores con las cedulas de lider, anfitrion y asistente
            if (($clave = array_search($cedula_lider, $participantes)) !== false) {
                unset($participantes[$clave]);
            }
            if (($clave = array_search($cedula_anfitrion, $participantes)) !== false) {
                unset($participantes[$clave]);
            }
            if (($clave = array_search($cedula_asistente, $participantes)) !== false) {
                unset($participantes[$clave]);
            }


            $objeto->setConsolidacion($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion, $participantes);

            $error = $objeto->registrar_consolidacion();
        }
        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
?>
