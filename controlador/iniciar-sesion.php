<?php
session_start();

use Csr\Modelo\Usuarios;
use Csr\Modelo\datosUsuario;
use Csr\Modelo\Roles;

$objeto_usuario = new Usuarios();
$objeto_datos_usuario = new datosUsuario();
$objRoles = new Roles();

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
	$correo = trim($_POST['correo']);
	$clave = trim($_POST['clave']);

	$objeto_usuario->security_validation_sql([$nombre, $apellido, $cedula, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo, $clave]);

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

	$response = $objeto_usuario->registrar_usuarios();


	if ($response) {

		echo json_encode(array("response" => $response));
		return true;
	} else {

		echo json_encode(array("response" => $response));
		return false;
	}
}

//VALIDACION SI CEDULA YA EXISTE EN  LA BD
if (isset($_POST['cedula_existente'])) {
	$cedula = $_POST['cedula_existente'];

	$objeto_usuario->security_validation_sql([$cedula]);

	$objeto_usuario->security_validation_cedula($cedula);

	$response = $objeto_usuario->buscar_cedula($cedula);

	echo json_encode(array("response" => $response));
	return true;
}

//VALIDACION SI CORREO YA EXISTE EN LA BD

if (isset($_POST['correo_existente'])) {
	$correo = $_POST['correo_existente'];

	$objeto_usuario->security_validation_sql([$correo]);

	$objeto_usuario->security_validation_correo($correo);

	$response = $objeto_usuario->buscar_correo($correo);

	echo json_encode(array("response" => $response));

	return true;
}

$recuperacion = false;
//recuperando password
if (isset($_POST['recuperar'])) {
	$correo = $_POST['correo2'];


	$objeto_usuario->setRecuperar($correo, $clave);

	$recuperacion = $objeto_usuario->recuperar_password();
}

//validando datos de usuario para entrar al sistema
if (isset($_POST['email'])) {

	$_SESSION['usuario'] = trim($_POST['email']);

	$_SESSION['clave'] = trim($_POST['password']);

	$response = $objeto_usuario->validar();

	
	if ($response['status_code'] != 200) {
		http_response_code($response['status_code']);
		echo json_encode($response);

		return false;
	}



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

		http_response_code($response['status_code']);
		echo json_encode($response);

		return true;
	} else {
		echo "<script>
		alert('Clave o usuario incorrecto');
		window.location= 'index.php?pagina=iniciar-sesion'
		</script>";
	}
}
if (is_file("vista/" . $pagina . ".php")) {
	//si existe se la trae, ahora ve a la carpeta vista

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
