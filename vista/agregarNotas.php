<!DOCTYPE html>
<html>

<head>
    <title>Notas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="./resources/css/agregarNotas.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>
    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>

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
                    <h4 class="text-center fs-1">INGRESO DE NOTAS FINALES</h4>
                    <hr>
                </div>
            </div>

            <!-- FILA 1 -->
            <div class="row">
                <div class="col">
                    <button class="btn btn-primary boton1" data-bs-toggle="collapse" data-bs-target="#nivel1" role="button" aria-expanded="false" aria-controls="collapseExample">
                        NIVEL 1
                    </button>
                </div>
            </div>

            <div class="div cartaMadre" id="nivel1">
                <div class="row">
                    <div class="col text-right">
                        <div class="card cartaBusqueda">
                            <div class="card-body">
                                <div class="text-center mb-2"><input type="text" placeholder="codigo, cedula, nombre"></div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card cartaMateria">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Materia</th>
                                            <th>Nota</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                             asdasdas
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- FILA 1 -->

            <!-- FILA 2 -->
            <div class="row mb-2">
                <div class="col-12 ">
                    <button class="btn btn-primary boton1" data-bs-toggle="collapse" data-bs-target="#nivel2" role="button" aria-expanded="false" aria-controls="collapseExample">
                        NIVEL 2
                    </button>
                    <div class="collapse" id="nivel2">
                        <div class="card card-body">
                            <form action="" method="post">
                                <button type="submit"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FILA 2 -->

            <!-- FILA 3 -->
            <div class="row mb-2">
                <div class="col-12 ">
                    <button class="btn btn-primary boton1" data-bs-toggle="collapse" data-bs-target="#nivel3" role="button" aria-expanded="false" aria-controls="collapseExample">
                        NIVEL 3
                    </button>
                    <div class="collapse" id="nivel3">
                        <div class="card card-body">
                            <form action="" method="post">
                                <button type="submit"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FILA 3 -->

        </div>
    </main>

    <script src="./resources/js/notasAjax.js"></script>
</body>

</html>