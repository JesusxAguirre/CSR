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
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-5 text-center">
                    <button class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#form1">PRESIONA AQUI PARA CREAR UNA SECCION</button>
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
                    <button type="button" class="cerrarCrear btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formulario_datosSeccion">
                        <!-- Aqui creamos este form para validar estos campos -->
                        <!-- CAMPO DE NOMBRE DE SECCION -->
                        <label class="form-label">Introduzca el nombre de la seccion</label>
                        <input type="text" id="nombreSeccion" name="nombreSeccion" class="form-control">
                        <div hidden class="alert-danger" role="alert" id="alertaNombre">
                            ¡Deberias colocar un nombre de 6 a 20 digitos sin caracteres especiales como (/*_-.,)!
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
                        <div class="mt-3">
                            <label class="form-label" for="fechaCierre">Ingresa la fecha de cierre</label>
                            <input id="fechaCierre" name="fechaCierre" class="form-control" type="date">
                            <div hidden class="alert-danger" role="alert" id="alertaFecha">
                                ¡No elegiste una fecha de cierre!
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button disabled id="siguiente1" class="btn btn-primary" >Siguiente</button>
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
                    <button type="button" class="cerrarCrear btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aqui se mostraran las materias de dichi nivel seleccionado -->
                    <div id="datos_PM">
                        <!-- MENSAJE DE ADVERTENCIA SI SE PASAN LA SEGURIDAD -->
                        <h2 class="text-center text-white">SELECCIONE EL NIVEL ACADEMICO DE LA SECCION</h2>
                    </div>
                    <!-- Aqui se mostrara si el usuario quiere agregar seminarios como materia adicional -->
                    <div class="row mt-3">
                        <form id="formulario_seminarioSeccion">
                            <div class="row mt-3">
                                <span>Si desea agregar un seminario, puede seleccionarlo aqui:</span>
                                <div class="col-5 mt-2">
                                    <!-- Aqui lista todos los seminarios disponibles -->
                                    <select id="seleccionarMateriaSeminario" class="form-select" name="seminario">

                                    </select>
                                </div>

                                <div class="col-7 mt-2">
                                    <!-- Aqui selecciona el profesor disponible de el seminario seleccionado -->
                                    <select disabled id="seleccionarProfesorSeminario" class="form-select" name="profesorSeminario">

                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-target="#form1" data-bs-toggle="modal" data-bs-dismiss="modal">Regresar</button>
                    <button type="button" class="btn btn-primary" id="siguiente2">Siguiente</button>
                </div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="form3" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-monospace">AGREGAR ESTUDIANTES</h5>
                    <button type="button" class="cerrarCrear btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="datos_E">

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-target="#form2" data-bs-toggle="modal" data-bs-dismiss="modal">Regresar</button>
                </div>
                <div class="d-grid mt-3">
                    <button disabled class="btn btn-success" id="crear">CREAR SECCION <i class="bi bi-plus-circle"></i></button>
                </div>
            </div>
        </div>
    </div>





    <script src="./resources/js/crear-secciones.js"></script>
</body>

</html>