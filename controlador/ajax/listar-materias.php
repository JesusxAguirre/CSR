<?php
require_once('../../modelo/clase_ecam.php');
$objeto= new ecam;
$listarMaterias= $objeto->listarMaterias();

if (!empty($listarMaterias)) {
    foreach ($listarMaterias as $listado) { ?>
        <tr>
            <td hidden class="idMateria"><?php echo $listado['id_materia']; ?></td>
            <td class="nombreM"><?php echo $listado['nombre']; ?></td>
            <td class="nivelM"><?php echo $listado['nivelAcademico']; ?></td>
            <td>
                <button class="btn btn-success" id="actualizarM" data-bs-toggle="modal" data-bs-target="#modalActualizarMateria"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-danger" id="eliminarMateria" value="eliminar"><i class="bi bi-x-lg"></i></button>
                <button class="btn btn-dark" id="editarProf" title="Ver profesores de la materia" data-bs-toggle="modal" data-bs-target="#modalProf"><i class="bi bi-person-lines-fill"></i></button>
            </td>
        </tr>
<?php } ?>
<?php } else { ?>
    <h1>vacio</h1>
<?php } ?>