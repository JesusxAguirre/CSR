<?php
require_once("../../vendor/autoload.php");
session_start();
use Csr\Modelo\Ecam;
$objeto = new ecam();

//AGREGANDO MATERIAS
if (isset($_POST['agregarMateria'])) {
    $nombreMateria= $_POST['nombreMateria'];
    $nivelSeleccionado= $_POST['seleccionarNivel'];
    $cedulaProfesor;

    $validacion = $objeto->validar_materia($nombreMateria, $nivelSeleccionado);

    if ($validacion > 0) {
       echo json_encode('true');
    }else{
        $cedulaProfesor= $_POST['cedulaProfesor'];
        $objeto->setMaterias(ucfirst($nombreMateria), $nivelSeleccionado, $cedulaProfesor);
        $objeto->agregarMaterias();
        echo json_encode('false');
    }
}

//AGREGANDO PROFESORES A LA ECAM
if (isset($_POST['agregarProfesores'])) {
    $cedulaProfesor= $_POST['cedulasProfesores'];
    $objeto->agregar_profesores($cedulaProfesor);
}

//ELIMINANDO MATERIAS
if (isset($_POST['botonEliminar'])) {
    $idMateria= $_POST['idMateria'];

    $validacion = $objeto->validar_eliminar_materia($idMateria);
    if ($validacion == 'stop') {
        echo json_encode('stop');
    }else{
        $objeto->eliminarMateria($idMateria);
        echo json_encode('true');
    }
    
}

//ACTUALIZANDO MATERIAS
if (isset($_POST['actualizarMateria'])) {
    $idMateria2= $_POST['idMateria2'];
    $nombreMateria2= $_POST['nombreMateria2'];
    $nivelSeleccionado2= $_POST['seleccionarNivel2'];

    $validacion = $objeto->validar_materia($nombreMateria2, $nivelSeleccionado2);

    if ($validacion > 0) {
       echo json_encode('true');
    }else{
        $objeto->setActualizar($idMateria2, $nombreMateria2, $nivelSeleccionado2);
        $objeto->actualizarMateria();
        echo json_encode('false');
    }
}


//ELIMINANDO(DESVINCULANDO) PROFESOR DE LA MATERIA
if (isset($_POST['eliminarProfMat'])) {
    $cedulaProf= $_POST['cedulaProf'];
    $idMateria2= $_POST['idMateria2'];

    $objeto->desvincularProfesor($cedulaProf, $idMateria2);
}

//ELIMINANDO PROFESORES DE LA ECAM DEFINITIVAMENTE
if (isset($_POST['eliminar_profesor'])) {
    $cedulaProf= $_POST['cedulaProf'];

    $validacion = $objeto->validar_eliminar_profesor($cedulaProf);
    if ($validacion == 'stop') {
        echo json_encode('stop');
    }else{
        $objeto->eliminar_profesor($cedulaProf);
        echo json_encode('true');
    }
    
}

//AGREGANDO(VINCULANDO) PROFESOR A LA MATERIA
if (isset($_POST['actualizarProfesores'])) {
    $idMateriaV= $_POST['idMateriaV'];
    $cedulaProfesorV= $_POST['cedulaProfesorV'];

    $objeto->vincularProfesor($cedulaProfesorV, $idMateriaV);
}


//CONSULTANDO PROFESOR QUE NO ESTEN VINCULADOS A LA MATERIA PARA AGREGAR
if (isset($_POST['botonEditarProfM'])) {
    $idNoMateria= $_POST['idNoMateria'];
    
    $profesores2 = $objeto->listarSelectProfesores($idNoMateria);

    ?><select multiple name="seleccionarProfV" id="seleccionarProfV" class="form-control">
    <?php if (!empty($profesores2)) { ?>
        <option disabled value="ninguno">Seleccione a un profesor</option><?php
        foreach ($profesores2 as $prof2) { ?>
            <option value="<?php echo $prof2['cedula']; ?>"> <?php echo $prof2['codigo'] . ' ' . $prof2['nombre'].' '.$prof2['apellido']; ?></option>
    <?php }
    }else{

    }?>
      </select>
      <input hidden id="idMateriaV" value="<?php echo $profesores2[0]['id_materia']; ?>">
<?php }

//LISTANDO LOS PROFESORES EN SELECT
if (isset($_POST['listarProfesores'])) {
    $profesores= $objeto->listarProfesores(); ?>

    <select multiple name="seleccionarProf" id="seleccionarProf" class="form-control">
<?php    foreach ($profesores as $prof) : ?>
        <option value="<?php echo $prof['cedula']; ?>"> <?php echo $prof['codigo'] . ' ' . $prof['nombre'].' '.$prof['apellido']; ?></option>
<?php endforeach; ?>                    
    </select>
<?php    
}

//LISTANDO PROFESORES AGREGADOS A LA ECAM EN LA TARJETA
if (isset($_POST['listarProfesores2'])) {
    $profesores= $objeto->listarProfesores();

    if (!empty($profesores)) {
        foreach ($profesores as $key) { ?>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="mb-0">
                            <h6 class="mb-0 fst-italic"><?php echo $key['codigo']; ?></h6>
                            <p class="mb-0"><em><?php echo $key['nombre'].' '.$key['apellido']?></em></p>
                        </div>
                    </div>
                </td>
                <td>
                    <input class="cedulaProfesor d-none" type="text" value="<?php echo$key['cedula'] ?>">
                    <i class="eliminarProfEcam btn bi bi-x-lg text-danger fw-bold fs-5"></i>
                </td>
            </tr>
       <?php } ?>
 <?php }else{ ?>
    <tr>
        <td><i>"Aun no hay profesores agregados"</i></td>
    </tr>
<?php  }
}

if (isset($_POST['listarFuturosProfesores'])) {
    $profesores= $objeto->listar_noProfesores(); ?>
    <select multiple name="profesores[]" id="profesores" class="form-select">
<?php foreach ($profesores as $prof) : ?>
        <option value="<?php echo $prof['cedula']; ?>"> <?php echo $prof['codigo'] . ' ' . $prof['nombre'].' '.$prof['apellido']; ?></option>
<?php endforeach; ?>
    </select><?php           
}


?>


