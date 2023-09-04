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

use Csr\Modelo\Usuarios;
use Csr\Modelo\Roles;

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

    if (!$_SESSION['permisos']['gestionar_usuario']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=dashboard'
		</script>";
    }
    if (is_file('vista/' . $pagina . '.php')) {
        $objeto = new Usuarios();
        $objetoRol = new Roles();

        $matriz_roles = $objetoRol->get_roles();

        //Listar Usuarios
        if (isset($_POST['cargar'])) {
            $listar_usuarios = $objeto->listar();
            $json = array();

            if (!empty($listar_usuarios)) {
                foreach ($listar_usuarios as $key) {
                    $json['data'][] = $key;
                }
            } else {
                $json['data'] = array();
                //Faltaria agregar las demas, pero debes hacerlo descriptivo
            }
            echo json_encode($json);
            die();
        }


        //ACTUALIZAR DATOS DEL USUARIO
        if (isset($_POST['update'])) {
            $cedula = trim($_POST['cedula']);
            $cedula_antigua = trim($_POST['cedula_antigua']);
            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
            $sexo = strtolower(trim($_POST['sexo']));
            $estado_civil = strtolower(trim($_POST['estado_civil']));
            $nacionalidad = strtolower(trim($_POST['nacionalidad']));
            $estado = strtolower(trim($_POST['estado']));
            $telefono = trim($_POST['telefono']);
            $rol = trim($_POST['rol']);

            //Validaciones
            $objeto->security_validation_inyeccion_sql([$nombre, $apellido, $cedula, $sexo, $estado_civil, $nacionalidad, $telefono]);
            $objeto->security_validation_caracteres([$nombre, $apellido]);
            $objeto->security_validation_cedula($cedula);
            $objeto->security_validation_cedula($cedula_antigua);
            $objeto->security_validation_fecha_nacimiento($fecha_nacimiento);
            $objeto->security_validation_sexo($sexo);
            $objeto->security_validation_estado_civil($estado_civil);
            $objeto->security_validation_nacionalidad($nacionalidad);
            $objeto->security_validation_estado($estado);

            //Sanitizacion
            $nombre = $objeto->sanitizar_cadenas($nombre);
            $apellido = $objeto->sanitizar_cadenas($apellido);

            $objeto->setUpdate($nombre, $apellido, $cedula, $cedula_antigua, $fecha_nacimiento, $sexo, $estado_civil, $nacionalidad, $estado, $telefono, $rol);
            $objeto->update_usuarios();
            die();
        }

        //DESACTIVANDO USUARIO (EN MANTENIMIENTO)
        if (isset($_POST['eliminar'])) {
            $cedula = $_POST['cedula'];

            $objeto->setEliminar($cedula);

            $eliminar = $objeto->delete_usuarios();
        }


        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'
</script>";
}
?>
