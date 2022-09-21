<?php
session_start();
require_once('../../modelo/clase_ecam.php');
$objeto= new ecam;
$listarMaterias= $objeto->listar_misMateriasEst();

if (!empty($listarMaterias)) {
    foreach ($listarMaterias as $listado) { ?>
        <tr>
            <td hidden class=""><?php echo $listado['id_seccion']; ?></td>
            <td hidden class=""><?php echo $listado['id_materia']; ?></td>
            <td hidden class=""><?php echo $listado['cedula']; ?></td>
            <td class=""><?php echo $listado['nombreMateria']; ?></td>
            <td class=""><?php echo $listado['codigo'].' '.$listado['nombre'].' '.$listado['apellido']; ?></td>
            <td>
                <button class="btn btn-outline-secondary" id="" data-bs-toggle="modal" data-bs-target="#">Contenido  <i class="bi bi-body-text"></i></button>
            </td>
        </tr>
<?php } ?>
<?php } else { ?>
    <h1>vacio</h1>
<?php } ?>