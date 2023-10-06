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

if($_SESSION['verdadero'] > 0){
    
    if (!$_SESSION['permisos']['aula_virtual_profesores']['listar'] && !$_SESSION['status_profesor']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";

    }
    if (is_file('vista/'.$pagina.'.php')) {
        
        $objeto= new Ecam();

        $cedula = $_SESSION['cedula'];
        $accion = 'El usuario ha entrado a revisar sus estudiantes en el  "Aula Virtual Profesores"';
        $id_modulo = 3;
        $objeto->set_registrar_bitacora($cedula, $accion, $id_modulo);


        if (isset($_POST['agregarNota'])) {
            $notaEstudiante = $_POST['notaEstudiante'];
            $notaIDseccion = $_POST['notaIDseccion'];
            $notaIDmateria = $_POST['notaIDmateria'];
            $notaCIestudiante = $_POST['notaCIestudiante'];
        
            $objeto->setNotaMateriaEstudiante($notaIDseccion, $notaIDmateria, $notaCIestudiante);
            $objeto->agregarNotaMateria($notaEstudiante);
            die();
        }
        
        
        if (isset($_POST['verNota'])) {
            $notaCIestudianteRef = $_POST['notaCIestudianteRef'];
            $notaIDmateriaRef = $_POST['notaIDmateriaRef'];
            $notaIDseccionRef = $_POST['notaIDseccionRef'];
        
            $notaDelEstudiante = $objeto->listarNota_miEstudiante($notaIDmateriaRef, $notaIDseccionRef, $notaCIestudianteRef);
        
            echo $notaDelEstudiante[0]['nota'];
            die();
        }
        
        if (isset($_POST['actualizarNota'])) {
            $notaCIestudiante2 = $_POST['notaCIestudiante2'];
            $notaIDmateria2 = $_POST['notaIDmateria2'];
            $notaIDseccion2 = $_POST['notaIDseccion2'];
            $notaNueva = $_POST['notaNueva'];
        
            $validacion = $objeto->validar_eliminar_notaMateria($notaCIestudiante2, $notaIDseccion2);
            if ($validacion > 0) {
                echo json_encode('denegado');
            }else{
                $objeto->setActualizarMateriaEstudiante($notaIDseccion2, $notaIDmateria2, $notaCIestudiante2);
                $objeto->actualizarNotaMateria($notaNueva);
                echo json_encode('actualizada');
            }
            die();
        }
        
        if (isset($_POST['eliminarNota'])) {
            $cedulaEstudianteRef2= $_POST['cedulaEstudianteRef2'];
            $idMateriaRef2= $_POST['idMateriaRef2'];
            $idSeccionRef2= $_POST['idSeccionRef2'];
        
            $validacion = $objeto->validar_eliminar_notaMateria($cedulaEstudianteRef2, $idSeccionRef2);
            if ($validacion > 0) {
                echo json_encode('stop');
            }else{
                $objeto->eliminarNotaMateria($cedulaEstudianteRef2, $idMateriaRef2, $idSeccionRef2);
                 echo json_encode('true');
            }
            die();
        }
        
        
        // AQUI TODOS LOS ESTUDIANTES QUE MANEJA EL PROFESOR
        if (isset($_POST['listarMisEstudiantes'])) {
        
            $listar_misEstudiantes = $objeto->listar_misEstudiantes();

            $json = array();

            if (!empty($listar_misEstudiantes)) {
                foreach ($listar_misEstudiantes as $key) {
                    $json['data'][] = $key;
                }
            }else{
                $json['data'] = array();
            }
            
            echo json_encode($json);
            die();
        }

        
        require_once 'vista/'.$pagina.'.php';

    }

} else { 
    echo "<script>
    window.location= 'error.php'
    </script>";
}
?>
