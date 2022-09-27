<?php
session_start();
require_once('../../modelo/clase_ecam.php');
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
                        <input class="contenidoMateria d-none" disabled type="text" value="<?php echo $listado['contenido']; ?>">
                        <button class="verContenido btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#modal_misContenidosEst">Ver contenido <i class="bi bi-body-text"></i></button>
                    </div>
                </div>
            </div>
    <?php } ?>
    <?php } else { ?>
        <h1>vacio</h1>
    <?php }
}


