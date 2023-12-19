<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULAS VIRTUALES||</title>
    <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
    <link rel="stylesheet" href="./resources/css/boletin_notas.css">
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

    <main style="height: 100vh" class="pt-3 fondoBoletin">
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center">
                    <h1 class="titulo">BOLETIN DE</h1>
                    <h1 class="titulo">NOTAS</h1>
                    <nav class="navbar">
                        <form class="container-fluid justify-content-center" id="elegirSeccion">
                            <?php if (!empty($listarBotones)) {
                                foreach ($listarBotones as $boton) { ?>
                                <div>
                                    <button onclick="verListado(<?php echo $boton['id_seccion'] ?>)" class="btn btn-light me-2" type="button"><?php echo $boton['nombre'].' (Nivel '.$boton['nivel_academico'].')' ?></button>
                                </div>
                              <?php } 
                            }else{ ?>
                            <h6>Aun no hay secciones</h6>
                        <?php } ?>
                        </form>
                    </nav>
                </div>
            </div>
            <div class="row justify-content-center mt-3" id="listados">
                
            </div>

        </div>

    </main>



</body>
<script src="./resources/js/boletin_notas.js"></script>
</html>