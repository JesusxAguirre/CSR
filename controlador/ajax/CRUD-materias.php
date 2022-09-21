<?php
session_start();
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam();

//AGREGANDO MATERIAS
if (isset($_POST['agregarMateria'])) {
    $nombreMateria= $_POST['nombreMateria'];
    $nivelSeleccionado= $_POST['seleccionarNivel'];
    $cedulaProfesor= $_POST['cedulaProfesor'];
    $objeto->setMaterias(ucfirst($nombreMateria), $nivelSeleccionado, $cedulaProfesor);
    $objeto->agregarMaterias();
}


//ELIMINANDO MATERIAS
if (isset($_POST['botonEliminar'])) {
    $idMateria= $_POST['idMateria'];

    $objeto->eliminarMateria($idMateria);
}


//ACTUALIZANDO MATERIAS
if (isset($_POST['actualizarMateria'])) {
    $idMateria2= $_POST['idMateria2'];
    $nombreMateria2= $_POST['nombreMateria2'];
    $nivelSeleccionado2= $_POST['seleccionarNivel2'];

    $objeto->setActualizar($idMateria2, $nombreMateria2, $nivelSeleccionado2);
    $objeto->actualizarMateria();
}


//ELIMINANDO(DESVINCULANDO) PROFESOR DE LA MATERIA
if (isset($_POST['eliminarProfMat'])) {
    $cedulaProf= $_POST['cedulaProf'];
    $idMateria2= $_POST['idMateria2'];

    $objeto->desvincularProfesor($cedulaProf, $idMateria2);
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
    <?php foreach ($profesores2 as $prof2) { ?>
            <option value="<?php echo $prof2['cedula']; ?>"> <?php echo $prof2['codigo'] . ' ' . $prof2['nombre']; ?></option>
    <?php } ?>
      </select>
      <input hidden id="idMateriaV" value="<?php echo $profesores2[0]['id_materia']; ?>">
<?php }

?>


