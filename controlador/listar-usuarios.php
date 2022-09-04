<?php

//destruye la sesion si se tenia una abierta
session_start();
require_once('modelo/clase_usuario.php');
if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {
        $objeto = new Usuarios();

        if(isset($_POST['update'])){
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
        }
        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           alert('Inicia sesion ');
           window.location= 'index.php'
</script>";
}
if (isset($_POST['cerrar'])) {
    session_destroy();
    echo "<script>
    alert('Sesion Cerrada');
    window.location= 'index.php'
</script>";
}
?>