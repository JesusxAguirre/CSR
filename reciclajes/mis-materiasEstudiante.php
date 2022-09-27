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
                    <div class="card mx-auto" style="width: 75%;">
                        <div class="card-header text-center">
                            ---Mis materias---
                        </div>
                        <div class="card-body">
                            <table id="tablaMisMateriasEst" class="table table-borderless table-hover">
                                <thead style="background: #956156; color: white;">
                                    <tr>
                                        <th hidden class="py-3 fs-6" scope="col">ID SECCION</th>
                                        <th hidden class="py-3 fs-6" scope="col">ID materia</th>
                                        <th hidden class="py-3 fs-6" scope="col">Cedula profesor</th>
                                        <th class="rounded-start py-3 fs-6" scope="col">Nombre de la materia</th>
                                        <th class="py-3 fs-6" scope="col">Nombre del profesor</th>
                                        <th class="rounded-end py-3 fs-6" scope="col">Contenido</th>
                                    </tr>
                                </thead>
                                <tbody id="listaMisMateriasEst">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
</body>
<script src="./resources/js/mis-materiasEstudiantes.js"></script>

</html>
<?php
session_start();
require_once('../../modelo/clase_ecam.php');
$objeto= new ecam;
$listarMaterias= $objeto->listar_misMateriasEst();

if (!empty($listarMaterias)) {
    foreach ($listarMaterias as $listado) { ?>
        <tr>
            <td hidden class=""><?php echo $listado['id_seccion']; ?></td>
            <td hidden class=""><?php echo $listado['id_materia']; ?></td>
            <td hidden class=""><?php echo $listado['cedula']; ?></td>
            <td class=""><?php echo $listado['nombreMateria']; ?></td>
            <td class=""><?php echo $listado['codigo'].' '.$listado['nombre'].' '.$listado['apellido']; ?></td>
            <td>
                <button class="btn btn-outline-secondary" id="" data-bs-toggle="modal" data-bs-target="#">Contenido  <i class="bi bi-body-text"></i></button>
            </td>
        </tr>
<?php } ?>
<?php } else { ?>
    <h1>vacio</h1>
<?php } ?>