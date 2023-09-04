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
    if (is_file('vista/' . $pagina . '.php')) {

        //Validacion de permisos
        if (!$_SESSION['permisos']['celula_consolidacion']['listar']) {
            echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=dashboard'
		</script>";
        }


        $objeto = new Consolidacion();

        $matriz_celula = $objeto->listar_celula_consolidacion();


        $matriz_lideres = $objeto->listar_usuarios_N2();
        $matriz_usuarios = $objeto->listar_no_participantes();

        $actualizar = true;
        if (isset($_POST['update'])) {
            $cedula_lider = $_POST['codigoLider'];
            $cedula_anfitrion = $_POST['codigoAnfitrion'];
            $cedula_asistente = $_POST['codigoAsistente'];
            $dia = $_POST['dia'];
            $hora = $_POST['hora'];
            $direccion = $_POST['direccion'];
            $id = $_POST['id'];

            $objeto->setActualizar($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion, $id);

            $objeto->update_consolidacion();
            $actualizar = false;
        }

        //agregar participantes
        $registrar_participante = true;
        if (isset($_POST['agregar_participantes'])) {

            $participantes = $_POST['participantes'];
            $id = $_POST['id'];

            $objeto->setParticipantes($participantes, $id);

            $objeto->agregar_participantes();
            $registrar_participante = false;
        }


        //registrar asistencia
        $registrar_asistencia = true;
        if (isset($_POST['agregar_asistencia'])) {
            $fecha = $_POST['fecha'];
            $asistentes = $_POST['asistentes'];
            $id = $_POST['id'];

            $objeto->setAsistencias($asistentes, $id, $fecha);

            $objeto->registrar_asistencias();
            $registrar_asistencia = false;
        }
        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
?>
