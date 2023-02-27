<?php
session_start();
require_once("../../vendor/autoload.php");
use Csr\Modelo\Ecam;
$objeto= new ecam;


if (isset($_POST['verMaterias'])) {
    $listarMaterias= $objeto->listar_misMateriasEst();

    if (!empty($listarMaterias)) {
        foreach ($listarMaterias as $listado) { ?>
            <div class="col-3 mt-3 me-3">
                <div class="card sombra hover">
                    <div class="position-relative">
                        <img src="./resources/img/pizarra.png" class="card-img-top" alt="...">
                        <h5 class="position-absolute top-50 start-50 translate-middle text-white"><?php echo $listado['nombreMateria']; ?></h5>
                    </div>
                    <div class="d-grip">
                        <input class="contenidoMateria d-none" disabled type="text" value="<?php echo ($listado['contenido'] == NULL || $listado['contenido'] == '<p><br></p>') ? 'Aun no tienes contenido en esta materia' : $listado['contenido'] ?>">
                        <button class="verContenido btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#modal_misContenidosEst">Ver contenido <i class="bi bi-body-text"></i></button>
                    </div>
                </div>
            </div>
    <?php } ?>
    <?php } else { ?>
        <div class="col-3 mt-3 me-3">
                <div class="card sombra hover">
                    <div class="position-relative">
                        <img src="./resources/img/pizarra.png" class="card-img-top" alt="...">
                        <h5 class="position-absolute top-50 start-50 translate-middle text-white text-center">Por ahora no tienes materias por cursar</h5>
                    </div>
                </div>
            </div>
    <?php }
}


