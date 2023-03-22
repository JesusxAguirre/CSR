<?php
session_start();

use Csr\Modelo\Usuarios;
use Csr\Modelo\datosUsuario;
use Csr\Modelo\Roles;



$objeto = new Usuarios();
$objeto2 = new datosUsuario();
$objRoles = new Roles();

$error = false;
if (isset($_POST['registrar'])) {

	$registar_usuarios['nombre'] = trim($_POST['nombre']);
	$registar_usuarios['apellido'] = trim($_POST['apellido']);
	$registar_usuarios['cedula'] = trim($_POST['cedula']);
	$registar_usuarios['edad'] = trim($_POST['edad']);
	$registar_usuarios['sexo']= trim($_POST['sexo']);
	$registar_usuarios['civil'] = trim($_POST['civil']);
	$registar_usuarios['nacionalidad'] = trim($_POST['nacionalidad']);
	$registar_usuarios['estado'] = trim($_POST['estado']);
	$registar_usuarios['telefono'] = trim($_POST['telefono']);
	$registar_usuarios['correo'] = trim($_POST['correo']);
	$registar_usuarios['clave'] = trim($_POST['clave']);

	$objeto->setUsuarios($registar_usuarios);

	$error = $objeto->registrar_usuarios();
	
}

$recuperacion = false;
//recuperando password
if (isset($_POST['recuperar'])) {
	$correo = $_POST['correo2'];
	$clave = $_POST['clave2'];

	$objeto->setRecuperar($correo, $clave);

	$recuperacion = $objeto->recuperar_password();

	
}

//validando datos de usuario para entrar al sistema
if (isset($_POST['enviar'])) {

	$_SESSION['usuario'] = $_POST['usuario'];

	$_SESSION['clave'] = $_POST['password'];

	$_SESSION['verdadero'] = $objeto->validar();


	//$permisos = $objeto->get_permisos();

	$buscarNombre = $objeto2->nombre();
	$nombre;
	foreach ($buscarNombre as $key) {
		$nombre = $key['nombre'] . ' ' . $key['apellido'];
	}
	$_SESSION['nombre'] = $nombre;

	$buscarCedula = $objeto2->cedula();
	$_SESSION['cedula'] = $buscarCedula[0]['cedula'];

	$buscarIdSeccion = $objeto2->idSeccion();
	$_SESSION['id_seccion'] = $buscarIdSeccion[0]['idSeccion'];

	$buscarStatusProf = $objeto2->statusProfesor();
	$_SESSION['status_profesor'] = $buscarStatusProf[0]['status_profesor'];


	if ($_SESSION['verdadero'] > 0) {
	
		//primero se busca la id del rol del usuario con el correo del usuario
		$idRol = $objeto->getIdRol($_SESSION['usuario']);
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
?>