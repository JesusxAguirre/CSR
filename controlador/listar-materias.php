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

    if (!$_SESSION['permisos']['materias']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";
    }
    if (is_file('vista/' . $pagina . '.php')) {

        $objeto = new Ecam();

        $cedula = $_SESSION['cedula'];
        $accion = 'El usuario ha entrado en el apartado de "Listar Materias" de la ECAM';
        $id_modulo = 3;
        $objeto->set_registrar_bitacora($cedula, $accion, $id_modulo);


        //LISTADO DE MATERIAS
        if (isset($_POST['listar_materias'])) {
            $listarMaterias = $objeto->listarMaterias();

            if (!empty($listarMaterias)) {
                foreach ($listarMaterias as $listado) { ?>
                    <tr>
                        <td hidden class="idMateria"><?php echo $listado['id_materia']; ?></td>
                        <td class="nombreM"><?php echo $listado['nombre']; ?></td>
                        <td class="nivelM"><?php echo $listado['nivelAcademico']; ?></td>
                        <td>
                            <button class="btn btn-primary" id="actualizarM" data-bs-toggle="modal" data-bs-target="#modalActualizarMateria"><i class="bi bi-pencil-fill fs-5"></i></button>
                            <button class="btn btn-primary" id="editarProf" title="Ver profesores de la materia" data-bs-toggle="modal" data-bs-target="#modalProf"><i class="bi bi-person-lines-fill fs-5"></i></button>
                            <button class="btn btn-danger" id="eliminarMateria" value="eliminar"><i class="bi bi-x-lg fs-5"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <h1>vacio</h1>
            <?php }

            die();
        }

        //ELIMINANDO MATERIAS
        if (isset($_POST['botonEliminar'])) {
            $idMateria = $_POST['idMateria'];

            $validacion = $objeto->validar_eliminar_materia($idMateria);
            if ($validacion == 'stop') {
                echo json_encode('stop');
            } else {
                $objeto->eliminarMateria($idMateria);
                echo json_encode('true');
            }

            die();
        }

        //ACTUALIZANDO MATERIAS
        if (isset($_POST['actualizarMateria'])) {
            $idMateria2 = $_POST['idMateria2'];
            $nombreMateria2 = $_POST['nombreMateria2'];
            $nivelSeleccionado2 = $_POST['seleccionarNivel2'];

            $validacion = $objeto->validar_actualizar_materia($idMateria2, $nombreMateria2, $nivelSeleccionado2);

            if ($validacion == 'denegado') {
                echo json_encode('denegado');
            } else if ($validacion > 0) {
                echo json_encode('encontrada');
            } else {
                $objeto->setActualizar(ucfirst($idMateria2), $nombreMateria2, $nivelSeleccionado2);
                $objeto->actualizarMateria();
                echo json_encode('actualizada');
            }

            die();
        }


        //ELIMINANDO(DESVINCULANDO) PROFESOR DE LA MATERIA
        if (isset($_POST['eliminarProfMat'])) {
            $cedulaProf = $_POST['cedulaProf'];
            $idMateria2 = $_POST['idMateria2'];

            $validacion = $objeto->validar_desvincular_profesorMateria($cedulaProf, $idMateria2);
            if ($validacion > 0) {
                echo json_encode('stop');
            } else {
                $objeto->desvincularProfesor($cedulaProf, $idMateria2);
                echo json_encode('true');
            }

            die();
        }


        //AGREGANDO(VINCULANDO) PROFESOR A LA MATERIA
        if (isset($_POST['actualizarProfesores'])) {
            $idMateriaV = $_POST['idMateriaV'];
            $cedulaProfesorV = $_POST['cedulaProfesorV'];

            $objeto->vincularProfesor($cedulaProfesorV, $idMateriaV);

            die();
        }


        //CONSULTANDO PROFESOR QUE NO ESTEN VINCULADOS A LA MATERIA PARA AGREGAR
        if (isset($_POST['botonEditarProfM'])) {
            $idNoMateria = $_POST['idNoMateria'];

            $profesores2 = $objeto->listarSelectProfesores($idNoMateria);

            ?><select multiple name="seleccionarProfV" id="seleccionarProfV" class="form-control">
                <?php if (!empty($profesores2)) { ?>
                    <option disabled value="ninguno">Seleccione a un profesor</option><?php
                                                                                        foreach ($profesores2 as $prof2) { ?>
                        <option value="<?php echo $prof2['cedula']; ?>"> <?php echo $prof2['codigo'] . ' ' . $prof2['nombre'] . ' ' . $prof2['apellido']; ?></option>
                <?php }
                                                                                    } else {
                                                                                    } ?>
            </select>
            <input hidden id="idMateriaV" value="<?php echo $profesores2[0]['id_materia']; ?>">
        <?php
        
            die();
        }

        

        if (isset($_POST['listar_profesores_materia'])) {
            $idMateriaProf = $_POST['idMateriaProf'];
            $listarProfMat = $objeto->listarProfesoresMateria($idMateriaProf);

            if (!empty($listarProfMat)) {
                foreach ($listarProfMat as $profesorMateria) { ?>
                    <tr>
                        <td hidden id="cedulaProfesor"><?php echo $profesorMateria['cedula_profesor']; ?></td>
                        <td hidden id="idMateriaProfesor"><?php echo $profesorMateria['id_materia']; ?></td>
                        <td><?php echo $profesorMateria['codigo']; ?></td>
                        <td><?php echo $profesorMateria['nombre']; ?></td>
                        <td><?php echo $profesorMateria['apellido']; ?></td>
                        <td>
                            <button class="btn btn-danger" id="eliminarProfesorMateria"><i class="bi bi-x-lg"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <h3>Por ahora no tienes profesores asignados</h3>
                <?php }

            die();
        }



        require_once 'vista/' . $pagina . '.php';
    }
} else {
                echo "<script>
           window.location= 'error.php'
</script>";
            }
