<?php
session_start();
require_once('../../modelo/clase_ecam.php');
$objeto = new ecam;

if (isset($_POST['verListado'])) {
    $aprobados = $objeto->seccionAprobados($_POST['idSeccion']);
    $aplazados = $objeto->seccionAplazados($_POST['idSeccion']); ?>

    <div class="col-5">
        <div class="card sombra">
            <div class="card-header bg-danger text-white">Aplazados</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre del estudiante</th>
                            <th>Nota final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($aplazados)) {
                            foreach ($aplazados as $aplazado) { ?>
                                <tr>
                                    <td><?php echo $aplazado['codigo'] . ' ' . $aplazado['nombre'] . ' ' . $aplazado['apellido'] ?></td>
                                    <td><?php echo $aplazado['notaFinal'] ?></td>
                                </tr>
                        <?php }
                        }else{ ?>
                            <td><i>Aun no hay notas finales por mostrar</i></td>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card sombra">
            <div class="card-header bg-success text-white">Aprobados</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre del estudiante</th>
                            <th>Nota final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($aprobados)) {
                            foreach ($aprobados as $aprobado) { ?>
                                <tr>
                                    <td><?php echo $aprobado['codigo'] . ' ' . $aprobado['nombre'] . ' ' . $aprobado['apellido'] ?></td>
                                    <td><?php echo $aprobado['notaFinal'] ?></td>
                                </tr>
                        <?php }
                        }else{ ?>
                            <td><i>Aun no hay notas finales por mostrar</i></td>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
}


?>