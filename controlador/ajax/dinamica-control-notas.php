<?php
session_start();
require_once("../../vendor/autoload.php");
use Csr\Modelo\Ecam;
$objeto = new Ecam;

if (isset($_POST['verEstudiantes'])) {
    $estudiantes = $objeto->listarEstudiantes_notaFinal();
    foreach ($estudiantes as $key) { ?>
    <tr>
        <td class="seccion d-none"><?php echo $key['id_seccion']?></td>
        <td class="nivelAcademico d-none"><?php echo $key['nivel_academico'] ?></td>
        <td class="cedula d-none"><?php echo $key['cedula']?></td>
        <td class="infoEst">
            <div class="d-flex align-items-center">
                <div class="fs-2 me-3"><i class="bi bi-person"></i></div>
                <div class="mb-0">
                    <h6 class="mb-0 fst-italic"><?php echo $key['codigo']; ?></h6>
                    <p class="mb-0"><?php echo $key['nombre'] . ' ' . $key['apellido']; ?></p>
                </div>
            </div>
        </td>
        <td><?php echo $key['nombreSeccion'] ?></td>
        <td><?php echo 'Nivel '.$key['nivel_academico'] ?></td>
        <td>
            <?php if ($key['notaFinal'] == 0) { ?>
                <input class="notaFinalEst d-none" value="<?php echo $key['notaFinal'] ?>" type="text">
                <button class="agregarNotaFinal btn btn-primary"><i class="bi bi-plus-lg"></i></button>
                <button class="btn btn-secondary" disabled>SIN NOTA</button>
            <?php } else { ?>
                <button class="verNotaFinal btn btn-success rounded-pill">VER NOTA <i class="bi bi-calculator-fill"></i></button>
                <button class="eliminarNotaFinal btn btn-danger rounded-pill"><i class="bi bi-trash"></i></button>
            <?php } ?>
        </td>
    </tr>
<?php }
}

if (isset($_POST['verNotaFinal'])) {
    $seccion= $_POST['seccion'];
    $cedula= $_POST['cedula'];
    $materiasNotas= $objeto->ver_misNotasMaterias($cedula, $seccion);
    $nota = 0; 
    foreach ($materiasNotas as $key) {
        $nota+= $key['nota'];
    };
    $promedio = number_format($nota/count($materiasNotas), 2);
    
    foreach ($materiasNotas as $mn) {?>
        <div class="row">
            <div class="col-6">
                <h5><?php echo $mn['nombreMateria'].': ' ?></h5>
            </div>
            <div class="col-6">
                <h5><?php echo $mn['nota'].'/20' ?></h5>
            </div>
           
        </div><?php
    }?>
    <div>
        <input class="notaFinalRef d-none" type="text" value="<?php echo $promedio ?>">
        <h2 class="notaFinal"><?php echo $promedio.'/20' ?></h2>
        <h5>DE PROMEDIO</h5>
    </div><?php
}
//GUARDAR NOTA FINAL DEL NIVEL ACADEMICO
if (isset($_POST['guardarNotaFinal'])) {
    $notaFinal= $_POST['notaFinal'];
    $seccion = $_POST['seccion'];
    $cedula = $_POST['cedula'];
    $nivelAcademico = $_POST['nivelAcademico'];
    $objeto->agregar_notaFinal($seccion, $cedula, $notaFinal, $nivelAcademico);
}
//ELIMINAR NOTA FINAL DEL NIVEL ACADEMICO
if (isset($_POST['eliminarNotaFinal'])) {
    $seccion = $_POST['seccion'];
    $cedula = $_POST['cedula'];
    $nivelAcademico= $_POST['nivelAcademico'];
    $objeto->eliminar_notaFinal($seccion, $cedula, $nivelAcademico);
}



?>