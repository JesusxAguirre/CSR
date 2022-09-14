<!DOCTYPE html>
<html>

<head>
    <title>Notas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">

    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resources/css/style.css">
    <link rel="stylesheet" href="./resources/css/agregarNotas.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./resources/library/dataTables/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="./resources/library/dataTables/css/jquery.dataTables.min.css">

    <!-- Jquery-->
    <script src="./resources/js/jquery-3.6.0.min.js"></script>
    <!-- Js boostrap -->
    <script src="./resources/js/bootstrap.min.js"></script>
    <!-- JS de DataTables -->
    <script src="./resources/library/dataTables/js/jquery.dataTables.min.js"></script>
    


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
                <div class="col-12">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>SECCION</th>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>MATERIA</th>
                                <th>NOTA</th>
                                <th>OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- LISTADO DE LOS ESTUDIANTES -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <script src="./resources/js/notas.js"></script>
    
</body>

</html>