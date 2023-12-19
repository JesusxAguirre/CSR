<?php
session_start();

use Csr\Modelo\Usuarios;
use Csr\Modelo\datosUsuario;
use Csr\Modelo\Roles;

// Crear el tokenStore
$objeto_usuario = new Usuarios();
$objeto_datos_usuario = new datosUsuario();
$objRoles = new Roles();


//APLICACION MOVIL
$headers = apache_request_headers();
//if para aplicacion movil
if (isset($headers['get-token'])) {

	//OBTENER TOKEN
	$token = $objeto_usuario->generate_csrf_token();

	// Generar el par de claves
	$parClaves = $objeto_usuario->mutatedGenerateAsymmetricKeys();

	$_SESSION['private_key'] = $parClaves['private_key'];
	$_SESSION['public_key'] = $parClaves['public_key'];

	$token = $objeto_usuario->mutatedEncryptMessage($token, $_SESSION['public_key']);

	//si existe se la trae, ahora ve a la carpeta vista
	http_response_code(200);

	header('Content-Type: application/json');
	echo json_encode(array('token' => $token));
	die();
}


//REGISTRAR USUARIO
if (isset($_POST['cedula']) && isset($_POST['correo'])) {

	$nombre = trim($_POST['nombre']);
	$apellido = trim($_POST['apellido']);
	$cedula = trim($_POST['cedula']);
	$edad = trim($_POST['edad']);
	$sexo = trim($_POST['sexo']);
	$civil = trim($_POST['civil']);
	$nacionalidad = trim($_POST['nacionalidad']);
	$estado = trim($_POST['estado']);
	$telefono = trim($_POST['telefono']);
	$correo = strtolower(trim($_POST['correo']));
	$clave = trim($_POST['clave']);


	$objeto_usuario->security_validation_inyeccion_sql([$nombre, $apellido, $cedula, $sexo, $civil, $nacionalidad, $telefono, $clave]);

	$objeto_usuario->security_validation_caracteres([$nombre, $apellido]);

	$objeto_usuario->security_validation_cedula($cedula);

	$objeto_usuario->security_validation_fecha_nacimiento($edad);

	$objeto_usuario->security_validation_sexo($sexo);

	$objeto_usuario->security_validation_estado_civil($civil);

	$objeto_usuario->security_validation_nacionalidad($nacionalidad);

	$objeto_usuario->security_validation_estado($estado);

	$objeto_usuario->security_validation_correo($correo);

	$objeto_usuario->security_validation_clave($clave);

	$nombre = $objeto_usuario->sanitizar_cadenas($nombre);
	$apellido = $objeto_usuario->sanitizar_cadenas($apellido);
	$nacionalidad = $objeto_usuario->sanitizar_cadenas($nacionalidad);
	$estado = $objeto_usuario->sanitizar_cadenas($estado);

	$objeto_usuario->setUsuarios($nombre, $apellido, $cedula, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo, $clave);

	$objeto_usuario->registrar_usuarios();
}

//VALIDACION SI CEDULA YA EXISTE EN  LA BD
if (isset($_POST['cedula_existente'])) {
	$cedula = $_POST['cedula_existente'];

	$objeto_usuario->security_validation_inyeccion_sql([$cedula]);

	$objeto_usuario->security_validation_cedula($cedula);

	$objeto_usuario->buscar_cedula($cedula);
}

//VALIDACION SI CORREO YA EXISTE EN LA BD

if (isset($_POST['correo_existente'])) {
	$correo = $_POST['correo_existente'];

	$objeto_usuario->security_validation_correo($correo);

	$objeto_usuario->buscar_correo($correo);

	return true;
}


if (isset($_POST['correo2'])) {

	$objeto_usuario->check_blacklist();

	$objeto_usuario->check_requests_danger();


	$correo = strtolower(trim($_POST['correo2']));


	$objeto_usuario->security_validation_correo($correo);

	$objeto_usuario->validar_correo_existe($correo);

	$objeto_usuario->generate_token_message_password($correo);
}

if (isset($_POST['tokenCorreo'])) {

	$objeto_usuario->check_blacklist();

	$objeto_usuario->check_requests_danger();

	$token = $_POST['tokenCorreo'];

	$objeto_usuario->verifyRecoveryToken($token);
}

if (isset($_POST['respuesta'])) {
	$objeto_usuario->insert_ip_blacklist();
}

//validando datos de usuario para entrar al sistema
if (isset($_POST['email'])) {

	/*if (!verified_token_csrf()) {
		$objeto_usuario->insert_ip_blacklist();
	}*/
	$correo = strtolower(trim($_POST['email']));

	$clave = trim($_POST['password']);

	$objeto_usuario->security_validation_correo($correo);

	$objeto_usuario->security_validation_clave($clave);

	$_SESSION['usuario'] = $correo;

	$_SESSION['clave'] = $clave;

	$objeto_usuario->check_blacklist();

	$objeto_usuario->check_requests_danger();

	$objeto_usuario->validar();

	$_SESSION['verdadero'] = 1;


	//$permisos = $objeto_usuario->get_permisos();
	if ($_SESSION['verdadero'] > 0) {
		$buscarNombre = $objeto_datos_usuario->nombre();
		$nombre;
		foreach ($buscarNombre as $key) {
			$nombre = $key['nombre'] . ' ' . $key['apellido'];
		}
		$_SESSION['nombre'] = $nombre;

		$buscarCedula = $objeto_datos_usuario->cedula();
		$_SESSION['cedula'] = $buscarCedula[0]['cedula'];

		$buscarIdSeccion = $objeto_datos_usuario->idSeccion();
		$_SESSION['id_seccion'] = $buscarIdSeccion[0]['idSeccion'];

		$buscarStatusProf = $objeto_datos_usuario->statusProfesor();
		$_SESSION['status_profesor'] = $buscarStatusProf[0]['status_profesor'];

		//primero se busca la id del rol del usuario con el correo del usuario
		$idRol = $objeto_usuario->getIdRol($_SESSION['usuario']);
		$_SESSION['rol'] = $idRol;

		//luego se buscan los permisos con el id de rol
		$_SESSION['permisos'] = $objRoles->get_permisos($idRol);

		// Regenera el ID de sesión para vaciar rastros de las anteriores
		session_regenerate_id(true);

		return true;
	}
}

//validando datos de usuario para entrar al sistema
if (isset($_POST['encryptedLogin'])) {

	
	//DESENCRIPTAR 
	$array_desencripted = $objeto_usuario->mutatedDecryptMessageMobile($_POST['encryptedLogin']);

	$array_desencripted = json_decode($array_desencripted);


	$correo = strtolower(trim($array_desencripted->email));

	$clave = trim($array_desencripted->password);


	if (!verified_token_csrf()) {
		$objeto_usuario->insert_ip_blacklist();
	} 
 

	$objeto_usuario->security_validation_correo($correo);

	$objeto_usuario->security_validation_clave($clave);

	$_SESSION['usuario'] = $correo;

	$_SESSION['clave'] = $clave;

	$objeto_usuario->check_blacklist();

	$objeto_usuario->check_requests_danger();

	$objeto_usuario->validar();

	$_SESSION['verdadero'] = 1;


	//$permisos = $objeto_usuario->get_permisos();
	if ($_SESSION['verdadero'] > 0) {
		$buscarNombre = $objeto_datos_usuario->nombre();
		$nombre;
		foreach ($buscarNombre as $key) {
			$nombre = $key['nombre'] . ' ' . $key['apellido'];
		}
		$_SESSION['nombre'] = $nombre;

		$buscarCedula = $objeto_datos_usuario->cedula();
		$_SESSION['cedula'] = $buscarCedula[0]['cedula'];

		$buscarIdSeccion = $objeto_datos_usuario->idSeccion();
		$_SESSION['id_seccion'] = $buscarIdSeccion[0]['idSeccion'];

		$buscarStatusProf = $objeto_datos_usuario->statusProfesor();
		$_SESSION['status_profesor'] = $buscarStatusProf[0]['status_profesor'];

		//primero se busca la id del rol del usuario con el correo del usuario
		$idRol = $objeto_usuario->getIdRol($_SESSION['usuario']);
		$_SESSION['rol'] = $idRol;

		//luego se buscan los permisos con el id de rol
		$_SESSION['permisos'] = $objRoles->get_permisos($idRol);

		// Regenera el ID de sesión para vaciar rastros de las anteriores
		session_regenerate_id(true);

		return true;
	}
}




if (is_file("vista/" . $pagina . ".php")) {

	//OBTENER TOKEN
	$token = $objeto_usuario->generate_csrf_token();

	// Generar el par de claves
	$parClaves = $objeto_usuario->mutatedGenerateAsymmetricKeys();

	$_SESSION['private_key'] = $parClaves['private_key'];
	$_SESSION['public_key'] = $parClaves['public_key'];

	$token = $objeto_usuario->mutatedEncryptMessage($token, $_SESSION['public_key']);

	//si existe se la trae, ahora ve a la carpeta vista
	http_response_code(200);
	require_once 'vista/' . $pagina . '.php';
} else {
	echo "pagina en construccion";
}


function verified_status_code($response)
{
	if ($response['status_code'] != 200) {
		http_response_code($response['status_code']);
		echo json_encode($response);

		return false;
	}

	return false;
}

function verified_token_csrf()
{
	try {
		if (!isset($_REQUEST['token'])) {

			return false;
		} else {
			$objeto_usuario = new Usuarios();

			$decryptedToken = $objeto_usuario->mutatedDecryptMessage($_REQUEST['token'], $_SESSION['private_key']);

			if ($decryptedToken  !== $_SESSION['csrf_token']) {
				return false;
			}

			return true;
		}
	} catch (Exception $e) {
		return false; // Error de descifrado o intento de manipulación
	}
}
