<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULA VIRTUAL||</title>
    <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/reportes-ecam.css">
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
            <div class="row mt-3">
                <div class="col-xs-12 col-md-6 col-lg-6 mb-2">
                    <div class="card sombra">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-center font-monospace"><em>Bienvenid@ a los graficos estadisticos de la ECAM</em></h5>
                            <div class="d-flex justify-content-center">
                                <h6 class="fechaActual mx-3">Fecha actual: asdasd</h6><h6 class="horaActual mx-3">Epaleeee</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 mb-2">
                    <div class="card sombra">
                        <div class="card-body text-center">
                            <h6 class="card-title">Cantidad total de profesores en la ECAM</h6>
                            <h2 class="fw-bold"><?php echo $cantidadProfesores ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3 mb-2">
                    <div class="card sombra">
                        <div class="card-body text-center">
                            <h6 class="card-title">Cantidad total de estudiantes en la ECAM</h6>
                            <h2 class="fw-bold"><?php echo $cantidadEstudiantes ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-xs-12 col-md-4 col-lg-4 mb-2">
                    <div class="card sombra">
                        <div class="card-body">
                            <h6 class="card-title text-center">Cantidad de estudiantes por seccion</h6>
                            <canvas id="cantidadEstudiantes"></canvas>
                        </div>
                    </div>
                </div>
               
                <div class="col-xs-12 col-md-8 col-lg-8 mb-2">
                    <div class="card sombra">
                        <div class="card-body">
                            <h6 class="card-title text-center">Cantidad de graduados de la ECAM de este año</h6>
                            <canvas id="graduandosDeHoy"></canvas>
                        </div>
                    </div>  
                </div>
            </div>

        </div>

    </main>
</body>
<script src="./resources/js/reportes-ecam.js"></script>
</html>