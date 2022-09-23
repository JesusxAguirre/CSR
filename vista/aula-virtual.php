<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULAS VIRTUALES||</title>

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="./resources/library/dataTables/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="./resources/library/dataTables/css/jquery.dataTables.min.css">

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>
    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>

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

            <div class="row mt-3">
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="fw-bold d-inline">¡HOLA! ESTE ES TU </h1>
                            <h1 class="text-success d-inline fw-bold">DASHBOARD </h1>
                            <h1 class="d-inline fw-bold">DE LA ECAM</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="fw-bold">Compañeros de la seccion X</h4>
                            </div>
                            <table class="table table-borderless mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombres</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Michael Schrumacher</th>
                                    </tr>
                                    <tr>
                                        <th>Cristiano Ronaldo</th>
                                    </tr>
                                    <tr>
                                        <th>Lionel Messi</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="display-6"><i class="bi bi-boxes mx-3 d-inline"></i></span>
                                <div>
                                    <h5 class="d-flex fw-bold mb-0">26</h5>
                                    <span>Materias cursando</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="display-6"><i class="bi bi-boxes mx-3 d-inline"></i></span>
                                <div>
                                    <h5 class="d-flex fw-bold mb-0">26</h5>
                                    <span>Materias cursando</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    
                </div>
            </div>

        </div>

    </main>
</body>
<script src="./resources/js/aula-virtual.js"></script>

</html>