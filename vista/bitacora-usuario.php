<!DOCTYPE html>
<html>

<head>
  <title>Listar CSR</title>
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
            <h4 class="page-title">Listar CSR</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="header-title mb-3 fw-bold">Casas sobre la roca</h4>

              <div class=""><span class="d-flex align-items-center">Buscar : <input id="caja_busqueda" placeholder="codigo, dia_reunion, etc" class="form-control w-auto ms-1" value=""></span></div>
              <div class="table-responsive mt-4">

                <table role='table' class='table table-centered'>
                  <thead>

                    <tr role='row'>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Codigo de celula</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Dia de reunion</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Hora</th>
                      <th colspan='1' role='columnheader' class='sortable' style='cursor: pointer;' class=''>Codigo de lider</th>

                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Nombre anfitrion</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Telefono anfitrion</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Cantidad de personas en el hogar</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Direccion</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Acciones</th>
                    </tr>
                  </thead>

                  <tbody id="datos" role='rowgroup'>
                    <?php foreach ($matriz_csr as $csr) : ?>
                      <tr role='row'>
                        <td hidden class="id" role='cell'><?php echo $csr['id'] ?></td>
                        <td class="codigo" role='cell'><?php echo $csr['codigo'] ?></td>
                        <td class="dia" role='cell'><?php echo  $csr['dia_visita'] ?></td>
                        <td class="hora" role='cell'><?php $hora = substr($csr['hora_pautada'], 0, -3);
                                                      echo $hora; ?></td>
                        <td class="lider" role='cell'><?php echo  $csr['codigo_lider'] ?></td>
                        <td class="nombre_anfitrion" role='cell'><?php echo  $csr['nombre_anfitrion'] ?></td>
                        <td class="telefono_anfitrion" role='cell'><?php echo  $csr['telefono_anfitrion'] ?></td>
                        <td class="cantidad" role='cell'><?php echo  $csr['cantidad_personas_hogar'] ?></td>
                        <td class="direccion" role='cell'><?php echo  $csr['direccion'] ?></td>
                        <td class="" role="cell">
                          <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
                        </td>
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