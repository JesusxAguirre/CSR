<?php
session_start();

use Csr\Modelo\Usuarios;
use Csr\Modelo\Roles;

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
                $json['data']['cedula'] = null;
                //Faltaria agregar las demas, pero debes hacerlo descriptivo
            }
            echo json_encode($json);
            die();
        }

        //funcion de actualizar
        //variable que manda mensaje de firealert

        $actualizar = false;
        if (isset($_POST['update'])) {
            $cedula = trim($_POST['cedula']);
            $cedula_antigua = trim($_POST['cedula_antigua']);
            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $edad = trim($_POST['edad']);
            $sexo = trim($_POST['sexo']);
            $civil = trim($_POST['civil']);
            $nacionalidad = trim($_POST['nacionalidad']);
            $estado = trim($_POST['estado']);
            $telefono = trim($_POST['telefono']);
            $rol = trim($_POST['rol']);
            $objeto->setUpdate($nombre, $apellido, $cedula, $cedula_antigua, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $rol);

            $actualizar = $objeto->update_usuarios();
        }

        $eliminar = false;
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
if (isset($_POST['cerrar'])) {
    session_destroy();
    echo "<script>
    alert('Sesion Cerrada');
    window.location= 'index.php'
</script>";
}
