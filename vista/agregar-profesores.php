<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores ECAM</title>
    <!-- Espacio para CSS -->
    <?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/materias.css">
    <!-- Espacio para los JS -->
    <?php require_once './resources/View_Components/importJS.php' ?>
    <!-- Mis CSS -->
</head>

<body class="fondoEcam">
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

            <div class="row d-flex justify-content-center">
                <div class="col-sm col-lg-6">
                    <div class="row mt-4">
                        <div class="col">
                            <div class="card sombra">
                                <div class="card-body">
                                    <!-- <label class="form-label text-center fst-italic fw-bold" for="">Agregar profesores a la ECAM</label> -->
                                    <div id="verProfesoresFuturos">

                                    </div>
                                    <button type="button" class="btn btn-primary botonGuardar" id="crearProfesores">AGREGAR PROFESORES</button>
                                    <hr>
                                    <table class="table table-hover table-borderless">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>Profesores actuales</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listarProfesores">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="resources/js/agregar-profesores.js"></script>

</html>