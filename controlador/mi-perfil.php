<?php

//destruye la sesion si se tenia una abierta
session_start();

// Verificar la expiración del tiempo de la sesiónx
$time_limit = 3600;  // Establecemos el límite de tiempo en segundos, por ejemplo, 3600 segundos = 1 hora
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $time_limit)) {
    // El tiempo de sesión ha expirado
    
    // Regenera el ID de sesión antes de destruirla
    session_regenerate_id(true);

    // Desestablece todas las variables de sesión
    $_SESSION = array();

    session_destroy();  // Destruye la sesión

    //Condicional para usarla cuando haya una mejor base. Esto es para la APP MOVIL
    /*if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        // Es una solicitud AJAX
        http_response_code(403);
        echo json_encode(array("msj" => "Sesion expirada"));
    } else {
        // No es una solicitud AJAX
        http_response_code(403);
        echo "<script>
        alert('La sesión ha expirado');
        window.location= 'index.php'
        </script>";
    }*/

    http_response_code(403);
    echo "<script>
        alert('La sesión ha expirado');
        window.location= 'index.php'
        </script>";
    die();
}

$_SESSION['LAST_ACTIVITY'] = time();  // Actualiza el último momento de actividad

use Csr\Modelo\Usuarios;

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
        $objeto = new Usuarios();
        //Generando Token
        $token = $objeto->generate_csrf_token();
        
        $matriz_usuario = $objeto->mi_perfil();

        $cedula = $_SESSION['cedula'];
        $id_modulo = 1;
        $accion = 'El usuario ha entrado a "Mi Perfil"';
        $objeto->bitacora($cedula, $accion, $id_modulo);

        if (isset($_POST['update'])) {

            //Se chequea estos metodos de seguridad
            $objeto->check_blacklist();
            $objeto->check_requests_danger();
        
            //Ahora si procedemos a seguir con la actualizacion
            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $cedula = trim($_POST['cedula']);
            $cedula_antigua = trim($_SESSION['cedula']);
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $sexo = trim($_POST['sexo']);
            $estado_civil = strtolower(trim($_POST['estado_civil']));
            $nacionalidad = strtolower(trim($_POST['nacionalidad']));
            $estado = strtolower(trim($_POST['estado']));
            $telefono = trim($_POST['telefono']);
            $correo = strtolower(trim($_POST['correo']));
        
            //Validaciones
            $objeto->security_validation_inyeccion_sql([$nombre, $apellido, $cedula, $sexo, $estado_civil, $nacionalidad, $telefono]);
            $objeto->security_validation_caracteres([$nombre, $apellido]);
            $objeto->security_validation_cedula($cedula);
            $objeto->security_validation_fecha_nacimiento($fecha_nacimiento);
            $objeto->security_validation_sexo($sexo);
            $objeto->security_validation_estado_civil($estado_civil);
            $objeto->security_validation_nacionalidad($nacionalidad);
            $objeto->security_validation_estado($estado);
            $objeto->security_validation_correo($correo);
        
            //Sanitizacion
            $nombre = $objeto->sanitizar_cadenas($nombre);
            $apellido = $objeto->sanitizar_cadenas($apellido);
        
            $objeto->setUpdate_sin_rol($nombre, $apellido, $cedula, $cedula_antigua, $fecha_nacimiento, $sexo, $estado_civil, $nacionalidad, $estado, $telefono, $correo);
            $objeto->update_usuarios_sin_rol();
            
        }

        //Cargar todos los datos del usuario en el perfil
        if (isset($_REQUEST['data_load'])) {
            $data = $objeto->mi_perfil();
            http_response_code(200);
            echo json_encode($data);
            die();
        }


        //Actualizar datos del perfil del usuario
        $actualizar = true;
        

        //Actualizar imagen de perfil de usuario
        if (isset($_POST["actualizar_imagen"])) {
            $nombre_imagen = $_FILES['imagen']['name'];
            $tipo_imagen = $_FILES['imagen']['type'];
            $tamaño_imagen = $_FILES['imagen']['size'];
            $cedula = $_POST['cedula_antigua'];
            //ruta de la carpeta destinoen servidor
            $carpeta_destino =  $_SERVER['DOCUMENT_ROOT'] . '/CSR/resources/imagenes-usuarios/';

            $objeto->setActualizarFoto($cedula, $carpeta_destino, $nombre_imagen, $tipo_imagen, $tamaño_imagen);
            $objeto->actualizar_foto();
            $actualizar = false;
        }

        if (isset($_POST['actualizar_clave'])) {
            $clave_actual = trim($_POST['clave_actual']);
            $clave_nueva = trim($_POST['clave_nueva']);
            $objeto->validar_contraseña_actual($clave_actual);
            $objeto->security_validation_clave($clave_nueva);
            $objeto->actualizar_password($clave_nueva);
            
        }


        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'";

    echo "<script>
    alert('Sesion Cerrada');
    window.location= 'index.php'
</script>";
    echo json_encode(array('msj' => 'Sesion cerrada', 'status_code' => 403));
    die();
}

//Funcion para comprobar la integridad del token
function verified_token_csrf(){
	if (!isset($_REQUEST['token'])) {

		return false;
	} else {
		 if ($_REQUEST['token'] !== $_SESSION['csrf_token']) {
		 	return false;
		 }

		 return true;
	}
}
?>
