<?php

session_start();

// Verificar la expiración del tiempo de la sesiónx
$time_limit = 1800;  // Establecemos el límite de tiempo en segundos, por ejemplo, 1800 segundos = 30 minutos
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

use Csr\Modelo\Discipulado;

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

if (isset($_SESSION['verdadero']) && $_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {
        $objeto = new Discipulado();

        $matriz_lideres = $objeto->listar_usuarios_N2();
        $matriz_usuarios = $objeto->listar_no_participantes();

        if (isset($_POST['registrar'])) {



            $cedula_lider = trim($_POST['codigoLider']);
            $cedula_anfitrion = trim($_POST['codigoAnfitrion']);
            $cedula_asistente = trim($_POST['codigoAsistente']);
            $dia = strtolower(trim($_POST['dia']));
            $hora = trim($_POST['hora']);
            $direccion = strtolower(trim($_POST['direccion']));
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

            $objeto->security_validation_inyeccion_sql([$dia, str_replace(" ", "", $direccion)]);


            $objeto->security_validation_codigo($participantes);
            $objeto->security_validation_codigo([$cedula_lider, $cedula_anfitrion, $cedula_asistente]);


            $cedula_lider = explode('-', $cedula_lider)[0];
            $cedula_anfitrion = explode('-', $cedula_anfitrion)[0];
            $cedula_asistente = explode('-', $cedula_asistente)[0];

            $objeto->security_validation_cedula([$cedula_lider, $cedula_anfitrion, $cedula_asistente]);

            $objeto->security_validation_caracteres([$dia, $direccion]);
            $objeto->security_validation_hora($hora);


            $objeto->setDiscipulado($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion, $participantes);

            $objeto->registrar_discipulado();
        }
        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
?>
