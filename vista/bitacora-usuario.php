<!DOCTYPE html>
<html>

<head>
  <title>Bitacora de usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">


  <!-- Bostrap 5 -->
  <link rel="stylesheet" href="resources/css/bootstrap.min.css">
  <link rel="stylesheet" href="resources/css/style.css">
  <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">

  <!-- DATATABLES CSS -->
  <link rel="stylesheet" href="./resources/library/dataTables/css/jquery.dataTables.min.css">

  <!-- Jquery-->
  <script src="resources/js/jquery-3.6.0.min.js"></script>

  <!-- JS de DataTables -->
  <script src="./resources/library/dataTables/js/jquery.dataTables.min.js"></script>

  <!-- Js boostrap -->
  <script src="resources/js/bootstrap.min.js"></script>
  <!-- CHOICE 2 -->
  <link rel="stylesheet" href="resources/library/choice/public/assets/styles/choices.min.css">
  <script src="resources/library/choice/public/assets/scripts/choices.min.js"></script>
  <!-- Estilos de validacion-->
  <link rel="stylesheet" href="resources/css/listar-consolidacion.css">
  <!-- Sweet alert 2-->
  <script src="resources/js/sweetalert2.js"></script>
</head>

<body>

  <!-- Menu.php -->
  <?php
  require_once("resources/View_Components/Menu.php")
  ?>
  <!-- Menu.php -->
  <!-- sidebar.php -->
  <?php
  require_once "resources/View_Components/Sidebar.php";
  ?>
  <!-- sidebar.php -->
  <main style="height: 100vh" class="pt-3">
    <div class="container-fluid">
      <div class="row justify-content-center mt-3 bg-white">
        <div class="col-6">
          <img src="./resources/img/user.png" class="rounded mx-auto d-block" width="150" height="140">
          <h5 class="text-center"><em>¡Hola <?php echo $_SESSION['nombre'] ?>!</em></h5>
          <h2 class="text-center fw-bold">ESTA LA BITACORA DE USUARIOS</h2>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col">
          <div class="card">
            <div class="card-body">

              <table id="bitacora" role='table' class='table table-borderless table-hover w-100'>
                <thead>

                  <tr role='row'>
                    <th colspan='1' role='columnheader'>Usuario</th>
                    <th colspan='1' role='columnheader'>Fecha</th>
                    <th colspan='1' role='columnheader'>Hora Registro</th>
                    <th colspan='1' role='columnheader'>Accion realizada</th>
                  </tr>
                </thead>

                <tbody id="datosBitacora" role='rowgroup'>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>
<script src="./resources/js/bitacora-usuario.js"></script>
</html>