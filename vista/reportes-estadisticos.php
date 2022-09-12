<!DOCTYPE html>
<html>

<head>
  <title>Reporte Casa Sobre La Roca</title>
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

  <!-- estilos del archivo-->
  <link rel="stylesheet" href="resources/css/reportes-estadisticos.css">
  <link rel="stylesheet" href="node_modules\highcharts\css\highcharts.css">


  <!-- JQUERY -->
  <script src="./resources/js/jquery-3.6.0.min.js"></script>


  <!-- SWEETT ALERT-->
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
  <main style="height: 100vh;" class="pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">

            <h4 class="page-title">Reportes estadisticos</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between mb-2">
                <h4 class="header-title">Reporte celula de consolidacion creadas en 2022 </h4>
              </div>
              <a class="btn btn-primary" data-bs-toggle="modal" id="reporte" href="#discipulado-form" role="button">Reporte estadistico celula discipulado</a>

              <div id="respuesta"></div>

            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>
  <!-- Modal para formulario de fechas de-->
  <div class="modal fade" id="discipulado-form" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico discipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="formulario" class="container-fluid">
            <div class="mb-3 row">
              <div id="grupo__fecha_inicio" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de inicio de la consulta</label>
                  <i class="input-icon fs-5"></i>
                  <input name="fecha_inicio" id="fecha_inicio" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
              <div id="grupo__fecha_final" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de fin de la consulta</label>
                  <i class="input-icon fs-5"></i>
                  <input name="fecha_final" id="fecha_final" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
            </div>
            <div class="mb-3" id="formGridCheckbox">
            </div>
            <button id="consultar" name="consultar" type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para formulario de fechas de-->
  <div class="modal fade" id="discipulado-grafico" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico discipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="grafico2"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal para formulario para consultar numero de discipulos por fecha-->
  <div class="modal fade" id="discipulado-grafico" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico numero de discipuladodiscipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="grafico3"></div>
        </div>
      </div>
    </div>
  </div>
  <script type="module" src="node_modules\highcharts\modules\accessibility.js"></script>
  <script type="module" src="node_modules\highcharts\highcharts.js"></script>
  <script type="module" src="node_modules\highcharts\modules\export-data.js"></script>
  <script type="module" src="node_modules\highcharts\modules\exporting.js"></script>
  <script src="resources/js/reporte-estadisticos-discipulado.js"></script>


</body>