<?php
session_start();
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam;

if (isset($_POST['datosSeccionMaterias'])) {
    $json= $objeto->cantidad_materiasSecciones();

    echo json_encode($json);
}

if (isset($_POST['verProfesores'])) {
    $listaProfesores= $objeto->listarProfesores();

    if (!empty($listaProfesores)) {
        foreach ($listaProfesores as $key) { ?>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="fs-2 me-3"><i class="bi bi-person"></i></div>
                        <div class="mb-0">
                            <h6 class="mb-0 fst-italic"><?php echo $key['codigo']; ?></h6>
                            <p class="mb-0"><?php echo $key['nombre'].' '.$key['apellido']; ?></p>
                        </div>
                    </div>
                </td>
            </tr>
       <?php } ?>
 <?php }else{ ?>
    <tr>
        <td><i>"Aun no tienes compañeros en la seccion"</i></td>
    </tr>
<?php  }
}


?>