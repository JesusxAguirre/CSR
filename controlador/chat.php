<?php
session_start();
require_once("modelo/clase_usuario.php");
$objeto = new Usuarios();
$matriz_usuario = $objeto->mi_perfil();

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
if($_SESSION['verdadero'] > 0){

    if (is_file('vista/'.$pagina.'.php')) {
    
        
        require_once 'vista/'.$pagina.'.php';
    }

} else { 
    echo "<script>
    alert('Inicia sesion ');
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