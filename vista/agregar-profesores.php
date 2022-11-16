<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores ECAM</title>

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="resources/css/style.css">

    <!-- Mis CSS -->
    <link rel="stylesheet" href="./resources/css/materias.css">

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>
    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>

    <!-- CHOICE 2 -->
    <link rel="stylesheet" href="resources/library/choice/public/assets/styles/choices.min.css">
    <script src="resources/library/choice/public/assets/scripts/choices.min.js"></script>
    <!-- Sweet alert 2-->
    <script src="resources/js/sweetalert2.js"></script>

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
            <div class="row">
                <div class="col">
                    <div class="titulo text-center">
                        <h3 class="fw-bold"><em>Agregar Profesores</em></h3>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <div class="row mt-4">
                        <div class="col">
                            <div class="card sombra">
                                <div class="card-body">
                                    <!-- <label class="form-label text-center fst-italic fw-bold" for="">Agregar profesores a la ECAM</label> -->
                                    <div id="verProfesoresFuturos">

                                    </div>
                                    <button type="button" class="btn btn-primary botonGuardar" id="crearProfesores">AGREGAR PROFESORES</button><hr>
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