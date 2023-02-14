<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat online
    </title>

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="resources/css/style.css">

    <!-- Mis CSS -->
    <!-- <link rel="stylesheet" href="./resources/css/chat.css"> -->

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>
    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>

    <!-- CHOICE 2 -->
    <link rel="stylesheet" href="resources/library/choice/public/assets/styles/choices.min.css">
    <script src="resources/library/choice/public/assets/scripts/choices.min.js"></script>
    <!-- Sweet alert 2-->
    <script src="resources/js/sweetalert2.js"></script>
<style>
    #areaChat{
        height: 650px;
        overflow-y: auto;
        background-color: #e6e6e6;
    }
</style>
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
        <div class="container">
            <div class="row mt-3">
                <div class="mt-2 col-lg-12">
                    <div class="card ">
                        <div class="card-header bg-success">
                            <h3>Sala de chat</h3>
                        </div>
                        <div class="card-body" id="areaChat">

                        </div>
                    </div>
                        <form id="chatForm" class="h-100">
                            <div class="input-group mb-3    ">
                                <textarea name="mensaje" id="mensaje" class="form-control" placeholder="Escribe el mensaje"></textarea>
                                <div class="input-group-append">
                                    <button disabled type="submit" id="enviar" class="btn btn-primary"><i class="bi bi-send fs-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </main>
    <input hidden id="nombre" value="<?php echo $nombre; ?>">
    <input hidden id="apellido" value="<?php echo $apellido; ?>">







</body>
<!-- <script src="resources/js/webSocket_prueba.js"></script>  -->
<script src="resources/js/chat-aguirre.js"></script>


</html>