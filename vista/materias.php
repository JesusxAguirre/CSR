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
                <div class="col-4">
                    <div class="card cardMateria text-white bg-dark">
                        <div class="card-header text-center">
                            <div>
                                <h2>AGREGAR MATERIA</h2>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <form id="formAgregarMateria">
                            <div class="row">
                                <div class="col text-center">
                                    <h5>Nombre de la materia</h5>
                                    <input type="text" id="nombreMateria" name="nombreMateria" placeholder="XXXXX">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col text-center">
                                    <h5>Nivel de doctrina</h5>
                                    <select name="seleccionarNivel" class="w-50 text-center" id="seleccionarNivel">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="especial">Especial</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <button type="submit" id="agregarMateria">GUARDAR</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="contenedorMaterias">

                        <!-- BUSCADOR DE MATERIA -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control text-center buscarMateria" id="buscarMateria" placeholder="Nombre o nivel de doctrina">
                        </div>
                        <!-- FIN DE BUSCADOR DE MATERIA -->

                        <table class="table text-center mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>MATERIAS</th>
                                    <th>NIVEL DE DOCTRINA</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="datosMaterias">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <div class="modal fade" id="modalActualizar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS DE LA MATERIA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombreMateria2" class="form-label">Nombre de la materia</label>
                        <input type="text" class="form-control" id="nombreMateria2" placeholder="NOMBREXXXX">
                    </div>
                    <div class="mb-3">
                        <label for="seleccionarNivel2" class="form-label">Nivel de doctrina</label>
                        <select class="form-select" id="seleccionarNivel2">
                            <option selected>Open this select menu</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="especial">Especial</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-success botonActualizar" id="actualizarMateria">ACTUALIZAR</button>
                </div>  
                <div>
                    <button type="button" class="btn btn-danger botonEliminar" data-bs-dismiss="modal">CANCELAR</button>
                </div>
            </div>
        </div>
    </div>


    <script src="resources/js/materias.js"></script>
</body>

</html>