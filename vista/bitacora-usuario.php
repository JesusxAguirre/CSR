<!DOCTYPE html>
<html>

<head>
  <title>Bitacora de usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">
  <!-- Espacio para CSS -->
  <?php require_once './resources/View_Components/importCSS.php' ?>
  <!-- Espacio para los JS -->
  <?php require_once './resources/View_Components/importJS.php' ?>
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
      <div class="row justify-content-center bg-white">
        <div class="col-6">
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
                    <th colspan='1' role='columnheader'>Modulo</th>
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
<script src="resources/js/bitacora-usuario.js"></script>

</html>