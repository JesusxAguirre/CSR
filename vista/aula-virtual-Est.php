<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>||AULA VIRTUAL||</title>

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="resources/css/style.css">
    
    <link rel="stylesheet" href="./resources/library/dataTables/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="./resources/library/dataTables/css/jquery.dataTables.min.css">

    <!-- Mis CSS -->
    <link rel="stylesheet" href="./resources/css/aula-virtual-Est.css">

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>
    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>

    <!-- JS de DataTables -->
    <script src="./resources/library/dataTables/js/jquery.dataTables.min.js"></script>

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
            <!-- BIENVENIDA ECAM -->
            <?php
            require_once "bienvenida-ecam.php";
            ?>
            <!-- FIN DE BIENVENIDA -->

            <div class="row mt-3">
                <div class="col">
                    <div class="card sombra">
                        <div class="card-body text-center">
                            <h1 class="fw-bold d-inline">INICIO DE TU </h1>
                            <h1 class="text-success d-inline fw-bold">DASHBOARD </h1>
                            <h1 class="d-inline fw-bold">DE LA ECAM</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm col-lg-4">
                    <div class="card sombra cartaEstilo">
                        <div style="background-color: #fff;" class="card-body">
                            <div>
                                <h4 class="fw-bold">Mis compañeros</h4>
                            </div>
                            <table class="table table-borderless table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($mis_companeros)) {
                                        foreach ($mis_companeros as $key1) { ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 me-3"><i class="bi bi-person"></i></div>
                                                        <div class="mb-0">
                                                            <h6 class="mb-0 fst-italic"><?php echo $key1['codigo']; ?></h6>
                                                            <p class="mb-0"><?php echo $key1['nombre'].' '.$key1['apellido']; ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                       <?php } ?>
                                 <?php }else{ ?>
                                    <tr>
                                        <td><i>"Aun no tienes compañeros en la seccion"</i></td>
                                    </tr>
                               <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm">
                    <div class="card sombra cartaEstilo">
                        <div  style="background-color: #fff;"  class="card-body text-center">
                            <h5 class="fw-bold">SECCION</h5>
                            <h5><i><?php echo '"'.$mis_datosSeccion[0]['nombreSeccion'].'"'; ?></i></h5>
                        </div>
                    </div>

                    <div class="card mt-3 sombra cartaEstilo">
                        <div style="background-color: #fff;" class="card-body">
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="display-6"><i class="bi bi-boxes mx-3 d-inline"></i></span>
                                <div>
                                    <h5 class="d-flex fw-bold mb-0"><?php echo $mis_datosSeccion[0]['cantidadMaterias'] ?></h5>
                                    <span>Materias cursando</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3 sombra cartaEstilo">
                        <div style="background-color: #fff;" class="card-body text-center">
                            <h5 class="fw-bold">FECHA DE CIERRE</h5>
                            <h6><i><?php echo $mis_datosSeccion[0]['fecha_cierre'] ?></i></h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm col-lg-5">
                <div class="card sombra cartaEstilo">
                        <div style="background-color: #fff;" class="card-body">
                            <div>
                                <h4 class="fw-bold">Mis profesores</h4>
                            </div>
                            <table class="table table-borderless table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($mis_profesores)) {
                                        foreach ($mis_profesores as $key2) { ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="display-6 me-3"><i class="bi bi-person-lines-fill"></i></div>
                                                        <div class="mb-0">
                                                            <h6 class="mb-0 fst-italic"><?php echo $key2['codigo']; ?></h6>
                                                            <p class="mb-0"><?php echo $key2['nombre'].' '.$key2['apellido'].', profesor de '?><i class="fw-bold">"<?php echo$key2['nombreMateria']; ?>"</i></p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                       <?php } ?>
                                 <?php }else{ ?>
                                    <tr>
                                        <td><i>"Aun no tienes profesores en la seccion"</i></td>
                                    </tr>
                               <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
</body>
<script src="./resources/js/aula-virtual-est.js"></script>
</html>