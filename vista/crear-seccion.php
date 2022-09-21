<!DOCTYPE html>
<html>

<head>
    <title>||Crear seccion||</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resources/css/style.css">
    <link rel="stylesheet" href="./resources/css/crear-seccion.css">
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
            <div class="row mt-3">
                <div class="col-7">
                    <div class="row">
                        <div class="col">
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
                                            <option value="I">Doctrina I</option>
                                            <option value="II">Doctrina II</option>
                                            <option value="II+Oracion">Doctrina II con Oracion</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">

                                </div>
                            </div>
                        </div>

                        <!-- AGREGAR ESTUDIANTES A LA SECCION -->
                        <div class="col-7">
                            <div class="card bg-primary cartaEstudiantes">
                                <div class="card-header text-center">
                                    <h5 class="card-title text-white">AGREGAR ESTUDIANTES</h5>
                                </div>
                                <div class="card-body">
                                    <div id="datos_E">

                                    </div>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SELECCIONAR LOS PROFESORES Y MATERIAS -->
                    <div class="row mt-3">
                        <div class="col">
                            <div class="card bg-warning">
                                <div class="card-header text-center">
                                    <h5 class="card-title">MATERIAS Y PROFESORES</h5>
                                </div>
                                <div class="card-body">
                                    <div id="datos_PM">
                                        <h2 class="text-center text-white">SELECCIONE EL NIVEL DE DOCTRINA DE LA SECCION</h2>
                                    </div>

                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-grid mt-3">
                                <button class="btn btn-success fs-1" id="crear">AGREGAR <i class="bi bi-plus-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LISTAR TODAS LAS SECCIONES CREADAS -->
                <div class="col">
                    <div class="card bg-light cartaSeccionesList">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="listaSecciones" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>DOCTRINA</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- LISTADO DE LAS SECCIONES -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </main>

    <!-- /////////////////////////INICIO DE LOS MODALES///////////////////////// -->

    <!-- MODAL PARA EDITAR DATOS DE LA SECCION -->
    <div class="modal fade" id="modalEditarDatosSeccion" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">EDITA LOS DATOS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input hidden id="idSeccionRefU" type="text">
                    <label class="form-label">Ingresa el nombre de la seccion</label>
                    <input id="nombreSeccionEdit" class="form-control" type="text">
                    <hr>
                    <label class="form-label" for="">Selecciona el nivel de doctrina</label>
                    <select id="nivelDoctrinaEdit" class="form-select" name="" id="">
                        <option value="ninguno">Selecciona el la doctrina</option>
                        <option value="I">Doctrina I</option>
                        <option value="II">Doctrina II</option>
                        <option value="II+Oracion">Doctrina II con Oracion</option>
                    </select>
                    <hr>
                </div>
                <div class="d-grid">
                    <button type="button" class="btn btn-success" id="guardarEditado1">GUARDAR</button>
                </div>
                <div class="d-grid">
                    <button type="button" class="btn btn-warning" id="cerrarEditado1" data-bs-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FINAL DEL MODAL PARA EDITAR DATOS DE LA SECCION -->


    <!-- MODAL PARA EDITAR LOS ESTUDIANTES QUE ESTAN EN LA SECCION -->
    <div class="modal fade" id="modalEditarEstudiantesSeccion" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- <div class="modal-header">
                            <h5 class="modal-title">EDITA LOS DATOS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>-->
                <div class="modal-body">
                    <input hidden id="idSeccionRef2" type="text">
                    <h5>ESTUDIANTES DE LA SECCION</h5>
                    <hr>
                    <div class="table-responsive">
                        <table id="listaEstudiantes" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th hidden>CEDULA</th>
                                    <th>CODIGO</th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="listaEstDatos">
                                <!-- LISTA DE ESTUDIANTES DE LA SECCION -->
                            </tbody>
                        </table>
                    </div>

                    <div id="selectMasEstudiantes">

                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-success" id="agregarEditado2">AGREGAR ESTUDIANTES <i class="bi bi-person-plus-fill"></i></button>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-warning" id="cerrarEditado2" data-bs-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FINAL DEL MODAL PARA EDITAR LOS ESTUDIANTES QUE ESTAN EN LA SECCION -->


    <!-- MODAL PARA EDITAR LOS PROFESORES QUE ESTAN EN LA SECCION -->
    <div class="modal fade" id="modalEditarProfesoresSeccion" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- <div class="modal-header">
                            <h5 class="modal-title">EDITA LOS DATOS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>-->
                <div class="modal-body">
                    <input hidden id="idSeccionProfMatU" type="text">
                    <span hidden id="nivDoctrinaSeccionProfMatU"></span>
                    <h5>MATERIAS Y PROFESORES DE LA SECCION: "<span id="nombreSeccionProMatfU"></span>"</h5>
                    <hr>
                    <div class="table-responsive">
                        <table id="listaProfesores" class="table table-borderless table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="table-info">MATERIA</th>
                                    <th class="table-primary">CODIGO</th>
                                    <th class="table-primary">NOMBRE</th>
                                    <th class="table-primary">APELLIDO</th>
                                </tr>
                            </thead>
                            <tbody id="listaProfDatos">
                                <!-- LISTA DE ESTUDIANTES DE LA SECCION -->
                            </tbody>
                        </table>
                    </div>
                    <div class="row" id="selectMasProfesoresMaterias">
                        <!-- AQUI MUESTRA LOS SELECT -->
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-success" id="agregarEditado3">AGREGAR <i class="bi bi-journal-check"></i></button>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-warning" id="cerrarEditado3" data-bs-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FINAL DEL MODAL PARA EDITAR LOS ESTUDIANTES QUE ESTAN EN LA SECCION -->

    <script src="./resources/js/crear-seccion.js"></script>

</body>

</html>