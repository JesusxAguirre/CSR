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
    <link rel="stylesheet" href="./resources/css/mis-notas.css">

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