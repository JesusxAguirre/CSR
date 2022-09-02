<?php
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam;

$busqueda= $_POST['buscarMateria'];

$busquedaMaterias= $objeto->buscarMateria($busqueda);

if (!empty($busquedaMaterias)) {
    foreach ($busquedaMaterias as $b_materias) { ?>
        <tr>
            <td><?php echo $b_materias['nombre']; ?></td>
            <td><?php echo $b_materias['nivelDoctrina']; ?></td>
            <td>
                <button class="btn bg-primary text-white"><i class="bi bi-pencil"></i></button>
                <button class="btn bg-danger"><i class="bi bi-x-lg"></i></button>
            </td>
        </tr>
    <?php } ?>
<?php }

?>