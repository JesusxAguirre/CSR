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
  <!-- CHART JS -->
  <script src="resources/js/chart.min.js"></script>
  <!-- estilos del archivo-->
  <link rel="stylesheet" href="resources/css/reportes-estadisticos.css">

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
                <h4 class="header-title">Reporte estadistico </h4>
              </div>
              <div dir="ltr">
                <div class="mt-3 chartjs-chart" style="height: 70vh;">
                  <canvas id="myChart" role="img" height="400" width="941" style="display: block; box-sizing: border-box; height: 320px; width: 941px;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



  </main>
  <script>
    var ctx = document.getElementById('myChart').getContext('2d');

    var myChart = new Chart(ctx, {

      type: 'bar',

      data: {

        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],

        datasets: [{

          data: [12, 19, 3, 5, 2, 3],

          backgroundColor: [

            'rgba(255, 99, 132, 0.2)',

            'rgba(54, 162, 235, 0.2)',

            'rgba(255, 206, 86, 0.2)',

            'rgba(75, 192, 192, 0.2)',

            'rgba(153, 102, 255, 0.2)',

            'rgba(255, 159, 64, 0.2)'
          ],

          borderColor: [

            'rgba(255, 99, 132, 1)',

            'rgba(54, 162, 235, 1)',

            'rgba(255, 206, 86, 1)',

            'rgba(75, 192, 192, 1)',

            'rgba(153, 102, 255, 1)',

            'rgba(255, 159, 64, 1)'
          ],

          borderWidth: 1
        }]
      },
      options: {

        scales: {

          yAxes: [{

            ticks: {

              beginAtZero: true
            }

          }]
        }
      }
    });
  </script>
</body>