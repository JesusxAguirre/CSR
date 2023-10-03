<?php
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

use Csr\Modelo\Ecam;

if ($_SESSION['verdadero'] > 0) {

    if (!$_SESSION['permisos']['profesores']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }
    if (is_file('vista/' . $pagina . '.php')) {

        $objeto = new Ecam();

        $cedula = $_SESSION['cedula'];
        $accion = 'El usuario ha entrado al apartado de "Agregar Profesores" a la ECAM';
        $id_modulo = 3;
        $objeto->set_registrar_bitacora($cedula, $accion, $id_modulo);


        //AGREGANDO PROFESORES A LA ECAM
        if (isset($_POST['agregarProfesores'])) {
            $cedulaProfesor = $_POST['cedulasProfesores'];
            $objeto->agregar_profesores($cedulaProfesor);

            die();
        }

        //ELIMINANDO PROFESORES DE LA ECAM DEFINITIVAMENTE
        if (isset($_POST['eliminar_profesor'])) {
            $cedulaProf = $_POST['cedulaProf'];

            $validacion = $objeto->validar_eliminar_profesor($cedulaProf);
            if ($validacion == 'stop') {
                echo json_encode('stop');
            } else {
                $objeto->eliminar_profesor($cedulaProf);
                echo json_encode('true');
            }

            die();
        }

        //LISTANDO LOS PROFESORES EN SELECT
        if (isset($_POST['listarProfesores'])) {
            $profesores = $objeto->listarProfesores(); ?>

            <select multiple name="seleccionarProf" id="seleccionarProf" class="form-control">
                <?php foreach ($profesores as $prof) : ?>
                    <option value="<?php echo $prof['cedula']; ?>"> <?php echo $prof['codigo'] . ' ' . $prof['nombre'] . ' ' . $prof['apellido']; ?></option>
                <?php endforeach; ?>
            </select>
            <?php
            
            die();
        }

        //LISTANDO PROFESORES AGREGADOS A LA ECAM EN LA TARJETA
        if (isset($_POST['listarProfesores2'])) {
            $profesores = $objeto->listarProfesores();

            if (!empty($profesores)) {
                foreach ($profesores as $key) { ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mb-0">
                                    <h6 class="mb-0 fst-italic"><?php echo $key['codigo']; ?></h6>
                                    <p class="mb-0"><em><?php echo $key['nombre'] . ' ' . $key['apellido'] ?></em></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <input class="cedulaProfesor d-none" type="text" value="<?php echo $key['cedula'] ?>">
                            <i class="eliminarProfEcam btn bi bi-x-lg text-danger fw-bold fs-5"></i>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td><i>"Aun no hay profesores agregados"</i></td>
                </tr>
            <?php  }

            die();
        }

        if (isset($_POST['listarFuturosProfesores'])) {
            $profesores = $objeto->listar_noProfesores(); ?>
            <select multiple name="profesores[]" id="profesores" class="form-select">
                <?php foreach ($profesores as $prof) : ?>
                    <option value="<?php echo $prof['cedula']; ?>"> <?php echo $prof['codigo'] . ' ' . $prof['nombre'] . ' ' . $prof['apellido']; ?></option>
                <?php endforeach; ?>
            </select><?php
            
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
