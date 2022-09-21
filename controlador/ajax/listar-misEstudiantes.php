<?php
session_start();
require_once('../../modelo/clase_ecam.php');
$objeto= new ecam;

$listar_misEstudiantes= $objeto->listar_misEstudiantes();

if (!empty($listar_misEstudiantes)){
    foreach ($listar_misEstudiantes as $misEst) { ?>
        <tr>
            <td hidden><?php echo $misEst['id_seccion']; ?></td>
            <td hidden><?php echo $misEst['id_materia']; ?></td>
            <td hidden><?php echo $misEst['cedula']; ?></td>
            <td><?php echo $misEst['codigo'].' '.$misEst['nombre'].' '.$misEst['apellido']; ?></td>
            <td><?php echo $misEst['nombreMateria'].' '.$misEst['nivelDoctrina']; ?></td>
            <td><?php echo $misEst['nombreSeccion']; ?></td>
            <td>
                <button class="btn btn-outline-secondary" id="" data-bs-toggle="modal" data-bs-target="#">NOTA  <i class="bi bi-calculator-fill"></i></button>
            </td>
        </tr>
<?php }
}

?>