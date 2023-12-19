<?php
session_start();
use Csr\Modelo\ChatRoom;


if($_SESSION['verdadero'] > 0){

    if (is_file('vista/'.$pagina.'.php')) {
        
        $obj = new ChatRoom;
        $chat_datos = $obj->getChatDatos();
        
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