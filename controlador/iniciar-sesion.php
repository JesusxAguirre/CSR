
<?php
session_start();
require_once('modelo/clase_usuario.php');
require_once('modelo/clase_datosUsuario.php');
require_once('modelo/clase_roles.php');

$objeto = new Usuarios();
$objeto2 = new datosUsuario();
$objRoles = new Roles();

$error = true;
if (isset($_POST['registrar'])) {

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$cedula = $_POST['cedula'];
	$edad = $_POST['edad'];
	$sexo = $_POST['sexo'];
	$civil = $_POST['civil'];
	$nacionalidad = $_POST['nacionalidad'];
	$estado = $_POST['estado'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];
	$clave = $_POST['clave'];

	$objeto->setUsuarios($nombre, $apellido, $cedula, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo, $clave);

	$objeto->registrar_usuarios();
	$error = false;
}

$recuperacion = true;
//recuperando password
if (isset($_POST['recuperar'])) {
	$correo = $_POST['correo2'];
	$clave = $_POST['clave2'];

	$objeto->setRecuperar($correo, $clave);

	$objeto->recuperar_password();

	$recuperacion = false;
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