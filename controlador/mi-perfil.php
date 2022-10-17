<?php
r//destruye la sesion si se tenia una abierta
session_start();

if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {
        require_once("modelo/clase_usuario.php");
        $objeto = new Usuarios();
        $matriz_usuario = $objeto->mi_perfil();

        $accion = 'El usuario ha entrado a "Mi Perfil"';
        $objeto->registrar_bitacora($accion);

        foreach ($matriz_usuario as $usuario) {
            $nombre = $usuario['nombre'];
            $apellido = $usuario['apellido'];
            $cedula = $usuario['cedula'];
            $edad = $usuario['edad'];
            $sexo = $usuario['sexo'];
            $estado_civil = $usuario['estado_civil'];
            $nacionalidad = $usuario['nacionalidad'];
            $estado = $usuario['estado'];
            $telefono = $usuario['telefono'];
            $codigo = $usuario['codigo'];
            $ruta_imagen = $usuario['ruta_imagen'];
            $correo = $usuario['usuario'];
            $clave = $usuario['password'];
        }
        $actualizar = true;
        if (isset($_POST['actualizar'])) {
            $cedula = $_POST['cedula'];
            $cedula_antigua = $_POST['cedula_antigua'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];
            $civil = $_POST['civil'];
            $nacionalidad = $_POST['nacionalidad'];
            $estado = $_POST['estado'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];

            $objeto->setUpdate_sin_rol($nombre, $apellido, $cedula,$cedula_antigua, $edad, $sexo, $civil, $nacionalidad, $estado, $telefono, $correo, $clave);
            $objeto->update_usuarios_sin_rol();

            $actualizar = false;
        }
        if (isset($_POST["actualizar_imagen"])) {
            $nombre_imagen = $_FILES['imagen']['name'];
            $tipo_imagen = $_FILES['imagen']['type'];
            $tamaño_imagen = $_FILES['imagen']['size'];

            //ruta de la carpeta destinoen servidor
            $carpeta_destino =  $_SERVER['DOCUMENT_ROOT'] . '/CSR/resources/imagenes-usuarios/';

            $objeto->setActualizarFoto($cedula, $carpeta_destino, $nombre_imagen, $tipo_imagen, $tamaño_imagen);

            $objeto->actualizar_foto();
            $actualizar = false;
        }
        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           window.location= 'error.php'
;
    echo "<script>
    alert('Sesion Cerrada');
    window.location= 'index.php'
</script>";
}
