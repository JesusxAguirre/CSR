<!DOCTYPE html>
<html>

<head>
  <title>Listar celula discipulado</title>
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
            <h4 class="page-title">Listar celula discipulado</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="header-title mb-3 fw-bold">Celula discipulado</h4>

              <div class=""><span class="d-flex align-items-center">Buscar : <input id="caja_busqueda" placeholder="codigo, estado_civil, nombre" class="form-control w-auto ms-1" value=""></span></div>
              <div class="table-responsive mt-4">

                <table role='table' class='table table-centered'>
                  <thead>

                    <tr role='row'>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Codigo de celula</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>dia de reunion</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>hora</th>
                      <th colspan='1' role='columnheader' class=''>codigo de lider</th>

                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>nombre anfitrion</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Cantidad de personas en el hogar</th>
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
                        <td class="anfitrion" role='cell'><?php echo  $csr['nombre_anfitrion'] ?></td>
                        <td class="asistente" role='cell'><?php echo  $csr['cantidad_personas_hogar'] ?></td>
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
  </div>
  <!-- Modal editar -->
  <div class="modal fade edit-modal" id="editar" tabindex="-1" aria-labelledby="ModalEditar" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Editar Celula de discipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form" method="post" id="editForm" action="?pagina=listar-celula-discipulado">
            <div class="mb-3">
              <div id="grupo__dia" class="">
                <div class="relative">
                  <label class="form-label fw-bold" for="descripcionInput">
                    Dia de reunion
                  </label>
                  <i class="input-icon fs-5"></i>
                  <input type="text" name="dia" id="diaInput" class="form-control" placeholder="">
                </div>
                <p class="text-danger d-none">Escriba un dia de la semana, con la primera letra Mayuscula Ej: Lunes </p>
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
              <div id="grupo__codigoLider" class="col-sm col-md-4">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Codigo de lider de la celula</label>
                  <i class="input-icon fs-5"></i>
                  <input name="codigoLider" class="form-control" list="lider" id="codigoLider" placeholder="Escribe para buscar...">
                  <datalist id="lider">
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
              <div id="grupo__codigoAnfitrion" class="col-sm col-md-4">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Codigo de Anfitrion</label>
                  <i class="input-icon2 fs-5"></i>
                  <input class="form-control" list="anfitrion" name="codigoAnfitrion" id="codigoAnfitrion" placeholder=" Escribe para buscar...">
                  <datalist id="anfitrion">
                    <?php
                    foreach ($matriz_usuarios as $usuario) :
                    ?>
                      <option data-value="<?php echo $usuario['cedula']; ?>"> <?php echo $usuario['codigo']; ?></option>
                    <?php
                    endforeach;
                    ?>
                  </datalist>
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
              <div id="grupo__codigoAsistente" class="col-sm col-md-4">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Codigo de Asistente</label>
                  <i class="input-icon2 fs-5"></i>
                  <input class="form-control" list="asistente" name="codigoAsistente" id="codigoAsistente" placeholder=" Escribe para buscar...">
                  <datalist id="asistente">
                    <?php
                    foreach ($matriz_usuarios as $usuario) :
                    ?>
                      <option data-value="<?php echo $usuario['cedula']; ?>"> <?php echo $usuario['codigo']; ?></option>
                    <?php
                    endforeach;
                    ?>
                  </datalist>
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
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
 

  <script type="text/javascript">
    actualizar = <?php echo ($actualizar) ? 'true' : 'false'; ?>;
  </script>
  <script src="resources/js/listar-celula-discipulado.js"></script>
</body>