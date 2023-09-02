<?php
//destruye la sesion si se tenia una abierta
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

use Csr\Modelo\Evento;

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

        $objeto = new Evento();

        // Crear Evento
        if (isset($_POST['create']) && $_SESSION['permisos']['agenda']['crear']) {
            $titulo      = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $inicio      = $_POST['inicio'];
            $final       = $_POST['final'];
            $oculto      = $_POST['oculto'] ?? '0';

            $objeto->setDatos($titulo, $descripcion, $inicio, $final, $oculto);

            if ($objeto->create_evento()) {
                $alert['status'] = true;
                $alert['msg'] = "Evento creado con éxito";
            } else {
                $alert['status'] = 'false';
                $alert = "Ha ocurrido un error al crear el evento";
            }
        }

        // Editar Evento
        if (isset($_POST['edit']) && $_SESSION['permisos']['agenda']['actualizar']) {
            $idEvento    = $_POST['id'];
            $titulo      = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $inicio      = $_POST['inicio'];
            $final       = $_POST['final'];
            $oculto      = $_POST['oculto'] ?? '0';

            $objeto->setDatos($titulo, $descripcion, $inicio, $final, $oculto);

            if ($objeto->update_evento($idEvento)) {
                $alert['status'] = true;
                $alert['msg'] = "Evento modificado correctamente";
            } else {
                $alert['status'] = 'false';
                $alert = "Ha ocurrido un error al modificar el evento";
            }
        }

        // Eliminar Evento
        if (isset($_POST['delete']) && $_SESSION['permisos']['agenda']['eliminar']) {
            $idEvento = $_POST['id'];

            if ($objeto->delete_evento($idEvento)) {
                $alert['status'] = true;
                $alert['msg'] = "Evento eliminado exitosamente";
            } else {
                $alert['status'] = 'false';
                $alert = "Ha ocurrido un error al eliminar el evento";
            }
        }

        $eventos = $objeto->get_eventos();
        if ($_SESSION['permisos']['agenda_oculta']['listar']) {
            $eventosOcultos = $objeto->get_eventosOcultos();
        }


        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           alert('Inicia sesion ');
           window.location= 'index.php'
</script>";
}
