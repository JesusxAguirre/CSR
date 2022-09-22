<?php
session_start();
require_once('modelo/clase_usuario.php');

$objeto = new Usuarios();
$error = true;
if(isset($_POST['registrar'])){

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

	$objeto->setUsuarios($nombre,$apellido,$cedula,$edad,$sexo,$civil,$nacionalidad,$estado,$telefono,$correo,$clave);

	$objeto->registrar_usuarios();
	$error = false;
}
if(isset($_POST['enviar'])){

	$_SESSION['usuario']=$_POST['usuario'];

	$_SESSION['clave']=$_POST['clave'];

	$_SESSION['verdadero']=$objeto->validar();

	$permisos = $objeto->get_permisos();

	if($_SESSION['verdadero'] > 0){

		echo "<script>
		alert('Sesion iniciada correctamente');
		window.location= 'index.php?pagina=dashboard'
		</script>";

	}else{
		echo "<script>
		alert('Clave o usuario incorrecto');
		window.location= 'index.php?pagina=iniciar-sesion'
		</script>";
	}
} 
if(is_file("vista/".$pagina.".php")){
	  //si existe se la trae, ahora ve a la carpeta vista

	require_once 'vista/'.$pagina.'.php';
}

else{
	echo "pagina en construccion";
}
?>