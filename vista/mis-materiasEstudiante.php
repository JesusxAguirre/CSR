<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULAS VIRTUALES||</title>
    <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/mis-materiasEstudiante.css">
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

    <main style="height: 100vh" class="pt-3">
        <div class="container-fluid">
            <!-- BIENVENIDA ECAM -->
            <?php
            require_once "bienvenida-ecam.php";
            ?>
            <!-- FIN DE BIENVENIDA -->

            <div class="row" id="verCartas">
                <!-- AQUI SE MOSTRARAN LAS MATERIAS DEL ESTUDIANTE -->
            </div>

        </div>

    </main>

    <!----------------------------------------INICIO DE MODAL PARA VER CONTENIDO  ----------------------------------------->

    <div class="modal fade" id="modal_misContenidosEst" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-monospace">Descripcion de la materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="miContenido">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur enim ea voluptatem ad quod, laborum molestiae cumque saepe cupiditate alias voluptas, repellat unde consequatur quos nostrum. Vitae magnam eum fuga.
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="./resources/js/mis-materiasEstudiantes.js"></script>

</html>