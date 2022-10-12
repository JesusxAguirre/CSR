<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULA VIRTUAL||</title>

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="./resources/library/dataTables/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="./resources/library/dataTables/css/jquery.dataTables.min.css">

    <!-- Mis CSS -->
    <link rel="stylesheet" href="./resources/css/reportes-ecam.css">

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>
    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>

    <!-- Charts JS -->
    <script src="./node_modules/chart.js/dist/chart.js"></script>

    <!-- JS de DataTables -->
    <script src="./resources/library/dataTables/js/jquery.dataTables.min.js"></script>

    <!-- CHOICE 2 -->
    <link rel="stylesheet" href="resources/library/choice/public/assets/styles/choices.min.css">
    <script src="resources/library/choice/public/assets/scripts/choices.min.js"></script>
    
    <!-- Sweet alert 2-->
    <script src="resources/js/sweetalert2.js"></script>
    
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

    <main style="height: 100vh" class="pt-3 fondoEcam">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card sombra">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-center font-monospace"><em>Bienvenid@ a los graficos estadisticos de la ECAM</em></h5>
                            <div class="d-flex justify-content-center">
                                <h6 class="fechaActual mx-3">Fecha actual: asdasd</h6><h6 class="horaActual mx-3">Epaleeee</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card sombra">
                        <div class="card-body text-center">
                            <h6 class="card-title">Cantidad total de profesores en la ECAM</h6>
                            <h2 class="fw-bold"><?php echo $cantidadProfesores ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card sombra">
                        <div class="card-body text-center">
                            <h6 class="card-title">Cantidad total de estudiantes en la ECAM</h6>
                            <h2 class="fw-bold"><?php echo $cantidadEstudiantes ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <div class="card sombra">
                        <div class="card-body">
                            <h6 class="card-title text-center">Cantidad de estudiantes por seccion</h6>
                            <canvas id="cantidadEstudiantes"></canvas>
                        </div>
                    </div>
                </div>
               
                <div class="col-8">
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
</html>