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

use Csr\Modelo\Discipulado;
use PhpParser\Node\Stmt\Else_;

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

        if (!$_SESSION['permisos']['celula_discipulado']['listar']) {
            echo "<script>
            alert('No tienes los permisos para este modulo');
            window.location= 'index.php?pagina=dashboard'
            </script>";
        }

        $objeto = new Discipulado();



        $matriz_lideres = $objeto->listar_usuarios_N2();
        $matriz_usuarios = $objeto->listar_no_participantes();

        //actualizar celula

        if (isset($_POST['update'])) {
            $cedula_lider = trim($_POST['codigoLider']);
            $cedula_anfitrion = trim($_POST['codigoAnfitrion']);
            $cedula_asistente = trim($_POST['codigoAsistente']);
            $dia = strtolower(trim($_POST['dia']));
            $hora = trim($_POST['hora']);
            $direccion = strtolower($_POST['direccion']);
            $id = trim($_POST['id']);

            $objeto->security_validation_inyeccion_sql([$id, $dia, str_replace(" ", "", $direccion)]);

            $objeto->security_validation_codigo([$cedula_lider, $cedula_anfitrion, $cedula_asistente]);



            $objeto->setActualizar($cedula_lider, $cedula_anfitrion, $cedula_asistente, $dia, $hora, $direccion, $id);

            $objeto->actualizar_discipulado();
        }

        if (isset($_GET['listar_celula_disicpulado'])) {
            $matriz_celula = $objeto->listar_celula_discipulado();

            echo json_encode($matriz_celula);

            die();
        }


        //BUSCAR PARTICIPANTES DE CELULA

        if (isset($_GET['buscar_participantes'])) {
            $matriz_usuarios = $objeto->listar_no_participantes();


            http_response_code(200);

            echo json_encode($matriz_usuarios);
            die();
        }

        //agregar participantes
        if (isset($_POST['participantes'])) {

            $participantes = $_POST['participantes'];
            $id = trim($_POST['id']);

            $objeto->security_validation_inyeccion_sql([$id]);
            $objeto->security_validation_codigo($participantes);


            $objeto->setParticipantes($participantes, $id);

            $objeto->agregar_participantes();
        }


        //registrar asistencia
        if (isset($_POST['agregar_asistencia'])) {
            $fecha = trim($_POST['fecha']);
            $asistentes = trim($_POST['asistentes']);
            $id = trim($_POST['id']);

            $objeto->setAsistencias($asistentes, $id, $fecha);

            $objeto->registrar_asistencias();
            $registrar_asistencia = false;
        }

        if (isset($_POST['cedula_discipulo'])) {

            $cedula_discipulo = trim($_POST['cedula_discipulo']);
            $nivel = trim($_POST['nivel']);
            $nivel_actual = trim($_POST['codigo_discipulo']);

            if (ctype_digit($cedula_discipulo) && ($nivel == "N1" or $nivel == "N2") && ($nivel_actual == "N1" or $nivel_actual == "N2")) {

                $response = $objeto->editar_discipulo_nivel($cedula_discipulo, $nivel_actual, $nivel);
                echo json_encode(array("response" => $response));
                return true;
            } else {
                echo json_encode(array("response" => 0));

                return false;
            }
        }
        require_once 'vista/' . $pagina . '.php';
    }
} else {

    require_once 'error.php';

    http_response_code(403);
}
