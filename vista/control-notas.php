<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULAS VIRTUALES||</title>
    <!-- Espacio para CSS -->
    <?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/boletin_notas.css">
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
            <div class="row">
                <div class="col text-center">
                    <h1 class="titulo text-primary">CONTROL DE NOTAS</h1>
                </div>
            </div>
            <div class="row justify-content-center mt-3" id="listados">
                <div class="col-9">
                    <div class="card sombra">
                        <div class="card-body">
                            <table id="estudiantes" class="table table-hover table-borderless w-100">
                                <thead>
                                    <tr>
                                        <th class="d-none">IDSECCION</th>
                                        <th class="d-none">NIVEl</th>
                                        <th class="d-none">CEDULA</th>
                                        <th>Nombre del estudiante</th>
                                        <th>Seccion</th>
                                        <th>Nivel</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="infoEstudiantes">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>



</body>
<script src="./resources/js/control-notas.js"></script>

</html>