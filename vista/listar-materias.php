<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias</title>
    <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/materias.css">
	<!-- Espacio para los JS -->
	<?php require_once './resources/View_Components/importJS.php' ?>
</head>
<body class="fondoEcam">
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

            <div class="row d-flex justify-content-center">
                <div class="col-sm">
                    <div class="contenedorMaterias">

                        <!-- BUSCADOR DE MATERIA -->
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control text-center buscarMateria" id="buscarMateria" placeholder="Nombre o nivel academico">
                        </div>
                        <!-- FIN DE BUSCADOR DE MATERIA -->
                        <div class="table-responsive">
                            <table class="table table-light text-center table-centered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>MATERIAS</th>
                                        <th>NIVEL ACADEMICO</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody id="datosMaterias">
                                    <!-- AQUI MOSTRARA LAS MATERIAS DE LA BD -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>




            <!-- MODAL DE EDITAR DATOS DE LA MATERIA -->
            <div class="modal fade" id="modalActualizarMateria" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS DE LA MATERIA</h5>
                            <button type="button" class="btn-close cancelarActualizar" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input hidden type="text" id="idMateria2">
                            <div class="mb-3">
                                <label for="nombreMateria2" class="form-label">Nombre de la materia</label>
                                <input type="text" class="form-control inputMateria" id="nombreMateria2" placeholder="NOMBREXXXX">
                                <p hidden id="nomMateriaMal2">Deberias colocar un nombre de 3 a 20 digitos sin caracteres especiales como (/*_-.,)</p>
                            </div>
                            <div class="mb-3">
                                <label for="seleccionarNivel2" class="form-label">Nivel de doctrina</label>
                                <select class="form-select selectNivel" id="seleccionarNivel2">
                                    <option value="ninguno">Selecciona el nivel</option>
                                    <option value="1">Nivel 1</option>
                                    <option value="2">Nivel 2</option>
                                    <option value="3">Nivel 3</option>
                                    <option value="Seminario">Seminario</option>
                                </select>
                                <p hidden id="nivMateriaMal2">Deberias seleccionar un nivel academico</p>
                            </div>

                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary botonActualizar" id="actualizarMateria" value="actualizarMateria">ACTUALIZAR</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger botonEliminar cancelarActualizar" data-bs-dismiss="modal">CERRAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN DEL MODAL DE EDITAR DATOS DE LA MATERIA -->



            <!-- MODAL DE EDITAR PROFESORES QUE DICTAN LA MATERIA -->
            <div class="modal fade" id="modalProf" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">PROFESORES QUE DICTAN LA MATERIA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <table class="table table-striped text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Opcion</th>
                                        </tr>
                                    <tbody id="datos2">
                                        <!-- TABLA DE LOS PROFESORES ASIGNADOS A ESA MATERIA -->
                                    </tbody>
                                    </thead>
                                </table>
                            </div>
                            <hr>
                            <label class="form-label fst-italic fw-bold">Agregar profesores</label>
                            <form id="formularioVincularProf">
                                <div id="datos3">

                                </div>
                            </form>
                        </div>
                        <div>
                            <button class="btn btn-primary botonActualizar" id="actualizarProfesores">AGREGAR PROFESORES</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="resources/js/listar-materias.js"></script>

</html>