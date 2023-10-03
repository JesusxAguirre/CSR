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
    
    if (!$_SESSION['permisos']['secciones_cerradas']['listar']) {
        echo "<script>
		alert('No tienes los permisos para este modulo');
		window.location= 'index.php?pagina=mi-perfil'
		</script>";

    }
    if (is_file('vista/'.$pagina.'.php')) {
       
        $objeto= new Ecam();
        
        $cedula = $_SESSION['cedula'];
        $accion = 'El usuario ha entrado al apartado de "Listar Secciones Cerradas" de la ECAM';
        $id_modulo = 3;
        $objeto->set_registrar_bitacora($cedula, $accion, $id_modulo);

        //ELIMINAR SECCION SELECCIONADA DEFINITIVAMENTE
        if (isset($_POST['eliminarSeccion2'])) {
            $seccionOFF = $_POST['idSeccionCerrada'];

            $validacion = $objeto->validar_eliminar_seccion($seccionOFF);
            if ($validacion > 0) {
                echo json_encode('stop');
            } else {
                $objeto->eliminarSeccion($seccionOFF);
                echo json_encode('true');
            }

            die();
        }

        //LISTAR LAS SECCIONES CERRADAS
        if (isset($_POST['verSeccionesOFF'])) {
        $listarSeccionesOFF= $objeto->listarSeccionesOFF();

        if (!empty($listarSeccionesOFF)) {
            foreach ($listarSeccionesOFF as $seccionesOFF) { ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="fs-2 me-3 text-danger"><i class="bi bi-house"></i></div>
                            <div class="mb-0">
                                
                                <h6 class="mb-0 fst-italic"><?php echo $seccionesOFF['nombre'].' (Nivel '.$seccionesOFF['nivel_academico'].')'; ?></h6>
                                <p class="mb-0"><em><?php echo 'Fecha de cerrado: '.$seccionesOFF['fecha_cierre'];?></em></p>
                            </div>
                            
                        </div>
                    </td>
                    <td>
                        <input class="idSeccion_cerrada d-none" type="text" value="<?php echo $seccionesOFF['id_seccion'] ?>">
                        <input class="nombre_seccionCerrada d-none" type="text" value="<?php echo $seccionesOFF['nombre'] ?>">
                        <button type="button" id="estudiantesOFF" title="Ver estudiantes" class="btn btn-outline-info" data-bs-target="#estudiantesPasados" data-bs-toggle="modal"><i class="bi bi-search"></i></button>
                        <?php if ($_SESSION['rol'] == 1) { ?>
                            <button type="button" id="eliminarSeccionOFF" title="Eliminar definitivamente" class="btn btn-outline-danger"><i type="button" class="bi bi-trash"></i></button><?php
                        }?>
                    </td>
                </tr> <?php
            }
        }else{ ?>
                <tr>
                    <td><h5><em>Aun no hay secciones cerradas</em></h5></td>
                </tr> <?php
        }

        die();
    }


    //LISTAR ESTUDIANTES DE LAS SECCIONES CERRADAS
    if (isset($_POST['verEstudiantes_seccionCerrada'])) {
        $idSeccionCerrada = $_POST['idSeccionCerrada'];
        $estudiantesOFF= $objeto->estudiantes_seccionOFF($idSeccionCerrada);

        if (!empty($estudiantesOFF)) {
            foreach ($estudiantesOFF as $estOFF) { ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="fs-2 me-3 text-secondary"><i class="bi bi-person-video2"></i></div>
                            <div class="mb-0">
                                <h6 class="mb-0 fst-italic"><?php echo $estOFF['codigo']; ?></h6>
                                <p class="mb-0"><em><?php echo $estOFF['nombre'].' '.$estOFF['apellido'];?></em></p>
                            </div>
                            
                        </div>
                    </td>
                    <td>
                        <div class="d-grid">
                            <button disabled class="btn <?php echo $estOFF['nota_final'] >= 16 ?'btn-primary':'btn-danger' ?>"><?php echo $estOFF['nota_final'] ?></button>
                        </div>
                    </td>
                </tr><?php
            }
        }else{ ?>
                <tr>
                    <td><h5><em>No hubo estudiantes en esta seccion :(</em></h5></td>
                </tr> <?php
        }

        die();
    }
        



    
        require_once 'vista/'.$pagina.'.php';

    }

} else { 
    echo "<script>
    alert('Inicia sesion ');
    window.location= 'error.php'
    </script>";
}     
?>  