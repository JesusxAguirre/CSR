<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias</title>

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="./resources/css/materias.css">

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>
    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>
    
    <!-- CHOICE 2 -->
    <link rel="stylesheet" href="resources/library/choice/public/assets/styles/choices.min.css">
    <script src="resources/library/choice/public/assets/scripts/choices.min.js"></script>
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
                <div class="col">
                    <div class="titulo text-center">
                        <h1>MATERIAS</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <!--INICIO DEl FORMULARIO PARA AGREGAR MATERIAS -->
                <div class="col-4">
                    <div class="card bg-dark">
                        <div class="card-header text-center">
                            <label class="form-label fw-bold text-white">AGREGAR MATERIAS</label>
                        </div>

                        <div class="card-body">
                            <form id="formularioMateria">
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label fst-italic fw-bold text-white" for="nombreMateria">Nombre de la materia</label>
                                        <input type="text" name="nombreMateria" id="nombreMateria" class="form-control inputMateria" placeholder="N0MBR3">
                                        <p hidden id="nomMateriaMal" class="text-danger">Deberias colocar un nombre de 3 a 20 digitos sin caracteres especiales como (/*_-.,)</p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <label class="form-label fst-italic fw-bold text-white" for="seleccionarNivel">Nivel de doctrina</label>
                                        <select class="form-select selectNivel" name="seleccionarNivel" id="seleccionarNivel">
                                            <option selected value="ninguno">Selecciona el nivel</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="Seminario">Seminario</option>
                                        </select>
                                        <p hidden id="nivMateriaMal" class="text-danger">Deberias seleccionar un nivel de doctrina</p>
                                    </div>
                                </div>
                            </form>
                            <div class="row mt-3" id="formularioAgregarProf">
                                
                                <label class="form-label fst-italic fw-bold text-white">Profesores que dictan la materia</label>
                                <select multiple name="seleccionarProf" id="seleccionarProf" class="form-control">
                                    <?php foreach ($profesores as $prof) : ?>
                                        <option value="<?php echo $prof['cedula']; ?>"> <?php echo $prof['codigo'] . ' ' . $prof['nombre']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success botonGuardar" id="agregarMateria">GUARDAR</button>
                        </div>
                    </div>
                </div>
                <!--FIN DEl FORMULARIO PARA AGREGAR MATERIAS -->


                <div class="col">
                    <div class="contenedorMaterias">

                        <!-- BUSCADOR DE MATERIA -->
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control text-center buscarMateria" id="buscarMateria" placeholder="Nombre o nivel de doctrina">
                        </div>
                        <!-- FIN DE BUSCADOR DE MATERIA -->

                        <table class="table table-light table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>MATERIAS</th>
                                    <th>NIVEL DE DOCTRINA</th>
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
    </main>

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
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="Seminario">Seminario</option>
                        </select>
                        <p hidden id="nivMateriaMal2">Deberias seleccionar un nivel de doctrina</p>
                    </div>

                </div>
                <div>
                    <button type="submit" class="btn btn-success botonActualizar" id="actualizarMateria" value="actualizarMateria">ACTUALIZAR</button>
                </div>
                <div>
                    <button type="button" class="btn btn-warning botonEliminar cancelarActualizar" data-bs-dismiss="modal">CERRAR</button>
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
                        <table class="table table-success table-striped text-center">
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
                    <button type="submit" class="btn btn-success botonActualizar" id="actualizarProfesores">AGREGAR PROFESORES</button>
                </div>
            </div>
        </div>
    </div>

    <script src="resources/js/materias.js"></script>
</body>

</html>