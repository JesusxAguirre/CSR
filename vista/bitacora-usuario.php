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

  <!-- Jquery-->
  <script src="resources/js/jquery-3.6.0.min.js"></script>

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
  require_once ("resources/View_Components/Menu.php")
  ?>
  <!-- Menu.php -->
  <!-- sidebar.php -->
  <?php
  require_once "resources/View_Components/Sidebar.php";
  ?>
  <!-- sidebar.php -->
  <main style="height: 100vh" class="pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">Bitacora de usuario</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="header-title mb-3 fw-bold">Bitacora de usuario</h4>

              <div class=""><span class="d-flex align-items-center">Buscar : <input id="caja_busqueda" placeholder="codigo, dia_reunion, etc" class="form-control w-auto ms-1" value=""></span></div>
              <div class="table-responsive mt-4">

                <table role='table' class='table table-centered'>
                  <thead>

                    <tr role='row'>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Codigo usuario</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Fecha</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Hora Registro</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Accion realizada</th> 
                    </tr>
                  </thead>

                  <tbody id="datos" role='rowgroup'>
                    <?php foreach ($matriz_bitacora as $bitacora) : ?>
                      <tr role='row'>
                        <td class="cedula_usuario" role='cell'><?php echo $bitacora['codigo'] ?></td>
                        <td class="fecha" role='cell'><?php echo $bitacora['fecha_registro'] ?></td>
                        <td class="hora" role='cell'><?php echo $bitacora['hora_registro'] ?></td>
                        <td class="accion" role='cell'><?php echo  $bitacora['accion_realizada'] ?></td>                       
                      </tr>
                    <?php endforeach;       ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div> 
    </div>
  </main>

</body>