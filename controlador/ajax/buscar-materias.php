<?php
require_once("../../vendor/autoload.php");

session_start();
use Csr\Modelo\Ecam;
$objeto = new Ecam();

$busqueda= $_POST['buscarMateria'];

$busquedaMaterias= $objeto->buscarMateria($busqueda);

if (!empty($busquedaMaterias)) {
    foreach ($busquedaMaterias as $b_materias) { ?>
        <tr>
            <td hidden class="idMateria"><?php echo $b_materias['id_materia']; ?></td>
            <td class="nombreM"><?php echo $b_materias['nombre']; ?></td>
            <td class="nivelM"><?php echo $b_materias['nivelAcademico']; ?></td>
            <td>
                <button class="btn btn-primary" id="actualizarM" data-bs-toggle="modal" data-bs-target="#modalActualizarMateria"><i class="bi bi-pencil-fill fs-5"></i></button>
                <button class="btn btn-primary" id="verProf" title="Ver profesores de la materia" data-bs-toggle="modal" data-bs-target="#modalProf"><i class="bi bi-person-lines-fill fs-5"></i></button>
                <button class="btn bg-danger" id="eliminarMateria" value="eliminar"><i class="bi bi-x-lg fs-5"></i></button>
            </td>
        </tr>
<?php } ?>
<?php } else { ?>
    <h1>vacio</h1>
<?php } ?>