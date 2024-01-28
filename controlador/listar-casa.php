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
    http_response_code(403);
    echo "<script>
    alert('La sesión ha expirado');
    window.location= 'index.php'
    </script>";
    die();
}

$_SESSION['LAST_ACTIVITY'] = time();  // Actualiza el último momento de actividad

use Csr\Modelo\LaRoca;
use PhpParser\Node\Stmt\Echo_;

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

//APARTADO APLICACION MOVIL
$headers = apache_request_headers();
//If para aplicacion movil
if (isset($headers['apikey']) && $headers['apikey'] == $_SESSION['api-key']) {
    if (isset($_SESSION['verdadero']) && $_SESSION['verdadero'] > 0) {
        if (!$_SESSION['permisos']['casa_sobre_la_roca']['listar']) {
            http_response_code(403);
            echo json_encode(array('msj' => 'No tienes los permisos', 'status_code' => 403));
            die();
        }

        $objeto_casa = new LaRoca();

        //$matriz_csr = $objeto_casa->listar_casas_la_roca();
        $matriz_csr = $objeto_casa->listar_casas_la_roca_por_usuario();

        header('Content-Type: application/json');

        echo json_encode($matriz_csr);

        die();
    }
}
/////////////////////////////////


if (isset($_SESSION['verdadero'])  && $_SESSION['verdadero'] > 0) {
    if (!$_SESSION['permisos']['casa_sobre_la_roca']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }
    if (is_file('vista/' . $pagina . '.php')) {

        $objeto = new LaRoca();

        $matriz_lideres = $objeto->listar_usuarios_N2();

        if (isset($_POST['id'])) {
            $id = trim($_POST['id']);
            $cedula_lider = trim($_POST['lider']);
            $dia = strtolower(trim($_POST['dia']));
            $hora = trim($_POST['hora']);
            $nombre_anfitrion = strtolower(trim($_POST['anfitrion']));
            $telefono_anfitrion = trim($_POST['telefono_anfitrion']);
            $cantidad = trim($_POST['cantidad']);
            $direccion = strtolower(trim($_POST['direccion']));

            $objeto->security_validation_inyeccion_sql([$id, $dia, str_replace(" ", "", $nombre_anfitrion), $telefono_anfitrion, $cantidad, str_replace(" ", "", $direccion)]);
            //validando estructura de codigo ademas sepaprando sola la cedula del codigo, para luego validar la cedula
            $objeto->security_validation_codigo([$cedula_lider]);
            $cedula_lider = explode('-', $cedula_lider);
            $cedula_lider = $cedula_lider[0];

            $objeto->security_validation_cedula($cedula_lider);
            $objeto->security_validation_numero($id);
            $objeto->security_validation_caracteres([$dia, $nombre_anfitrion, $direccion]);
            $objeto->security_validation_hora($hora);
            $objeto->security_validation_telefono($telefono_anfitrion);
            $objeto->security_validation_cantidad([$cantidad]);

            $objeto->setActualizar($cedula_lider, $nombre_anfitrion, $telefono_anfitrion, $cantidad, $direccion, $dia, $hora, $id);
            $objeto->actualizar_CSR();
        }

        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
?>
