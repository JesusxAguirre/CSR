<!DOCTYPE html>
<html>

<head>
  <title>Listar Ventas</title>
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
            <h4 class="page-title">Listar Ventas</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div  class="card">
            <div class="card-body">
              <h4 class="header-title mb-3 fw-bold">Ventas</h4>
            
              <div class=""><span class="d-flex align-items-center">Buscar : <input placeholder="Codigo, Nombre, Fecha" class="form-control w-auto ms-1" value=""></span></div>
              <div class="table-responsive mt-4">
                <table role="table" class="table table-centered table-dark ">
                  <thead class="">
                    <tr role="row">
                      <th colspan="1" role="columnheader" title="Toggle SortBy" class="sortable" style="cursor: pointer;">Codigo</th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" class="sortable" style="cursor: pointer;">Fecha de entrada</th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" class="sortable" style="cursor: pointer;">Nombre</th>
                      <th colspan="1" role="columnheader" class="">Categoria</th>
                      <th colspan="1" role="columnheader" title="Toggle SortBy" class="sortable" style="cursor: pointer;">Marca</th>
                      <th colspan="1" role="columnheader" class="">Costo base</th>
                      <th colspan="1" role="columnheader" class="">Precio de Venta Detal</th>
                      <th colspan="1" role="columnheader" class="">Precio de Venta al Mayor</th>
                      <th colspan="1" role="columnheader" class="">Existencias Actuales</th>
                    </tr>
                  </thead>
                  <tbody role="rowgroup">
                    <tr class="table-secondary" role="row">
                      <td role="cell">000002</td>
                      <td role="cell">7/18/2022</td>
                      <td role="cell">Bicicleta BMX modelo lancer</td>
                      <td role="cell">Bicicletas</td>
                      <td role="cell">GW</td>
                      <td role="cell">197$</td>
                      <td role="cell">´230$</td>
                      <td role="cell">230$</td>
                      <td role="cell">0</td>
                </tr>
                  </tbody>
                </table>
              </div>
              <div class="d-lg-flex align-items-center text-center pb-1">
               
                <ul class="pagination pagination-rounded d-inline-flex ms-auto align-item-center mb-0">
                  <li class="page-item paginate_button previous disabled"><a class="page-link" href=""><i class="bi-chevron-left"></i></a></li>
                  <li class="page-item d-none d-xl-inline-block active"><a class="page-link" href="">1</a></li>
                  <li class="page-item d-none d-xl-inline-block"><a class="page-link" href="">2</a></li>
                  <li class="page-item d-none d-xl-inline-block"><a class="page-link" href="">3</a></li>
                  <li class="page-item d-none d-xl-inline-block"><a class="page-link" href="">4</a></li>
                  <li class="page-item d-none d-xl-inline-block"><a class="page-link" href="">5</a></li>
                  <li class="page-item disabled d-none d-xl-inline-block"><a class="page-link" href="">...</a></li>
                  <li class="page-item d-none d-xl-inline-block"><a class="page-link" href="">12</a></li>
                  <li class="page-item paginate_button next"><a class="page-link" href=""><i class="bi bi-chevron-right"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
  </main>
  </div>
</body>