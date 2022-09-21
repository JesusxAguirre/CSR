<?php
session_start();
require_once('../../modelo/clase_ecam.php');
$objeto= new ecam;

$listar_misMaterias= $objeto->listar_misMateriasProf();

if (!empty($listar_misMaterias)) {
    foreach ($listar_misMaterias as $misMaterias) { ?>
        <tr>
            <td hidden id=""><?php echo $misMaterias['id_seccion']; ?></td>
            <td hidden id=""><?php echo $misMaterias['cedula']; ?></td>
            <td hidden id=""><?php echo $misMaterias['id_materia']; ?></td>
            <td id=""><?php echo $misMaterias['nombreSeccion']; ?></td>
            <td id=""><?php echo $misMaterias['nombreMateria'].' '.$misMaterias['nivelDoctrina']; ?></td>
            <td>
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal_misContenidosProf">Contenido  <i class="bi bi-card-text"></i></button>
            </td>
        </tr>
        
<?php } ?>

<?php } else { ?>
    <h1>vacio</h1>
<?php } ?>