<?php
require_once("vendor/autoload.php");

use Csr\Modelo\Usuarios;

	$objeto_usuarios = new Usuarios();

	$objeto_usuarios->check_blacklist();

	$objeto_usuarios->check_requests_danger();

	if (empty($_GET['pagina'])) {
		
		$pagina = "inicio";
	} else {
		$pagina = $_GET['pagina'];
	}

	if (is_file("controlador/" . $pagina . ".php") ) {
		require_once("controlador/" . $pagina . ".php");
	} else {
		echo "Pagina en construcion";
	}
?>
