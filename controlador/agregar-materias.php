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

use Csr\Modelo\Ecam;

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

    if (!$_SESSION['permisos']['materias']['crear']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }
    if (is_file('vista/' . $pagina . '.php')) {

        $objeto = new Ecam();

        $cedula = $_SESSION['cedula'];
        $accion = 'El usuario ha entrado al apartado de Agregar Materias';
        $id_modulo = 3;
        $objeto->set_registrar_bitacora($cedula, $accion, $id_modulo);

        //AGREGANDO MATERIAS
        if (isset($_POST['agregarMateria'])) {
            $nombreMateria = $_POST['nombreMateria'];
            $nivelSeleccionado = $_POST['seleccionarNivel'];
            $cedulaProfesor;

            $validacion = $objeto->validar_materia($nombreMateria, $nivelSeleccionado);

            if ($validacion > 0) {
                echo json_encode('stop');
            } else {
                echo json_encode('true');
                $cedulaProfesor = $_POST['cedulaProfesor'];
                $objeto->setMaterias(ucfirst($nombreMateria), $nivelSeleccionado, $cedulaProfesor);
                $objeto->agregarMaterias();
            }
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

        require_once 'vista/' . $pagina . '.php';
    }
} else {
    echo "<script>
    alert('Inicia sesion ');
    window.location= 'error.php'
    </script>";
}
