<!DOCTYPE html>
<html>

<head>
    <title>||Crear seccion||</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resources/css/style.css">
    <link rel="stylesheet" href="./resources/css/agregarNotas.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./resources/library/dataTables/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="./resources/library/dataTables/css/jquery.dataTables.min.css">

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>

    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>

    <!-- JS de DataTables -->
    <script src="./resources/library/dataTables/js/jquery.dataTables.min.js"></script>

    <!-- CHOICE 2 -->
    <!-- <link rel="stylesheet" href="./resources/library/choice/public/assets/styles/choices.min.css"> -->
    <!-- <script src="./resources/library/choice/public/assets/scripts/choices.min.js"></script> -->

    <!-- SELECT2 -->
    <link rel="stylesheet" href="./resources/library/Select2/css/select2.min.css">
    <!-- <link rel="stylesheet" href="./resources/library/Select2/css/select2-bootstrap4.min.css"> -->
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
            <div class="row">
                <div class="col-3">
                    <div class="card bg-success">
                        <div class="card-header text-white text-center">
                            <h5 class="card-title">NOMBRE Y NIVEL DE DOCTRINA</h5>
                        </div>
                        <div class="card-body">
                            <!-- CAMPO DE NOMBRE DE SECCION -->
                            <label class="form-label text-white">Introduzca el nombre de la seccion</label>
                            <input type="text" id="nombreSeccion" class="form-control">

                            <!-- CAMPO SELECCION DE NIVEL -->
                            <div class="mt-3">
                                <label class="form-label text-white" for="nivelSeccion">Selecciona el nivel de doctrina de la seccion</label>
                                <select id="nivelSeccion" class="form-select">
                                    <option value="ninguno" selected>Seleccione un nivel</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>

                <div class="col-7">
                    <div class="card bg-warning">
                        <div class="card-header text-center">
                            <h5 class="card-title">MATERIAS Y PROFESORES</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col"><label for="" class="form-label">Seleccionar materia:</label></div>
                                <div class="col"><label for="" class="form-label">Seleccionar profesor:</label></div>
                            </div>
                            <div class="row row-cols-2" id="datos_PM">

                            </div>

                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>

                <div class="col-4 mt-3">
                    <div class="card bg-primary">
                        <div class="card-header text-center">
                            <h5 class="card-title">AGREGAR ESTUDIANTES</h5>
                        </div>
                        <div class="card-body">
                            <div id="datos_E">

                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" id="crear">GUARDAR</button>
                </div>

















                <!-- <div class="row">
                <div class="col-12">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>CODIGO</th>
                                <th>NOMBRE</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>-->
                <!-- LISTADO DE LOS ESTUDIANTES -->
                <!--</tbody>
                    </table>
                </div>
            </div>-->

            </div>
    </main>

    <script src="./resources/js/crear-seccion.js"></script>

</body>

</html>