<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULA VIRTUAL||</title>
    <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/mis-notas.css">
	<!-- Espacio para los JS -->
	<?php require_once './resources/View_Components/importJS.php' ?>
</head>

<body>
    <!-- Menu.php -->
    <?php
    require_once "./resources/View_Components/Menu.php";
    ?>
    <!-- Menu.php -->
    <!-- sidebar.php -->
    <?php
    require_once "./resources/View_Components/Sidebar.php";
    ?>
    <!-- sidebar.php -->

    <main style="height: 100vh" class="pt-3">
        <div class="container-fluid">
            <!-- BIENVENIDA ECAM -->
            <?php
            require_once "bienvenida-ecam.php";
            ?>
            <!-- FIN DE BIENVENIDA -->

            <div class="row fuenteTimes">
                <?php if (!empty($misNotas)) {
                    foreach ($misNotas as $key) { ?>
                        <div class="col-sm col-lg-2 mt-3">
                            <div class="card text-center sombra hover">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $key['nombreMateria'].' '.$key['nivelAcademico']; ?></h5>
                                    <h2 class="fw-bold"><?php echo $key['nota'] ?>/20</h2>
                                </div>
                                <div class="card-footer text-muted">
                                    <p><em><small>Agregada el <?php echo $key['fecha_agregado']; ?></small></em></p>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
                <div class="col-sm col-lg-2 mt-3">
                    <div class="card text-center sombra hover">
                        <div class="card-body">
                            <h5 class="card-title">Estas son tus notas actuales</h5>
                        </div>
                        <div class="card-footer text-muted">
                          <p><em><small>Aqui se veran la fecha de agregado</small></em></p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </main>
</body>
<script src="./resources/js/mis-notas.js"></script>
</html>