<!DOCTYPE html>
<html>

<head>
  <title>Listar Usuarios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">


  <!-- Bostrap 5 -->
  <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
  <link rel="stylesheet" href="./resources/css/style.css">
  <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">

  <!-- Jquery-->
  <script src="./resources/js/jquery-3.6.0.min.js"></script>

  <!-- Js boostrap -->
  <script src="./resources/js/bootstrap.min.js"></script>
 <!-- Estilos de validacion-->
 <link rel="stylesheet" href="resources/css/listar-usuario.css">
   <!-- Sweet alert 2-->
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
  <main style="height: 100vh" class="pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">Listar Usuarios</h4>
            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="header-title mb-3 fw-bold">Usuarios</h4>

              <div class=""><span class="d-flex align-items-center">Buscar : <input id="caja_busqueda" placeholder="codigo, estado_civil, nombre" class="form-control w-auto ms-1" value=""></span></div>
              <div  class="table-responsive mt-4">

                <table role='table' class='table table-centered'>
                  <thead>

                    <tr role='row'>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Codigo</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Nombre</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Apellido</th>
                      <th colspan='1' role='columnheader' class=''>Sexo</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Telefono</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Estado civil</th>
                      <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Acciones</th>

                    </tr>
                  </thead>

                  <tbody id="datos" role='rowgroup'>
                    <?php foreach ($matriz_usuario as $usuario) : ?>
                      <tr role='row'>
                        <td hidden class="cedula" role='cell'><?php echo $usuario['cedula'] ?></td>
                        <td hidden class="edad" role='cell'><?php echo $usuario['edad'] ?></td>
                        <td hidden class="nacionalidad" role='cell'><?php echo $usuario['nacionalidad'] ?></td>
                        <td hidden class="estado" role='cell'><?php echo $usuario['estado'] ?></td>
                        <td hidden class="telefono" role='cell'><?php echo $usuario['telefono'] ?></td>
                        <td role='cell'><?php echo $usuario['codigo'] ?></td>
                        <td class="nombre" role='cell'><?php echo  $usuario['nombre'] ?></td>
                        <td class="apellido" role='cell'><?php echo  $usuario['apellido'] ?></td>
                        <td class="sexo" role='cell'><?php echo  $usuario['sexo'] ?></td>
                        <td class="telefono" role='cell'><?php echo  $usuario['telefono'] ?></td>
                        <td class="estado_civil" role='cell'><?php echo  $usuario['estado_civil'] ?></td>
                        <td class="" role="cell">
                          <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
                          <button type="button" data-bs-toggle="modal" data-bs-target="#eliminar" class="btn btn-outline-danger delete-btn"><i class="fs-5 bi bi-trash-fill"></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Modal editar -->
  <div class="modal fade edit-modal" id="editar" tabindex="-1" aria-labelledby="ModalEditar" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Editar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="form" method="post" id="editForm" action="?pagina=listar-usuarios">
            <div class="mb-3 row">
              <div id="grupo__nombre" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold">Primer Nombre</label>
                  <i class="input-icon fs-5"></i>
                  <input placeholder="Juan" id="nombreInput" name="nombre" type="text" class="form-control">
                </div>
                <p class="text-danger d-none">El nombre que ser de 3 a 20 dígitos y solo puede contener letras </p>
              </div>
              <div id="grupo__apellido" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold">Primer Apellido</label>
                  <i class="input-icon fs-5"></i>
                  <input placeholder="Jimenez" id="apellidoInput" name="apellido" type="text" class="form-control">
                </div>
                <p class="text-danger d-none">El apellido deben ser de 3 a 20 dígitos y solo puede contener letras </p>
              </div>
              <div id="grupo__cedula" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold" ">Cedula</label>    
                  <i class=" input-icon fs-5"></i>
                    <input placeholder=" 22222222" id="cedulaInput" name="cedula" class="form-control">
                </div>
                <input hidden name="cedula_antigua" id="cedulaInput2" type="text">
                <p class="text-danger d-none">La cedula deben de ser de 7 a 8 dígitos y solo puede contener numeros </p>
              </div>
              <div id="grupo__edad" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold">Edad</label>
                  <i class="input-icon fs-5"></i>
                  <input placeholder="21" id="edadInput" name="edad" type="text" class="form-control">
                </div>
                <p class="text-danger d-none">La edad deben de ser de 1 a 2 dígitos y solo puede contener numeros </p>
              </div>
            </div>
            <div class="mb-3 row">
              <div id="grupo__sexo" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold">Sexo</label>
                  <i class="input-icon fs-5"></i>
                  <select name="sexo" id="sexo" class="form-select form-select" aria-label=".form-select-sm example">
                    <option id="sexoInput" value=''>Escoge</option>
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                  </select>
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
              <div id="grupo__civil" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold">Estado civil</label>
                  <i class="input-icon fs-5"></i>
                  <select name="civil" id="civil" class="form-select form-select" aria-label=".form-select-sm example">
                    <option id="estado_civilInput" value="">Escoge tu estado civil</option>
                    <option value="soltero">Soltero</option>
                    <option value="soltera">Soltera</option>
                    <option value="matrimonio">Casada/o</option>
                  </select>
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
              <div id="grupo__nacionalidad" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold">Nacionalidad</label>
                  <i class="input-icon fs-5"></i>
                  <select id="nacionalidad" name="nacionalidad" class="form-select form-select" aria-label=".form-select-sm example">
                    <option id="nacionalidadInput" value="">Escoge tu nacionalidad</option>
                    <option value="venezolana">Venezolana</option>
                    <option value="colombiana">Colombiana</option>
                    <option value="española">Española</option>
                  </select>
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
              <div id="grupo__estado" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold">Estado en el que vive</label>
                  <i class="input-icon fs-5"></i>
                  <select id="estado" name="estado" class="form-select form-select" aria-label=".form-select-sm example">
                    <option id="estadoInput" value="">Escoge tu estado</option>
                    <option value="css">Distritio Capital</option>
                    <option value="lara">Lara</option>
                    <option value="yaracuy">Yaracuy</option>
                  </select>
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
            </div>
            <div class="mb-3 row">
              <div id="grupo__telefono" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold">Telefono</label>
                  <i class="input-icon fs-5"></i>
                  <input id="telefonoInput" placeholder=" XXXXXXXX" name="telefono" class="form-control">
                </div>
                <p class="text-danger d-none">el formato de telefono debe ser 0412xxxxxxx (10 números) </p>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="update" class="btn btn-primary" form="editForm">Guardar</button>

        </div>
      </div>
    </div>
  </div>

  <script>
    $('#myModal').on('shown.bs.modal', function() {
      $('#myInput').trigger('focus')
    })
  </script>


  <script src="resources/js/listar-usuarios.js"></script>

</body>