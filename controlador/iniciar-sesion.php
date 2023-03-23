<?php
session_start();

use Csr\Modelo\Usuarios;
use Csr\Modelo\datosUsuario;
use Csr\Modelo\Roles;

$objeto_usuario = new Usuarios();
$objeto_datos_usuario = new datosUsuario();
$objRoles = new Roles();


if (isset($_POST['registrar'])) {

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

$recuperacion = false;
//recuperando password
if (isset($_POST['recuperar'])) {
	$correo = $_POST['correo2'];
	$clave = $_POST['clave2'];

	$objeto_usuario->setRecuperar($correo, $clave);

	$recuperacion = $objeto_usuario->recuperar_password();
}

//validando datos de usuario para entrar al sistema
if (isset($_POST['enviar'])) {

	$_SESSION['usuario'] = $_POST['usuario'];

	$_SESSION['clave'] = $_POST['password'];

	$_SESSION['verdadero'] = $objeto_usuario->validar();


	//$permisos = $objeto_usuario->get_permisos();

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


	if ($_SESSION['verdadero'] > 0) {

		//primero se busca la id del rol del usuario con el correo del usuario
		$idRol = $objeto_usuario->getIdRol($_SESSION['usuario']);
		$_SESSION['rol'] = $idRol;

		//luego se buscan los permisos con el id de rol
		$_SESSION['permisos'] = $objRoles->get_permisos($idRol);

		echo "<script>window.location= 'index.php?pagina=dashboard'</script>";
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
