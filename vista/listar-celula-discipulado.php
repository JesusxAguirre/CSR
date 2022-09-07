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

              <div class=""><span class="d-flex align-items-center">Buscar : <input id="caja_busqueda" placeholder="codigo, estado_civil, nombre" class="form-control w-auto ms-1" value=""></span></div>
              <div class="table-responsive mt-4">

                <table role='table' class='table table-centered'>
                  <thead>

                    <tr role='row'>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Codigo de celula</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>dia de reunion</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>hora</th>
                      <th colspan='1' role='columnheader' class=''>codigo de lider</th>

                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>codigo anfitrion</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>codigo asistente</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Acciones</th>
                    </tr>
                  </thead>

                  <tbody id="datos" role='rowgroup'>
                    <?php foreach ($matriz_celula as $celula) : ?>
                      <tr role='row'>
                        <td hidden class="id" role='cell'><?php echo $celula['id'] ?></td>
                        <td class="codigo" role='cell'><?php echo $celula['codigo_celula_discipulado'] ?></td>
                        <td class="dia" role='cell'><?php echo  $celula['dia_reunion'] ?></td>
                        <td class="hora" role='cell'><?php $hora = substr($celula['hora'], 0, -3); echo $hora; ?></td>
                        <td class="lider" role='cell'><?php echo  $celula['codigo_lider'] ?></td>
                        <td class="anfitrion" role='cell'><?php echo  $celula['codigo_anfitrion'] ?></td>
                        <td class="asistente" role='cell'><?php echo  $celula['codigo_asistente'] ?></td>
                        <td class="" role="cell">
                          <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
                          <button type="button" data-bs-toggle="modal" data-bs-target="#agregar_usuario" class="btn btn-outline-primary agregar-btn"> <i class=" fs-5 bi bi-person-plus-fill"></i> </button>
                          <button type="button" data-bs-toggle="modal" data-bs-target="#agregar_asistencia" class="btn btn-outline-primary agregar-btn"> <i class=" fs-5 bi bi-calendar-date-fill"></i> </button>
                          <button type="button" data-bs-toggle="modal" data-bs-target="#eliminar_usuario" class="btn btn-outline-danger delete-btn"><i class="fs-5 bi bi bi-person-dash-fill"></i></button>
                          <button type="button" data-bs-toggle="modal" data-bs-target="#eliminar" class="btn btn-outline-danger delete-btn"><i class="fs-5 bi bi-trash-fill"></i></button>
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
                <p class="text-danger d-none">Escriba un dia de la semana, con la primera letra Mayuscula Ej: Lunes  </p>
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
  <!-- Modal agregar_usuario -->
  <div class="modal fade edit-modal" id="agregar_usuario" tabindex="-1" aria-labelledby="Modalagregar_usuario" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Agregar participante a Celula de discipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form" method="post" id="agregar_usuarios" action="?pagina=listar-celula-discipulado">
            <div class="mb-3 row">
              <div id="grupo__participantes" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Agregar participantes a celula</label>
                  <i class="input-icon fs-5"></i>
         
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

            <input hidden class="form-control" name="codigoAsistente" id="codigoAsistente2">
            <input hidden class="form-control" name="codigoAnfitrion" id="codigoAnfitrion2">
            <input hidden name="codigoLider" class="form-control" id="codigoLider2">

            <input type="hidden" name="id" id="idInput2">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="agregar" class="btn btn-primary" form="agregar_usuarios">Guardar</button>

        </div>
      </div>
    </div>
  </div>
  <!-- Modal eliminar usuario -->
  <div class="modal fade edit-modal" id="eliminar_usuario" tabindex="-1" aria-labelledby="eliminar_usuario" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Eliminar participante de Celula de discipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form" method="post" id="eliminar_usuarios" action="?pagina=listar-celula-discipulado">
            <div class="table-responsive mt-4">

              <table role='table' class='table table-centered'>
                <thead>

                  <tr role='row'>
                    <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Codigo de celula</th>
                    <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Nombre participante</th>
                    <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Apellido participante</th>
                    <th colspan='1' role='columnheader' class=''>Codigo participante</th>
                    <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Telefono participante</th>
                    <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Acciones</th>
                  </tr>
                </thead>

                <tbody id="datos" role='rowgroup'>
                  <?php foreach ($matriz_participantes as $participante) : ?>
                    <tr role='row'>
                      <td hidden class="id" role='cell'><?php echo $participante['id'] ?></td>
                      <td class="codigo" role='cell'><?php echo $participante['codigo_celula'] ?></td>
                      <td class="participantes_nombre" role='cell'><?php echo  $participante['participantes_nombre'] ?></td>
                      <td class="participantes_apellido" role='cell'><?php echo $participante['participantes_apellido'] ?></td>
                      <td class="participantes_codigo" role='cell'><?php echo  $participante['participantes_codigo'] ?></td>
                      <td class="participantes_telefono" role='cell'><?php echo  $participante['participantes_telefono'] ?></td>
                      <td class="" role="cell">
                        <button type="submit" name="eliminar_participante" value="<?php echo $participante['participantes_cedula'] ?>" class="btn btn-outline-danger delete-btn"><i class="fs-5 bi bi-trash-fill"></i></button>
                      </td>
                    </tr>
                  <?php endforeach;       ?>
                </tbody>
              </table>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>


<!-- Modal agregar_asistencia -->
<div class="modal fade edit-modal" id="agregar_asistencia" tabindex="-1" aria-labelledby="Modalagregar_asistencia" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Agregar Asistencias</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form" method="post" id="agregar_asistencias" action="?pagina=listar-celula-discipulado">
            <div class="mb-3 row">
              <div id="grupo__participantes" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Agregar participantes que si asistieron</label>
                  <i class="input-icon fs-5"></i>
         
                  <select multiple name="participantes[]" id="participantes" class="form-control">
                    <?php
                    foreach ($matriz_participantes as $participante) :
                    ?>
                      <option value="<?php echo $participante['participantes_cedula']; ?>"> <?php echo $participante['participantes_codigo']; ?></option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
            <div class="mt-4 mb-3 row">
              <div id="grupo__fecha" class="col-sm ">
                
                  <label class="form-label fw-bold" for="">Agregar fecha de Reunion</label>
                  <i class="input-icon fs-5"></i>
                  <input id="startDate" class="form-control" type="date" />                
              
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
            </div>

            <input hidden class="form-control" name="codigoAsistente" id="codigoAsistente2">
            <input hidden class="form-control" name="codigoAnfitrion" id="codigoAnfitrion2">
            <input hidden name="codigoLider" class="form-control" id="codigoLider2">

            <input type="hidden" name="id" id="idInput2">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="agregar" class="btn btn-primary" form="agregar_usuarios">Guardar</button>

        </div>
      </div>
    </div>
  </div>

  <script>
    $('#myModal').on('shown.bs.modal', function() {
      $('#myInput').trigger('focus')
    })
  </script>
  <script type="text/javascript" src="resources/js/listar-celula-discipulado.js"></script>
</body>