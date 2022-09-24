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
    <!-- <link rel="stylesheet" href="./resources/library/dataTables/css/dataTables.bootstrap5.css"> -->
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
                
                <!-- LISTAR TODAS LAS SECCIONES CREADAS -->
                <div class="col-7 m-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form1">PRESIONA AQUI PARA CREAR UNA SECCION</button>
                    <div class="card bg-light cartaSeccionesList mt-2">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="listaSecciones" class="table table-borderless table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>NIVEL</th>
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

    <div class="modal fade" id="form1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content formModal1">
                <div class="modal-header">
                    <h5 class="modal-title font-monospace fw-bold">DATOS DE LA SECCION</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formulario_datosSeccion">  <!-- Aqui creamos este form para validar estos campos -->
                        <!-- CAMPO DE NOMBRE DE SECCION -->
                        <label class="form-label">Introduzca el nombre de la seccion</label>
                        <input type="text" id="nombreSeccion" name="nombreSeccion" class="form-control">
                        <div hidden class="alert-danger" role="alert" id="alertaNombre">
                            ¡Deberias colocar un nombre de 8 a 20 digitos sin caracteres especiales como (/*_-.,)!
                        </div>
                        <!-- FIN DEL CAMPO NOMBRE -->
                        <!-- CAMPO SELECCION DE NIVEL -->
                        <div class="mt-3">
                            <label class="form-label" for="nivelSeccion">Selecciona el nivel de la seccion</label>
                            <select id="nivelSeccion" class="form-select">
                                <option value="ninguno" selected>Seleccione un nivel</option>
                                <option value="1">Nivel 1</option>
                                <option value="2">Nivel 2</option>
                                <option value="3">Nivel 3</option>
                            </select>
                            <div hidden class="alert-danger" role="alert" id="alertaSeccion">
                                ¡No elegiste un nivel academico!
                            </div>
                        </div>
                        <!-- FIN DEL CAMPO SELECCION DE NIVEL -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button disabled id="siguiente1" class="btn btn-dark" data-bs-target="#form2" data-bs-toggle="modal" data-bs-dismiss="modal">Siguiente</button>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="form2" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content formModal2">
                <div class="modal-header">
                    <h5 class="modal-title font-monospace fw-bold">MATERIAS Y PROFESORES</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="datos_PM">
                    <h2 class="text-center text-white">SELECCIONE EL NIVEL ACADEMICO DE LA SECCION</h2>
                </div>
                <div class="alert alert-danger" role="alert">
                    ¡No dejes campos vacios!
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-target="#form1" data-bs-toggle="modal" data-bs-dismiss="modal">Regresar</button>
                    <button class="btn btn-dark" data-bs-target="#form3" data-bs-toggle="modal" data-bs-dismiss="modal">Siguiente</button>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="form3" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content formModal3">
                <div class="modal-header">
                    <h5 class="modal-title text-white font-monospace">AGREGAR ESTUDIANTES</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="datos_E">

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-target="#form2" data-bs-toggle="modal" data-bs-dismiss="modal">Regresar</button>
                </div>
                <div class="d-grid mt-3">
                    <button class="btn btn-success" id="crear">CREAR SECCION <i class="bi bi-plus-circle"></i></button>
                </div>
            </div>
        </div>
    </div>









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
                    <label class="form-label" for="">Selecciona el nivel de la seccion</label>
                    <select id="nivelDoctrinaEdit" class="form-select" name="" id="">
                        <option value="ninguno">Selecciona el nivel</option>
                        <option value="1">Nivel 1</option>
                        <option value="2">Nivel 2</option>
                        <option value="3">Nivel 3</option>
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