<?php
require_once('../../modelo/clase_ecam.php');
$objeto= new ecam;

$idMateriaProf= $_POST['idMateriaProf'];
$listarProfMat= $objeto->listarProfesoresMateria($idMateriaProf);

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
<?php } ?>