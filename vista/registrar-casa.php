<!DOCTYPE html>
<html>

<head>
  <title>Registrar Casa Sobre La Roca</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">


  <!-- Bostrap 5 -->
  <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
  <link rel="stylesheet" href="./resources/css/style.css">
  <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">


  <!-- Fontawesone css -->
  <link rel="stylesheet" href="./resources/library/fontawesome/css/all.css">
  <!-- Js boostrap -->
  <script src="./resources/js/bootstrap.min.js"></script>

  <!-- Js fontawesone -->
  <script src="./resources/library/fontawesone/js/all.js"></script>

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
          <div class="page-title-box">

            <h4 class="page-title">Registrar Casa Sobre La Roca</h4>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="mt-2 col">
          <div class="card">
            <div class="card-body">
              <form class="" action="?pagina=registrar-casa">
                <div class="mb-3 row">
                  <div class="col"><label class="form-label fw-bold" for="formGridEmail">Codigo de lider</label>
                  <input placeholder="Calle 19 con calle 40" type="email" id="formGridEmail" class="form-control"></div>
                </div>
                <div class="mb-3 row">
                  <div class="col"><label class="form-label fw-bold" for="formGridEmail">Direccion</label><input placeholder="Calle 19 con calle 40" type="email" id="formGridEmail" class="form-control"></div>
                  <div class="col"><label class="form-label fw-bold" for="formGridPassword">Nombre de Anfitrion</label><input placeholder="Juan Jimenez" type="text" id="formGridPassword" class="form-control"></div>
                  <div class="col"><label class="form-label fw-bold" for="formGridPassword">Telefono de Anfitrion</label><input placeholder="0414-XXXXXXXX" type="text" id="formGridPassword" class="form-control"></div>
                </div>
                <div class="mb-3 row">
                  <div class="col"><label class="form-label fw-bold" for="formGridCity">Dia de visita</label><input placeholder="Jueves" id="dia" class="form-control"></div>
                  <div class="col"><label class="form-label fw-bold" for="formGridState">Hora pautada</label><input type="time" placeholder="8:30" id="197" class="form-control"></div>
                  <div class="col"><label class="form-label fw-bold" for="formGridZip">Número de personas que integran el hogar</label><input placeholder="1" id="formGridZip" class="form-control"></div>
                </div>
                <div class="mb-3 row">
                  <div class="col"><label class="form-label fw-bold" for="formGridCity">Fecha</label><input type="date" placeholder="Jueves" id="dia" class="form-control" disabled></div>
                  <div class="col"><label class="form-label fw-bold" for="formGridState">Codigo asignado</label><input   placeholder="" id="197" class="form-control" disabled></div>
                </div>
             
                <div class="mb-3" id="formGridCheckbox">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
  </main>
  </div>
</body>