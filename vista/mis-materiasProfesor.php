<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULAS VIRTUALES||</title>
    <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/mis-materiasProfesor.css">
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
                    <div class="card mx-auto sombra" style="width: 75%;">
                        <div class="card-header font-monospace text-center">
                            ---Mis materias---
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabla_misMateriasProf" class="table table-borderless table-hover ">
                                    <thead class="table-dark">
                                        <tr>
                                            <th hidden class="py-3 fs-6" scope="col">ID seccion</th>
                                            <th hidden class="py-3 fs-6" scope="col">Cedula</th>
                                            <th hidden class="py-3 fs-6" scope="col">ID materia</th>
                                            <th class="py-3 fs-6" scope="col">Seccion</th>
                                            <th class="py-3 fs-6" scope="col">Nombre de la materia</th>
                                            <th class="py-3 fs-6" scope="col">Nivel academico</th>
                                            <th class="py-3 fs-6" scope="col">Informacion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listar_misMateriasProf">

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


    <!-- //////////////////////////////INICIO DE MODALES/////////////////////////////// -->


    <div class="modal fade" id="modal_misContenidosProf" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-monospace">Descripcion de la materia</h5>
                    <span hidden id="seccionContRef"></span><span hidden id="materiaContRef"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="editarContenido">

                    </div>
                </div>
                <div class="d-grid">
                    <button type="button" class="btn btn-primary" id="guardarCampo">GUARDAR</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="./node_modules/quill/dist/quill.min.js"></script>
<script src="./resources/js/mis-materiasProfesor.js"></script>


</html>