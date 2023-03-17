<?php
session_start();
require_once("../../vendor/autoload.php");
use Csr\Modelo\Ecam;
$objeto = new Ecam();

if (isset($_POST['agregarNota'])) {
    $notaEstudiante = $_POST['notaEstudiante'];
    $notaIDseccion = $_POST['notaIDseccion'];
    $notaIDmateria = $_POST['notaIDmateria'];
    $notaCIestudiante = $_POST['notaCIestudiante'];

    $objeto->setNotaMateriaEstudiante($notaIDseccion, $notaIDmateria, $notaCIestudiante);
    $objeto->agregarNotaMateria($notaEstudiante);
}



if (isset($_POST['verNota'])) {
    $notaCIestudianteRef = $_POST['notaCIestudianteRef'];
    $notaIDmateriaRef = $_POST['notaIDmateriaRef'];
    $notaIDseccionRef = $_POST['notaIDseccionRef'];

    $notaDelEstudiante = $objeto->listarNota_miEstudiante($notaIDmateriaRef, $notaIDseccionRef, $notaCIestudianteRef);

    echo $notaDelEstudiante[0]['nota'];
}

if (isset($_POST['actualizarNota'])) {
    $notaCIestudiante2 = $_POST['notaCIestudiante2'];
    $notaIDmateria2 = $_POST['notaIDmateria2'];
    $notaIDseccion2 = $_POST['notaIDseccion2'];
    $notaNueva = $_POST['notaNueva'];

    $validacion = $objeto->validar_eliminar_notaMateria($notaCIestudiante2, $notaIDseccion2);
    if ($validacion > 0) {
        echo json_encode('denegado');
    }else{
        $objeto->setActualizarMateriaEstudiante($notaIDseccion2, $notaIDmateria2, $notaCIestudiante2);
        $objeto->actualizarNotaMateria($notaNueva);
        echo json_encode('actualizada');
    }
}

if (isset($_POST['eliminarNota'])) {
    $cedulaEstudianteRef2= $_POST['cedulaEstudianteRef2'];
    $idMateriaRef2= $_POST['idMateriaRef2'];
    $idSeccionRef2= $_POST['idSeccionRef2'];

    $validacion = $objeto->validar_eliminar_notaMateria($cedulaEstudianteRef2, $idSeccionRef2);
    if ($validacion > 0) {
        echo json_encode('stop');
    }else{
        $objeto->eliminarNotaMateria($cedulaEstudianteRef2, $idMateriaRef2, $idSeccionRef2);
         echo json_encode('true');
    }
}



// AQUI TODOS LOS ESTUDIANTES QUE MANEJA EL PROFESOR
if (isset($_POST['listarMisEstudiantes'])) {

    $listar_misEstudiantes = $objeto->listar_misEstudiantes();

    if (!empty($listar_misEstudiantes)) { 
         foreach ($listar_misEstudiantes as $misEst) { ?>
            
            <tr>
                <td class="notaIDseccion" hidden><?php echo $misEst['id_seccion']; ?></td>
                <td class="notaIDmateria" hidden><?php echo $misEst['id_materia']; ?></td>
                <td class="notaCIestudiante" hidden><?php echo $misEst['cedula']; ?></td>
                <td class="notaNombreEstudiante">
                    <div class="d-flex align-items-center">
                        <div class="fs-2 me-3"><i class="bi bi-person"></i></div>
                        <div class="mb-0">
                            <h6 class="mb-0 fst-italic"><?php echo $misEst['codigo']; ?></h6>
                            <p class="mb-0"><?php echo $misEst['nombre'] . ' ' . $misEst['apellido']; ?></p>
                        </div>
                    </div>
                </td>
                <td class="notaNombreMateria"><?php echo $misEst['nombreMateria'] . ' (Nivel ' . $misEst['nivelAcademico'].')'; ?></td>
                <td><?php echo $misEst['nombreSeccion']; ?></td>
                <td>
                    <?php if ($misEst['nota'] == '') { ?>
                        <button class="agregarNota btn btn-secondary">AGREGAR NOTA</button>
                    <?php } else { ?>
                        <button class="verNotaAgregada btn btn-primary">VER NOTA <i class="bi bi-calculator-fill"></i></button>
                        <button class="eliminarNota btn btn-danger"><i class="bi bi-file-earmark-minus-fill"></i></button>
                    <?php } ?>
                </td>
            </tr>
<?php } 
  }
}

?>