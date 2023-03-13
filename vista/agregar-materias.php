<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Materias</title>

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="resources/css/style.css">

    <!-- Mis CSS -->
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
            <div class="row d-flex justify-content-center">
                <div class="col-sm col-lg-8">
                    <div class="titulo text-center mt-5">
                        <h3><em>Agregar Materias</em></h3>
                    </div><br>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <!--INICIO DEl FORMULARIO PARA AGREGAR MATERIAS -->
                <div class="col-sm col-lg-8">
                    <div class="row">
                        <div class="col">
                            <div class="card sombra">
                                <!-- <div class="card-header text-center">
                                    <label class="form-label fw-bold">AGREGAR MATERIAS</label>
                                </div> -->

                                <div class="card-body">
                                    <form id="formularioMateria">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label fst-italic fw-bold" for="nombreMateria">Nombre de la materia</label>
                                                <input type="text" name="nombreMateria" id="nombreMateria" class="form-control inputMateria" placeholder="N0MBR3">
                                                <p hidden id="nomMateriaMal" class="text-danger">Deberias colocar un nombre de 5 a 20 digitos sin numeros y caracteres especiales como (/*_-.,)</p>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label class="form-label fst-italic fw-bold" for="seleccionarNivel">Nivel academico</label>
                                                <select class="form-select selectNivel" name="seleccionarNivel" id="seleccionarNivel">
                                                    <option selected value="ninguno">Selecciona el nivel</option>
                                                    <option value="1">Nivel 1</option>
                                                    <option value="2">Nivel 2</option>
                                                    <option value="3">Nivel 3</option>
                                                    <option value="Seminario">Seminario</option>
                                                </select>
                                                <p hidden id="nivMateriaMal" class="text-danger">Deberias seleccionar un nivel academico</p>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row mt-3" id="formularioAgregarProf">
                                        <label class="form-label fst-italic fw-bold">Profesores que dictaran la materia</label>
                                        <div id="profesoresAgregar" class="">

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary botonGuardar" id="agregarMateria">GUARDAR</button>
                                </div>
                            </div>
                            <!--FIN DEl FORMULARIO PARA AGREGAR MATERIAS -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="resources/js/agregar-materias.js"></script>

</html>