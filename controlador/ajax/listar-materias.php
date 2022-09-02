<?php
require_once('../../modelo/clase_ecam.php');
$objeto= new ecam;
$listarMaterias= $objeto->listarMaterias();

if (!empty($listarMaterias)) {
    foreach ($listarMaterias as $listado) { ?>
        <tr>
            <td hidden class="idMateria"><?php echo $listado['id_materia']; ?></td>
            <td><?php echo $listado['nombre']; ?></td>
            <td><?php echo $listado['nivelDoctrina']; ?></td>
            <td>
                <button class="btn btn-success text-white actualizarMateria" data-bs-toggle="modal" data-bs-target="#modalActualizar"><i class="bi bi-pencil"></i></button>
                <button class="btn bg-danger eliminarMateria"><i class="bi bi-x-lg"></i></button>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <h1>vacio</h1>
<?php } ?>