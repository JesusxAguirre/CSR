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
        $cedula= $_POST['cedula'];
        $cedula_antigua= $_POST['cedula_antigua'];
        $nombre= $_POST['nombre'];
        $apellido= $_POST['apellido'];
        $edad= $_POST['edad'];
        $sexo= $_POST['sexo'];
        $civil= $_POST['civil'];
        $nacionalidad= $_POST['nacionalidad'];
        $estado= $_POST['estado'];
        $telefono= $_POST['telefono'];
       

       $objeto->setUpdate($nombre,$apellido,$cedula,$cedula_antigua,$edad,$sexo,$civil,$nacionalidad,$estado,$telefono);    

       $objeto->update_usuarios();

       $actualizar=false;
    }
    if(isset($_POST["actualizar_imagen"])){
        $nombre_imagen= $_FILES['imagen']['name'];
        $tipo_imagen= $_FILES['imagen']['type'];
        $tamaño_imagen= $_FILES['imagen']['size'];
        

        echo $nombre_imagen;
        echo "<br>";
        echo $tipo_imagen;
        echo "<br>";
        echo $tamaño_imagen;

        exit;

        //ruta de la carpeta destinoen servidor
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
