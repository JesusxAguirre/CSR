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
    if (!$_SESSION['permisos']['gestionar_roles']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }
    if (is_file('vista/' . $pagina . '.php')) {

        $objeto = new Roles();

        // Actualizar permisos
        if (isset($_POST['rol'])) {
            $idRol       = $_POST['idRol'];
            $permisosRol = $_POST['permisos'];

            if ($objeto->update_permisos($idRol, $permisosRol)) {
                $alert['status'] = true;
                $alert['msg'] = "Permisos modificados correctamente";
            } else {
                $alert['status'] = 'false';
                $alert['msg'] = "Ha ocurrido un error al modificar los permisos";
            }

            //si el rol que se esta modificando es el mismo que el que esta iniciado session se consultan los permisos de nuevo
            if ($_SESSION['rol'] == $idRol) {
                $_SESSION['permisos'] = $objeto->get_permisos($idRol);
            }
        }

        // Crear rol
        if (isset($_POST['create'])) {
            $nombreRol = strtolower(trim($_POST['nombre']));
            $descripcionRol = strtolower(trim($_POST['descripcion']));

            $objeto->security_validation_caracteres([$nombreRol]);
            $objeto->security_validation_inyeccion_sql([$nombreRol]);
            $validacion = $objeto->validar_crear_rol($nombreRol);

            if ($validacion > 0) {
                echo json_encode(array('status' => 'false', 'msj' => 'El rol ingresado ya existe'));
            } else {
                $objeto->setDatos($nombreRol, $descripcionRol);
                $objeto->create_rol();
                echo json_encode(array('status' => 'true', 'msj' => 'Rol creado exitosamente'));
            }
            die();
        }

        // Editar rol
        if (isset($_POST['edit'])) {
            $idRol = trim($_POST['id']);
            $nombreRol = strtolower($_POST['nombre']);
            $descripcionRol = strtolower($_POST['descripcion']);

            $objeto->security_validation_caracteres([str_replace(' ', '', $nombreRol), str_replace(' ', '', $descripcionRol)]);
            $objeto->security_validation_inyeccion_sql([str_replace(' ', '', $nombreRol), str_replace(' ', '', $descripcionRol)]);
            $validacion = $objeto->validar_crear_rol($nombreRol);

            if ($validacion > 0) {
                $alert['status'] = 'false';
                $alert['msg'] = "El rol ingresado ya existe";
            } else {
                $objeto->setUpdatedRol($nombreRol, $descripcionRol);
                $objeto->update_rol($idRol);
                $alert['status'] = true;
                $alert['msg'] = "Rol modificado correctamente";
            }
        }

        if (isset($_POST['delete'])) {
            $id = $_POST['id'];

            $validacion = $objeto->validar_eliminar_rol($id);

            if ($validacion > 0) {
                echo json_encode('denegado');
            } else {
                $mensaje = $objeto->delete_rol($id);
                echo json_encode('eliminado');
            }
            die();
        }

        $roles   = $objeto->get_roles();
        $modulos = $objeto->get_modulos();

        foreach ($roles as $rol) {
            $permisos[$rol['nombre']] = $objeto->get_permisos($rol['id']);
        }

        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
    window.location= 'error.php'
    </script>";
}
