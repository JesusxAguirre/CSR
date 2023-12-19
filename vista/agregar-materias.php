<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Materias</title>
    <!-- Espacio para CSS -->
    <?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/materias.css">
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
            crear: <?php echo $_SESSION['permisos']['materias']['crear'] ? 1 : 0 ?>,
            listar: <?php echo $_SESSION['permisos']['materias']['listar'] ? 1 : 0 ?>,
            actualizar: <?php echo $_SESSION['permisos']['materias']['actualizar'] ? 1 : 0 ?>,
            eliminar: <?php echo $_SESSION['permisos']['materias']['eliminar'] ? 1 : 0 ?>,
        }
    </script>

    <main style="height: 100vh" class="pt-3">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <!--INICIO DEl FORMULARIO PARA AGREGAR MATERIAS -->
                <div class="col-sm col-lg-8">
                    <div class="row">
                        <div class="col">
                            <div class="card sombra">
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