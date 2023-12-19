<?php

//destruye la sesion si se tenia una abierta
session_start();

// Verificar la expiración del tiempo de la sesiónx
$time_limit = 3600;  // Establecemos el límite de tiempo en segundos, por ejemplo, 1800 segundos = 30 minutos
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $time_limit)) {
    // El tiempo de sesión ha expirado

    // Regenera el ID de sesión antes de destruirla
    session_regenerate_id(true);

    // Desestablece todas las variables de sesión
    $_SESSION = array();

    session_destroy();  // Destruye la sesión
    echo "<script>
    alert('La sesión ha expirado');
    window.location= 'index.php'
    </script>";

    http_response_code(403);
    echo json_encode(array("msj" => "Sesion expirada", "status_code" => 403));
    die();
}

$_SESSION['LAST_ACTIVITY'] = time();  // Actualiza el último momento de actividad

use Csr\Modelo\Discipulado;

if (isset($_POST['cerrar'])) {

    // Regenera el ID de sesión antes de destruirla
    session_regenerate_id(true);

    // Desestablece todas las variables de sesión
    $_SESSION = array();

    session_destroy();

    http_response_code(200);
    echo json_encode(array('msj' => 'Ha cerrado sesion con correctamente. Vuelva pronto', 'status' => 200));
    die();
}

if ($_SESSION['verdadero'] > 0) {
    if (is_file('vista/' . $pagina . '.php')) {
        if (!$_SESSION['permisos']['celula_discipulado']['listar']) {
            echo "<script>
            alert('No tienes los permisos para este modulo');
            window.location= 'index.php?pagina=dashboard'
            </script>";

        }

        $objeto = new Discipulado();

        $matriz_codigo = $objeto->listar_celula_discipulado_por_usuario();

        // Listado para el reporte
        
        if (isset($_POST['codigo_discipulado'])) {
            $id = $_POST['codigo_discipulado'];
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_final = $_POST['fecha_final'];

            $matriz_asistencias = $objeto->listar_asistencias($id, $fecha_inicio, $fecha_final);

            ?>
            <div class="text-center">
                <h4><b>REPORTE</b></h4>
                <h6><i>
                        <?php echo $fecha_inicio ?> hasta el
                        <?php echo $fecha_final ?>
                    </i></h6>
            </div>
            <div class="table-responsive mt-4">
                <table role='table' class='table table-centered table-light'>
                    <thead>
                        <tr role='row'>
                            <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>No</th>
                            <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Nombre de discipulo</th>
                            <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Telefono</th>
                            <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Codigo</th>
                            <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Total Asistencias</th>
                            <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Total Reuniones</th>
                        </tr>
                    </thead>
                    <tbody role='rowgroup'>
                        <?php $cont = 1;
                        foreach ($matriz_asistencias as $asistencias): ?>
                            <tr role='row'>
                                <td role='cell'>
                                    <?php echo $cont++ ?>
                                </td>
                                <td role='cell'>
                                    <?php echo $asistencias['nombre'] . ' ' . $asistencias['apellido'] ?>
                                </td>
                                <td class="" role='cell'>
                                    <?php echo $asistencias['telefono'] ?>
                                </td>
                                <td class="" role='cell'>
                                    <?php echo $asistencias['codigo'] ?>
                                </td>
                                <td role='cell'>
                                    <?php echo $asistencias['asistencias'] ?>
                                </td>
                                <td role='cell'>
                                    <?php echo $asistencias['total'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php
            die();
        }


        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
           alert('Inicia sesion ');
           window.location= 'error.php'
</script>";
}
?>