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

    <!-- Mis CSS -->
    <link rel="stylesheet" href="./resources/css/aula-virtual-Prof.css">

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

    <main style="height: 100vh" class="pt-3 fondoEcam">
        <div class="container-fluid">
            <!-- BIENVENIDA ECAM -->
            <?php
            require_once "bienvenida-ecam.php";
            ?>
            <!-- FIN DE BIENVENIDA -->

            <div class="row mt-3">
                <div class="col">
                    <div class="card mx-auto sombra" style="width: 75%;">
                        <div class="card-header text-center">
                            ---Mis estudiantes---
                        </div>
                        <div class="card-body" id="cartita">
                            <table id="tabla_misEstudiantes" class="table table-borderless table-hover w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th hidden class="py-3 fs-6" scope="col">ID seccion</th>
                                        <th hidden class="py-3 fs-6" scope="col">ID materia</th>
                                        <th hidden class="py-3 fs-6" scope="col">cedula</th>
                                        <th class="rounded-start py-3 fs-6" scope="col">Nombre del estudiante</th>
                                        <th class="py-3 fs-6" scope="col">Materia</th>
                                        <th class="py-3 fs-6" scope="col">Seccion</th>
                                        <th class="rounded-end py-3 fs-6" scope="col">Nota</th>
                                    </tr>
                                </thead>
                                <tbody id="lista_misEstudiantes">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </main>
</body>
<script src="./resources/js/mis-estudiantes.js"></script>

</html>