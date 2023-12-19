<!DOCTYPE html>
<html>

<head>
    <title>||Listar Secciones||</title>
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

    <script>
        const permisos = {
            crear: <?php echo $_SESSION['permisos']['secciones']['crear'] ? 1 : 0 ?>,
            listar: <?php echo $_SESSION['permisos']['secciones']['listar'] ? 1 : 0 ?>,
            actualizar: <?php echo $_SESSION['permisos']['secciones']['actualizar'] ? 1 : 0 ?>,
            eliminar: <?php echo $_SESSION['permisos']['secciones']['eliminar'] ? 1 : 0 ?>,
        }
    </script>

    <main style="height: 100vh" class="pt-3">
        <div class="container-fluid">
            <div class="row mt-3">

                <!-- LISTAR TODAS LAS SECCIONES CREADAS -->
                <div class="col m-auto">
                    <div class="card cartaSeccionesList mt-2">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="listaSecciones" class="table table-borderless table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>NIVEL</th>
                                            <th>Fecha de cierre</th>
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
        </div>
    </main>



    <!-----------------------------------------------------------  ------------------------------------------------------>
    <!-----------------------------------------------------------  ------------------------------------------------------>

    <!-- MODAL PARA EDITAR DATOS DE LA SECCION -->
    <div class="modal fade" id="modalEditarDatosSeccion" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">EDITA LOS DATOS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="d-none" id="idSeccionRefU" type="text">
                    <label class="form-label">Ingresa el nombre de la seccion</label>
                    <input id="nombreSeccionEdit" class="form-control" type="text">
                    <div hidden class="alert-danger" role="alert" id="alertaEditNombre">
                        ¡Debes cumplir con el minimo de 8 caracteres evitando caracteres especiales!
                    </div>
                    <hr>
                    <label class="form-label" for="">Selecciona el nivel de la seccion</label>
                    <select id="nivelDoctrinaEdit" class="form-select">
                        <option value="ninguno">Selecciona el nivel</option>
                        <option value="1">Nivel 1</option>
                        <option value="2">Nivel 2</option>
                        <option value="3">Nivel 3</option>
                    </select>
                    <div hidden class="alert-danger" role="alert" id="alertaEditNivel">
                        ¡Debes seleccionar un nivel!
                    </div>
                    <hr>
                    <label class="form-label" for="fechaCierreEdit">Ingresa la fecha de cierre</label>
                    <input id="fechaCierreEdit" name="fechaCierreEdit" class="form-control" type="date">
                    <div hidden class="alert-danger" role="alert" id="alertaFechaEdit">
                        ¡No elegiste una fecha de cierre!
                    </div>
                </div>
                <div class="d-grid">
                    <button type="button" class="btn btn-primary" id="guardarEditado1">GUARDAR</button>
                </div>
                <div class="d-grid">
                    <button type="button" class="btn btn-secondary" id="cerrarEditado1" data-bs-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FINAL DEL MODAL PARA EDITAR DATOS DE LA SECCION -->


    <!-- MODAL PARA EDITAR LOS ESTUDIANTES QUE ESTAN EN LA SECCION -->
    <div class="modal fade" id="modalEditarEstudiantesSeccion" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <input class="d-none" id="nivelAcademicoRef" type="text">
                    <input class="d-none" id="idSeccionRef2" type="text">
                    <h5>ESTUDIANTES DE LA SECCION</h5>
                    <hr>
                    <div class="table-responsive">
                        <table id="listaEstudiantes" class="table table-striped table-hover" style="width:100%">
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
                    <button class="btn btn-primary" id="agregarEditado2">AGREGAR ESTUDIANTES <i class="bi bi-person-plus-fill"></i></button>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-secondary" id="cerrarEditado2" data-bs-dismiss="modal">CERRAR</button>
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
                        <table id="listaProfesores" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="table-primary">MATERIA</th>
                                    <th>CODIGO</th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDO</th>
                                </tr>
                            </thead>
                            <tbody id="listaProfDatos">
                                <!-- LISTA DE ESTUDIANTES DE LA SECCION -->
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex" id="selectMasProfesoresMaterias">

                        <div class="w-50 me-1" id="select1">

                        </div>
                        <div class="w-50 ms-1 select2">
                            <select disabled class="form-select" id="seleccionarProfesoresAdicionales">

                            </select>
                        </div>

                    </div>
                    <div hidden class="alertaSelect1 alert alert-danger" role="alert">
                        ¡Debes seleccionar una materia!
                    </div>
                    <div hidden class="alertaSelect2 alert alert-danger" role="alert">
                        ¡Debes seleccionar un profesor!
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary" id="agregarEditado3">AGREGAR <i class="bi bi-journal-check"></i></button>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-secondary" id="cerrarEditado3" data-bs-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FINAL DEL MODAL PARA EDITAR LOS ESTUDIANTES QUE ESTAN EN LA SECCION -->
    <script src="./resources/js/listar-secciones.js"></script>
</body>

</html>