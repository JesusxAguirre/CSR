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
  require_once "resources/View_Components/Menu.php";
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

              <div style="visibility: hidden;" class=""><span class="d-flex align-items-center">Buscar : <input id="caja_busqueda" placeholder="codigo, dia_reunion, etc" class="form-control w-auto ms-1" value=""></span></div>
              <div class="table-responsive mt-4">
                <div id="tabla_usuarios_wrapper" class="dataTables_wrapper dt-bootstrap4">

                  <div class="row">
                    <div class="col-sm-12">
                      <table role='table' class="table table-bordered table-striped dataTable dtr-inline" id="tabla_discipulos">
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

                  <input type="time" name="hora" id="horaInput" class="form-control" placeholder="">
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
            </div>
            <div class="mb-3">
              <div id="grupo__direccion" class="col-sm col-md-12">
                <div class="relative">
                  <label class="form-label fw-bold" for="formGridZip">Dirección de la celula</label>

                  <input name="direccion" id="direccionInput" type="text" placeholder="" class="form-control">
                </div>
                <p class="text-danger d-none">Este campo no puede quedar vacio</p>
              </div>
            </div>
            <div class="mb-3 row">
              <div id="grupo__codigoLider" class="col-sm col-md-4">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Codigo de lider de la celula</label>

                  <input name="codigoLider" class="form-control" list="lider" id="codigoLider" placeholder="Escribe para buscar...">
                  <datalist id="lider">
                    <?php
                    foreach ($matriz_lideres as $lider) :
                    ?>
                      <option data-value="<?php echo $lider['cedula']; ?>"> <?php echo $lider['codigo'] . " " . $lider['nombre'] . " " . $lider['apellido']; ?></option>
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

                  <input class="form-control" list="anfitrion" name="codigoAnfitrion" id="codigoAnfitrion" placeholder=" Escribe para buscar...">
                  <datalist id="anfitrion">
                    <?php
                    foreach ($matriz_usuarios as $usuario) :
                    ?>
                      <option data-value="<?php echo $usuario['cedula']; ?>"> <?php echo $usuario['codigo'] . " " . $usuario['nombre'] . " " . $usuario['apellido']; ?></option>
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

                  <input class="form-control" list="asistente" name="codigoAsistente" id="codigoAsistente" placeholder=" Escribe para buscar...">
                  <datalist id="asistente">
                    <?php
                    foreach ($matriz_usuarios as $usuario) :
                    ?>
                      <option data-value="<?php echo $usuario['cedula']; ?>"> <?php echo $usuario['codigo'] . " " . $usuario['nombre'] . " " . $usuario['apellido']; ?></option>
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
  <!-- Modal agregar_usuario -->
  <div class="modal fade edit-modal" id="agregar_usuario" tabindex="-1" aria-labelledby="Modalagregar_usuario" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Agregar Discipulo a Celula de discipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form" method="post" id="agregar_usuarios" >
            <div class="mb-3 row">
              <div id="grupo__participantes" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Agregar Discipulo a celula</label>


                  <select multiple name="participantes[]" id="participantes" class="form-control">
                    <?php
                    foreach ($matriz_usuarios as $usuario) :
                    ?>
                      <option value="<?php echo $usuario['cedula']; ?>"> <?php echo $usuario['codigo']; ?></option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
            </div>
            <input type="hidden" name="id" id="idInput2">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="agregar_participantes" class="btn btn-primary" form="agregar_usuarios">Guardar</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal eliminar usuario -->

  <div class="modal fade edit-modal" id="eliminar_usuario" tabindex="-1" aria-labelledby="eliminar_usuario" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Eliminar Discipulo de Celula de discipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive mt-4">
            <table role='table' class='table table-centered'>
              <thead>
                <tr role='row'>
                  <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Codigo de celula</th>
                  <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Nombre Discipulo</th>
                  <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Apellido Discipulo</th>
                  <th colspan='1' role='columnheader' class=''>Codigo Discipulo</th>
                  <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Telefono Discipulo</th>
                  <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Acciones</th>
                </tr>
              </thead>
              <tbody id="datos4" role='rowgroup'>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal eliminar usuario -->

  <!-- Modal Eliminar  Participante -->
  <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="Modaleliminar" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-light">
          <h5 class="modal-title" id="Modaleliminar">Estas seguro(a) que deseas eliminar este discipulo?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body fs-5">
          <p>Se eliminará el usuario <b id="deleteParticipanteName"></b> <b id="deleteParticipanteApellido"></b> permanetemente.</p>
          <form method="post" id="deleteForm">
            <input type="hidden" name="cedula_participante" class="cedula_participante">

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="deleteButton">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Editar nivel de  discipulo -->
  <div class="modal fade" id="editar_nivel" tabindex="-1" aria-labelledby="Modaleliminar" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title  fw-bold" id="Modaleliminar">Editar nivel de discipulo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body fs-5">
          <p style="color: black;">Estas cambiando el nivel de <b id="nivel_discipulo_nombre"></b> <b id="nivel_discipulo_apellido"></b> </p>
          <form id="EditarNivelForm" action="?pagina=listar-celula-discipulado" method="POST">
            <input type="hidden" name="cedula_discipulo" class="cedula_participante">
            <input type="hidden" name="codigo_discipulo" id="codigo_discipulo">
            <div id="grupo__nivel" class="col-sm ">
              <div class="relative">
                <label class="form-label fw-bold">Cambiar Nivel</label>

                <select name="nivel" id="nivel" class="form-select form-select" aria-label=".form-select-sm example">
                  <option value="">....</option>
                  <option value="N1">Cambiar discipulo a nivel 1</option>
                  <option value="N2">Cambiar discipulo a nivel 2</option>

                </select>
              </div>
              <p class="text-danger d-none">No puede dejar este campo vacio </p>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" name="EditarNivelForm" form="EditarNivelForm"">Guardar</button>

        </div>
      </div>
    </div>
  </div>
  <!-- Modal Editar nivel de discipulo -->

  <!-- Modal agregar_asistencia -->
  <div class=" modal fade edit-modal" id="agregar_asistencia" tabindex="-1" aria-labelledby="Modalagregar_asistencia" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                  <h5 class="modal-title">Agregar Asistencias</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="form" method="post" id="agregar_asistencias" action="?pagina=listar-celula-discipulado">
                    <div class="mb-3 row">
                      <div id="grupo__asistentes" class="col-sm ">
                        <div class="relative">
                          <label class="form-label fw-bold" for="">Agregar discipulos que si asistieron</label>

                          <div id="asistencias4"></div>

                          </select>
                        </div>
                        <p class="text-danger d-none">Este campo no puede estar vacio</p>
                      </div>
                    </div>
                    <div class="mt-4 mb-3 row">
                      <div id="grupo__fecha" class="col-sm ">
                        <div class="relative">
                          <label class="form-label fw-bold" for="">Agregar fecha de Reunion</label>

                          <input id="fecha" name="fecha" class="form-control" type="date" />
                        </div>
                        <p class="text-danger d-none">Este campo no puede estar vacio</p>
                      </div>
                    </div>


                    <input type="hidden" name="id" id="idInput3">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" name="agregar_asistencia" class="btn btn-primary" form="agregar_asistencias">Guardar</button>

                </div>
              </div>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/sl-1.6.2/datatables.min.js"></script>




        <script src="resources/js/listar-celula-discipulado.js"></script>
</body>