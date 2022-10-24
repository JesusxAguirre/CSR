<?php
//destruye la sesion si se tenia una abierta
session_start();

if($_SESSION['verdadero'] > 0){
if (is_file('vista/'.$pagina.'.php')) {
    require_once 'modelo/clase_evento.php';
    $objeto = new Evento();

    // Crear Evento
    if (isset($_POST['create']) && $_SESSION['permisos']['agenda']['crear']) {
        $titulo      = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $inicio      = $_POST['inicio'];
        $final       = $_POST['final'];
        $oculto      = $_POST['oculto'] ?? '0';

        $objeto->setDatos($titulo, $descripcion, $inicio, $final, $oculto);
        
        if ($objeto->create_evento()) {
            $alert['status'] = true;
            $alert['msg'] = "Evento creado con éxito";
        } else {
            $alert['status'] = 'false';
            $alert = "Ha ocurrido un error al crear el evento";
        }
    }
    
    $eventos = $objeto->get_eventos();
    if ($_SESSION['permisos']['agenda_oculta']['listar']) {
        $eventosOcultos = $objeto->get_eventosOcultos();
    }

    require_once 'vista/'.$pagina.'.php';
}
} else{ 
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
?>