<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULAS VIRTUALES||</title>
    <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/aula-virtual-Prof.css">
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
            crear: <?php echo $_SESSION['permisos']['aula_virtual_profesores']['crear'] ? 1 : 0 ?>,
            listar: <?php echo $_SESSION['permisos']['aula_virtual_profesores']['listar'] ? 1 : 0 ?>,
            actualizar: <?php echo $_SESSION['permisos']['aula_virtual_profesores']['actualizar'] ? 1 : 0 ?>,
            eliminar: <?php echo $_SESSION['permisos']['aula_virtual_profesores']['eliminar'] ? 1 : 0 ?>,
        }
    </script>

    <main style="height: 100vh" class="pt-3">
        <div class="container-fluid">
            <!-- BIENVENIDA ECAM -->
            <?php
            require_once "bienvenida-ecam.php";
            ?>
            <!-- FIN DE BIENVENIDA -->

            <div class="row mt-3">
                <div class="col">
                    <div class="card mx-auto sombra" style="width: 75%;">
                        <div class="card-header text-center">
                            ---Mis estudiantes---
                        </div>
                        <div class="card-body" id="cartita">
                        <div class="table-responsive">
                            <table id="tabla_misEstudiantes" class="table table-borderless table-hover w-100">
                                <thead>
                                    <tr>
                                        <th hidden class="py-3 fs-6" scope="col">ID seccion</th>
                                        <th hidden class="py-3 fs-6" scope="col">ID materia</th>
                                        <th hidden class="py-3 fs-6" scope="col">cedula</th>
                                        <th class="rounded-start py-3 fs-6" scope="col">Nombre del estudiante</th>
                                        <th class="py-3 fs-6" scope="col">Materia</th>
                                        <th class="py-3 fs-6" scope="col">Seccion</th>
                                        <th class="rounded-end py-3 fs-6" scope="col">Nota</th>
                                    </tr>
                                </thead>
                                <tbody id="lista_misEstudiantes">

                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </main>
</body>
<script src="./resources/js/mis-estudiantes.js"></script>

</html>