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

  <!-- DATATABLES CSS -->
  <link rel="stylesheet" href="resources/library/dataTables/css/jquery.dataTables.min.css">

  <!-- JS de DataTables -->
  <script src="resources/library/dataTables/js/jquery.dataTables.min.js"></script>

  <link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/sl-1.6.2/datatables.min.css" rel="stylesheet" />

  <style>
    .btn-success {
      background-color: darkgrey;
    }

    .btn-success:hover {
      color: #fff;
      background-color: grey;
      border-color: #146c43;
    }
    .text-title {
        color: #747579;

    }
  </style>


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

              <div style="visibility: hidden;" class=""><span class="d-flex align-items-center">Buscar : <input id="caja_busqueda" placeholder="codigo, dia_reunion, etc" class="form-control w-auto ms-1" value=""></span></div>
              <div class="table-responsive mt-4">
                <div id="tabla_usuarios_wrapper" class="dataTables_wrapper dt-bootstrap4">

                  <div class="row">
                    <div class="col-sm-12">
                      <table role='table' class="table table-bordered table-striped dataTable dtr-inline" id="mi_tabla">
                        <thead>

                        </thead>

                        <tbody id="datos" role='rowgroup'>

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

  <!-- Modal ver -->
  
<!-- HTML del modal -->
<div class="modal" id="view" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="modalUsuarioLabel">Informacion de la CSR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                   

                    <!-- Information START -->
                    <div class="row">

                        <!-- Information item -->
                        <div class="col-md-6">
                            <ul class="list-group list-group-borderless">
                                <li class="list-group-item">
                                    <span class="text-title">Codigo de CSR:</span>
                                    <span id="codigo_ver" class="h6 mb-0 font-weight-bold text-capitalize"></span>
                                </li>

                                <li class="list-group-item">
                                    <span class="text-title">Dia de visita :</span>
                                    <span class="text-capitalize h6 mb-0 font-weight-bold" id="dia_ver"></span>
                                </li>



                                <li class="list-group-item">
                                    <span class="text-title">Hora:</span>
                                    <span id="hora_ver" class="h6 mb-0 font-weight-bold"></span>
                                </li>
                            </ul>
                        </div>

                        <!-- Information item -->
                        <div class="col-md-6">
                            <ul class="list-group list-group-borderless">
                                <li class="list-group-item">
                                    <span class="text-title">Codigo de lider de CSR </span>
                                    <span id="codigo_lider_ver" class="h6 mb-0 font-weight-bold"></span>
                                </li>

                                <li class="list-group-item">
                                    <span class="text-title">Nombre de anfitrion:</span>
                                    <span id="anfitrion_ver" class="h6 mb-0 font-weight-bold text-capitalize"></span>
                                </li>

                                <li class="list-group-item">
                                    <span class="text-title">Telefono de anfitrion:</span>
                                    <span id="telefono_ver" class="h6 mb-0 font-weight-bold"></span>
                                </li>
                            </ul>
                        </div>
                        <!-- Information item -->
                        <div class="col-md-6">
                            <ul class="list-group list-group-borderless">
                                <li class="list-group-item">
                                    <span class="text-title">Cantidad de personas en el hogar</span>
                                    <span id="hogar_Ver" class="h6 mb-0 font-weight-bold"></span>
                                </li>

                                <li class="list-group-item">
                                    <span class="text-title">Direccion:</span>
                                    <span id="direccion_ver" class="h6 mb-0 font-weight-bold text-capitalize"></span>
                                </li>

                             
                                
                            </ul>
                        </div>
                    </div>
                    <ul>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Modal editar -->
  <div class="modal fade edit-modal" id="editar" tabindex="-1" aria-labelledby="ModalEditar" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Editar CSR</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form" method="post" id="editForm" action="?pagina=listar-casa">
            <div class="mb-3">
              <div id="grupo__dia" class="">
                <div class="relative">
                  <label class="form-label fw-bold" for="descripcionInput">
                    Dia de reunion
                  </label>
                  <i class="input-icon fs-5"></i>
                  <input maxlength="7" type="text" name="dia" id="diaInput" class="form-control text-capitalize" placeholder="">
                </div>
                <p class="text-danger d-none">Escriba un dia de la semana, todo en minuscula </p>
              </div>
            </div>
            <div class="mb-3">
              <div id="grupo__hora" class="">
                <div class="relative">
                  <label class="form-label fw-bold" for="descripcionInput">
                    Hora
                  </label>
                  <i class="input-icon2 fs-5"></i>
                  <input type="time" name="hora" id="horaInput" class="form-control" placeholder="">
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
            </div>
            <div class="mb-3 row">
              <div id="grupo__lider" class="col-sm col-md-4">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Codigo de lider de la CSR</label>
                  <i class="input-icon fs-5"></i>
                  <input name="lider" class="form-control" list="codigoLider" id="lider" placeholder="Escribe para buscar...">
                  <datalist id="codigoLider">
                    <?php
                    foreach ($matriz_lideres as $lider) :
                    ?>
                      <option data-value="<?php echo $lider['cedula']; ?>"> <?php echo $lider['codigo']; ?></option>
                    <?php
                    endforeach;
                    ?>
                  </datalist>
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
              <div id="grupo__anfitrion" class="col-sm col-md-4">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Nombre de Anfitrion</label>
                  <i class="input-icon2 fs-5"></i>
                  <input class="form-control text-capitalize" name="anfitrion" id="anfitrion" placeholder="Luis Jimenez...">

                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
              <div id="grupo__telefono_anfitrion" class="col-sm col-md-4">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Telefono Anfitrion</label>
                  <i class="input-icon2 fs-5"></i>
                  <input maxlength="11" class="form-control" name="telefono_anfitrion" id="telefono_anfitrion" placeholder="...">

                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
            </div>
            <div class="mb-3 row">
              <div id="grupo__cantidad" class="col-sm col-md-4">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Cantidad de personas en hogar</label>
                  <i class="input-icon2 fs-5"></i>
                  <input maxlength="2" class="form-control" name="cantidad" id="cantidad" />
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
              <div id="grupo__direccion" class="col-sm col-md-4">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Direccion</label>
                  <i class="input-icon2 fs-5"></i>
                  <input maxlength="20" class="form-control text-capitalize" name="direccion" id="direccion" />
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
              <input type="hidden" name="id" id="idInput">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="update" class="btn btn-primary" form="editForm">Guardar</button>

        </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/sl-1.6.2/datatables.min.js"></script>




  <script src="resources/js/listar-casa.js"></script>

</body>