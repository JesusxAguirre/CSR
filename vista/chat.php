<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Virtual</title>

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="resources/css/style.css">

    <!-- Mis CSS -->
    <link rel="stylesheet" href="./resources/css/chat.css">

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
                <div class="col-xs-9 col-md-9 col-lg-8">

                    <div class="chatCont">
                        <span class="d-none" id="usuarioSocket">
                            <?php echo $_SESSION['nombre'] ?>
                        </span>
                        <span class="d-none" id="cedulaSocket">
                            <?php echo $_SESSION['cedula'] ?>
                        </span>
                        <div class="d-grid bg-primary">
                            <div class="text-center text-white fst-italic h4 fw-bold">Chat Global</div>
                        </div>
                        <div class="chatArea" id="areaChat">
                            <!-- Aqui van los mensajes -->
                            <?php
                            foreach ($chat_datos as $key) {
                                if ($_SESSION['cedula'] == $key['user']) {
                                    $from = 'Me';
                                    $class1 = "d-flex justify-content-start";
                                    $class2 = "msgStyle alert alert-primary";
                                } else {
                                    $from = $key['nombre'] . ' ' . $key['apellido'];
                                    $class1 = "d-flex justify-content-end";
                                    $class2 = "msgStyle alert alert-secondary";
                                }
                                echo '<div class="' . $class1 . '">
                                    <div class="' . $class2 . '">
                                        ' . $key['msg'] . '
                                        <div class="divisorMsg"></div>
                                        <span class="msgInfo d-flex justify-content-between"><i class="me-5"><b>' . $from . ':</b></i> ' . $key['hora_msg'] . '</span>
                                    </div>
                                  </div>';
                            }
                            ?>
                            <!-- <div class="d-flex justify-content-end">
                        <div class="msgStyle alert alert-warning">
                            A simple primary alert—csdsdasdasdasdasdasdasdasdasdasd
                            <div class="divisorMsg"></div>
                            <span class="msgInfo d-flex justify-content-between"><i><b>Me</b></i> 12:27PM</span>
                        </div>
                    </div> -->

                        </div>
                        <form id="chatForm">
                            <div class="mensajeArea">
                                <div class="mensajeDiv">
                                    <textarea name="mensaje" id="mensajeChat" class="form-control w-100"
                                        placeholder="Escribe el mensaje"></textarea>
                                </div>
                                <div class="enviarDiv"><button disabled type="submit" id="enviarMensajeChat"
                                        class="btn btn-primary">ENVIAR</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main>
</body>

</html>