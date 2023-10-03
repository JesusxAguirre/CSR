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

    if (!$_SESSION['permisos']['secciones']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }
    if (is_file('vista/' . $pagina . '.php')) {

        $objeto = new Ecam();

        $cedula = $_SESSION['cedula'];
        $accion = 'El usuario ha entrado al apartado de "Listar Secciones" de la ECAM';
        $id_modulo = 3;
        $objeto->set_registrar_bitacora($cedula, $accion, $id_modulo);


        //ACTIVAR DATATABLE DE SECCIONES Y TRAER INFORMACION
        if (isset($_POST['activarDatatableSeccion'])) {
            $listarSecciones = $objeto->listarSeccionesON();
            $json = array();

            if (!empty($listarSecciones)) {
                foreach ($listarSecciones as $key) {
                    $json['data'][] = $key;
                }
            } else {
                $json['data']['id_seccion'] = null;
                $json['data']['nombre'] = null;
                $json['data']['nivel_academico'] = null;
                $json['data']['fecha_cierre'] = null;
            }
            echo json_encode($json);

            die();
        }

        ///AGREGAR O ACTUALIZAR ESTUDIANTES A LA SECCION SELECCIONADA
        if (isset($_POST['actualizarEstudiantes'])) {
            $idSeccionVincular = $_POST['idSeccionV'];
            $estudiantesNuevos = $_POST['estudiantesNuevos'];

            $objeto->agregandoMasEstudiantes($estudiantesNuevos, $idSeccionVincular);
            die();
        }

        ///CERRAR SECCION SELECCIONADA
        if (isset($_POST['eliminarSeccion'])) {
            $idSeccionEliminar = $_POST['idSeccionEliminar'];

            $validacion = $objeto->validar_cerrar_seccion($idSeccionEliminar);
            if ($validacion == 'true') {
                echo json_encode('true');
                $objeto->cerrarSeccion($idSeccionEliminar);
            } else {
                echo json_encode($validacion);
            }

            die();
        }


        ///ELIMINAR ESTUDIANTES SECCION SELECCIONADA
        if (isset($_POST['eliminarEstSeccion'])) {
            $cedulaEstborrar = $_POST['cedulaEstborrar'];
            $id_seccion = $_POST['idSeccionRef'];

            $validacion = $objeto->validar_eliminar_estudiantes($id_seccion, $cedulaEstborrar);
            if ($validacion > 0) {
                echo json_encode('true');
            } else {
                echo json_encode('false');
                $objeto->eliminarEstSeccion($cedulaEstborrar);
            }

            die();
        }

        //ACTUALIZAR INFORMACION DE LOS DATOS DE LA SECCION
        if (isset($_POST['actualizarDatosSeccion'])) {
            $nombreSeccionU = $_POST['nombreSeccionU'];
            $nivelSeccionU = $_POST['nivelSeccionU'];
            $idSeccionRefU = $_POST['idSeccionRefU'];
            $fechaCierreRefU = $_POST['fechaCierreRefU'];

            $respuesta = $objeto->validar_actualizar_seccion($idSeccionRefU, $nombreSeccionU, $nivelSeccionU);

            if ($respuesta == 'denegado') {
                echo json_encode('denegado');
            } else if ($respuesta > 0) {
                echo json_encode('encontrada');
            } else {
                $objeto->setActualizarDatosSeccion($nombreSeccionU, $nivelSeccionU, $fechaCierreRefU);
                $objeto->actualizarDatosSeccion($idSeccionRefU);
                echo json_encode('actualizada');
            }

            die();
        }

        //AGREGAR O ACTUALIZAR LAS MATERIAS Y PROFESORES DE LA SECCION SELECCIONADA
        if (isset($_POST['actualizarMP'])) {
            $idMateriaAdicional = $_POST['idMateriaAdicional'];
            $cedulaProfesorAdicional = $_POST['cedulaProfesorAdicional'];
            $idSeccionRef5 = $_POST['idSeccionRef5'];

            $objeto->setActualizarMP($idMateriaAdicional, $cedulaProfesorAdicional);
            $objeto->actualizarMateriasProfesores($idSeccionRef5);

            die();
        }

        //ELIMINAR MATERIA Y PROFESOR DE LA SECCION SELECCIONADA
        if (isset($_POST['eliminarMateriaProf'])) {
            $idMateriaSec = $_POST['idMateriaSec'];
            $cedulaProfSec = $_POST['cedulaProfSec'];
            $idSeccionMatProfSec = $_POST['idSeccionMatProfSec'];

            $validar = $objeto->validar_eliminar_profesorMateria($idSeccionMatProfSec, $idMateriaSec);
            if ($validar > 0) {
                echo json_encode('true');
            } else {
                $objeto->eliminarMateriaProf_seccion($idSeccionMatProfSec, $idMateriaSec, $cedulaProfSec);
                echo json_encode('false');
            }

            die();
        }

        //ACTIVAR LISTA DE ESTUDIANTES POR SECCION
        if (isset($_POST['activarTablaEst'])) {
            $idSeccionConsulta = $_POST['idSeccionConsulta'];

            $listarEstudiantesON = $objeto->listarEstudiantesON($idSeccionConsulta);

            if (!empty($listarEstudiantesON)) {
                foreach ($listarEstudiantesON as $listEst) { ?>
                    <tr>
                        <td hidden id="cedulaEstON"><?php echo $listEst['cedula']; ?></td>
                        <td><?php echo $listEst['codigo']; ?></td>
                        <td><?php echo $listEst['nombre']; ?></td>
                        <td><?php echo $listEst['apellido']; ?></td>
                        <td>
                            <button class="btn btn-danger" id="eliminarEstON"><i class="bi bi-x-lg"></i></button>
                        </td>
                    </tr> <?php
                        }
                    }

                    die();
                }


        //ACTIVAR LISTA DE PROFESORES POR SECCION
        if (isset($_POST['activarTablaProf'])) {
            $idSeccionProfConsulta = $_POST['idSMConsulta'];

            $listarProfesores_seccionMateria = $objeto->listarProfesores_seccionMateria($idSeccionProfConsulta);

            if (!empty($listarProfesores_seccionMateria)) {
                foreach ($listarProfesores_seccionMateria as $listProf) { ?>
                    <tr>
                        <td hidden class="idMateriaProfON"><?php echo $listProf['id_materia']; ?></td>
                        <td hidden class="cedulaProfON"><?php echo $listProf['cedula']; ?></td>
                        <td class="table-primary fw-bold"><?php echo $listProf['nombreMateria']; ?></td>
                        <td><?php echo $listProf['codigo']; ?></td>
                        <td><?php echo $listProf['nombre']; ?></td>
                        <td><?php echo $listProf['apellido']; ?></td>
                        <td>
                            <button class="btn btn-danger" id="eliminarMP_ON"><i class="bi bi-x-lg" title="Pulsa para eliminar"></i></button>
                        </td>
                    </tr> <?php
                }
            }

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
