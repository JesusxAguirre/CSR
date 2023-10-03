<!DOCTYPE html>
<html>

<head>
    <title>||Crear seccion||</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/crear-seccion.css">
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
            
            <div class="row mt-3 d-flex justify-content-center">
                <!-- LISTAR TODAS LAS SECCIONES CERRADAS -->
                <div class="col-6">
                    <div class="card sombra oscuro">
                        <div class="card-header">
                            <h6 class="text-white"><em>Secciones cerradas</em></h6>
                        </div>
                        <div class="card-body text-white">
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
                                    <th>Informacion de los Estudiantes</th>
                                    <th>Nota Final</ht>
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