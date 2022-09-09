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
              <div dir="ltr">
                <div class="mt-3 " id="grafico">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



  </main>

  <script type="module"  src="node_modules\highcharts\highcharts.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const chart = Highcharts.chart('grafico', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Fruit Consumption'
            },
            xAxis: {
                categories: ['Apples', 'Bananas', 'Oranges']
            },
            yAxis: {
                title: {
                    text: 'Fruit eaten'
                }
            },
            series: [{
                name: 'Jane',
                data: [1, 0, 4]
            }, {
                name: 'John',
                data: [5, 7, 3]
            }]
        });
    });
  </script>
</body>