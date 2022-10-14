<?php
session_start();

if($_SESSION['verdadero'] > 0){
    if (!$_SESSION['permisos']['gestionar_roles']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";

    }
    if (is_file('vista/'.$pagina.'.php')) {
        require_once('modelo/clase_roles.php');
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
            $_SESSION['permisos'] = $objeto->get_permisos($idRol);
        }

        // Crear rol
        if (isset($_POST['create'])) {
            $nombreRol      = $_POST['nombre'];
            $descripcionRol = $_POST['descripcion'];

            $objeto->setDatos($nombreRol, $descripcionRol);

            if ($objeto->create_rol()) {
                $alert['status'] = true;
                $alert['msg'] = "Rol creado con éxito";
            } else {
                $alert['status'] = 'false';
                $alert = "Ha ocurrido un error al crear el rol";
            }
        }

        // Editar rol
        if (isset($_POST['edit'])) {
            $idRol          = $_POST['id'];
            $nombreRol      = $_POST['nombre'];
            $descripcionRol = $_POST['descripcion'];

            $objeto->setDatos($nombreRol, $descripcionRol);

            if ($objeto->update_rol($idRol)) {
                $alert['status'] = true;
                $alert['msg'] = "Rol modificado correctamente";
            } else {
                $alert['status'] = 'false';
                $alert = "Ha ocurrido un error al modificar el rol";
            }
        }

        $roles   = $objeto->get_roles();
        $modulos = $objeto->get_modulos();

        foreach ($roles as $rol) {
            $permisos[$rol['nombre']] = $objeto->get_permisos($rol['id']);
        }

        require_once 'vista/'.$pagina.'.php';
    }
} else { 
    echo "<script>
    window.location= 'error.php'
    </script>";
}
if(isset( $_POST['cerrar'])){
    session_destroy();
    echo "<script>
    alert('Sesion Cerrada');
    window.location= 'index.php'
    </script>";
}     
?>