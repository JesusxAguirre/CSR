<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULA VIRTUAL||</title>
    <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/aula-virtual-Prof.css">
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

            <div class="row mt-3">
                <div class="col">
                    <div class="card sombra">
                        <div class="card-body text-center">
                            <h1 class="fw-bold d-inline">INICIO DE TU </h1>
                            <h1 class="text-success d-inline fw-bold">DASHBOARD </h1>
                            <h1 class="d-inline fw-bold">DE LA ECAM</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm col-lg-5 mt-3">
                    <div class="card sombra">
                        <div class="card-body">
                            <div>
                                <h5 class="fw-bold">Profesores de la ECAM</h5>
                            </div>
                            <table class="table table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombres</th>
                                    </tr>
                                </thead>
                                <tbody id="listarProfesores">
                                    <!-- LISTA DE PROFESORES -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-lg-3 mt-3">
                    <div class="card sombra">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">FECHA ACTUAL</h5>
                            <span id="fechaActual"></span>
                        </div>
                    </div>

                    <div class="card sombra mt-3">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">HORA ACTUAL</h5>
                            <span id="horaActual"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-lg-4 mt-3">
                    <div class="card sombra">
                        <div class="card-body">
                            <h6 class="text-center">Cantidad de materias por seccion</h6>
                            <canvas id="grafico_materiasSecciones"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
</body>
<script src="./resources/js/aula-virtual-prof.js"></script>
</html>