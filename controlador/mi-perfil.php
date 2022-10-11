<?php
require_once("modelo/clase_usuario.php");

//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
  
    $objeto = new Usuarios();
    $matriz_usuario = $objeto->mi_perfil();
    
    foreach($matriz_usuario AS $usuario){
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
    }

    if(isset($_POST['actualizar'])){
        $nombre_imagen= $_FILES['imagen']['name'];
        $tipoimagen= $_FILES['imagen']['type'];
        $tamaño_imagen= $_FILES['imagen']['size'];
        
        //ruta de la carpeta destino en servidor
        $carpeta_destino =  $_SERVER['DOCUMENT_ROOT'] . 'resources/imagenes-usuarios';
    }
    require_once 'vista/'.$pagina.'.php';
}
}else{ 
    echo "<script>
           alert('Inicia sesion ');
           window.location= 'index.php'
</script>";
    
    }
if(isset( $_POST['cerrar'])){
    session_destroy();
    echo "<script>
    alert('Sesion Cerrada');
    window.location= 'index.php'
</script>";
}
