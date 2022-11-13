<!DOCTYPE html>
<html>

<head>
    <title>||Crear seccion||</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resources/css/style.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">

    <!-- MIS CSS -->
    <link rel="stylesheet" href="./resources/css/crear-seccion.css">

    <!-- DATATABLES CSS -->
    <link rel="stylesheet" href="./resources/library/dataTables/css/jquery.dataTables.min.css">

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>

    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>

    <!-- JS de DataTables -->
    <script src="./resources/library/dataTables/js/jquery.dataTables.min.js"></script>

    <!-- CHOICE 2 -->
    <link rel="stylesheet" href="./resources/library/choice/public/assets/styles/choices.min.css">
    <script src="./resources/library/choice/public/assets/scripts/choices.min.js"></script>

    <!-- SELECT2 -->
    <link rel="stylesheet" href="./resources/library/Select2/css/select2.css">
    <link rel="stylesheet" href="./resources/library/Select2/css/select2-bootstrap4.min.css">
    <script src="./resources/library/Select2/js/select2.full.min.js"></script>

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
            <div class="row text-center">
                <h4>CREAR SECCION</h4>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <!-- LISTAR TODAS LAS SECCIONES CERRADAS -->
                <div class="col-6">
                    <div class="card sombra oscuro">
                        <div class="card-header">
                            <h6 class="text-danger"><em>Secciones cerradas</em></h6>
                        </div>
                        <div class="card-body text-white">
                            <!-- <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Escribe la secciones que desees buscar">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">@</span>
                                </div>
                            </div> -->
                            <table class="table mt-3 text-white">
                                <thead>
                                    <tr>
                                        <th>Nombre de la seccion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="listarSeccionesOFF">
                                    <!-- SECCIONES CERRADAS -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- VER ESTUDIANTES QUE ESTUVIERON EN LA SECCION -->
    <div class="modal fade" id="estudiantesPasados" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloSeccionOFF"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="" class="table table-borderless table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Informacion de los estudiantes</th>
                                </tr>
                            </thead>
                            <tbody id="estudiantes_seccionCerrada">
                                <!-- LISTA DE ESTUDIANTES DE LA SECCION CERRADA-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./resources/js/listar-secciones-cerradas.js"></script>
</body>

</html>