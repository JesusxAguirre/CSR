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
    <link rel="stylesheet" href="./node_modules/quill/dist/quill.snow.css">
    <link rel="stylesheet" href="./resources/css/mis-materiasProfesor.css">

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>

    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>

    <!-- JS de DataTables -->
    <script src="./resources/library/dataTables/js/jquery.dataTables.min.js"></script>

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
                        <div class="card-header font-monospace text-center">
                            ---Mis materias---
                        </div>
                        <div class="card-body">
                            <table id="tabla_misMateriasProf" class="table table-borderless table-hover">
                                <thead style="background: #956156; color: white;">
                                    <tr>
                                        <th hidden class="py-3 fs-6" scope="col">ID seccion</th>
                                        <th hidden class="py-3 fs-6" scope="col">Cedula</th>
                                        <th hidden class="py-3 fs-6" scope="col">ID materia</th>
                                        <th class="py-3 fs-6" scope="col">Seccion</th>
                                        <th class="py-3 fs-6" scope="col">Nombre de la materia</th>
                                        <th class="py-3 fs-6" scope="col">Nivel academico</th>
                                        <th class="py-3 fs-6" scope="col">Contenido</th>
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
    </main>


    <!-- //////////////////////////////INICIO DE MODALES/////////////////////////////// -->


    <div class="modal fade" id="modal_misContenidosProf" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-monospace">Contenido de la materia</h5>
                    <span hidden id="seccionContRef"></span><span hidden id="materiaContRef"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="editarContenido">
                        tokitokti
                    </div>
                </div>
                <div class="d-grid">
                    <button type="button" class="btn btn-success" id="guardarCampo">GUARDAR</button>
                </div>
            </div>
        </div>
    </div>
        
</body>
<script src="./node_modules/quill/dist/quill.min.js"></script>
<script src="./resources/js/mis-materiasProfesor.js"></script>


</html>