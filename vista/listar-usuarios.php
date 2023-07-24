<!DOCTYPE html>
<html>

<head>
  <title>Listar Usuarios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">


  <!-- Bostrap 5 -->
  <link rel="stylesheet" href="resources/css/bootstrap.min.css">
  <link rel="stylesheet" href="resources/css/style.css">
  <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">

  <!-- Jquery-->
  <script src="./resources/js/jquery-3.6.0.min.js"></script>

  <!-- Datatables JS -->
  <script src="./resources/library/dataTables/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="./resources/library/dataTables/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="./resources/library/dataTables/css/dataTables.bootstrap5.min.css">

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
        <div class="mt-2 col-lg-12 col-md-12 col-sm-12 m-auto">

          <div class="card">
            <div class="card-body">
              <!-- Datatables JS -->
              <div class="table-responsive">
                <table id="tableUsers" class="table table-hover">
                  <thead>
                    <tr>
                      <!-- <th>data</th>
                      <th>cedula</th> -->
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Sexo</th>
                      <!-- <th>Telefono</th> -->
                      <th>Fecha de nacimiento</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

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
                  <label class="form-label fw-bold d-flex">Primer Nombre</label>
                  <i class="input-icon fs-5"></i>
                  <input placeholder="Juan" id="nombreInput" name="nombre" type="text" class="form-control">
                </div>
                <p class="text-danger d-none">El nombre que ser de 3 a 20 dígitos y solo puede contener letras </p>
              </div>
              <div id="grupo__apellido" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold d-flex">Primer Apellido</label>
                  <i class="input-icon fs-5"></i>
                  <input placeholder="Jimenez" id="apellidoInput" name="apellido" type="text" class="form-control">
                </div>
                <p class="text-danger d-none">El apellido deben ser de 3 a 20 dígitos y solo puede contener letras </p>
              </div>
              <div id="grupo__cedula" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold d-flex">Cedula</label>    
                  <i class=" input-icon fs-5"></i>
                    <input placeholder=" 22222222" id="cedulaInput" name="cedula" class="form-control">
                </div>
                <input hidden name="cedula_antigua" id="cedulaInput2" type="text">
                <p id="mensaje_cedula" class="text-danger d-none">La cedula deben de ser de 7 a 8 dígitos y solo puede contener numeros </p>
              </div>
              <div id="grupo__edad" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold d-flex">Fecha de nacimiento</label>
                  <i class="input-icon fs-5"></i>
                  <input id="edadInput" name="edad" type="date" class="form-control">
                </div>
                <p class="text-danger d-none">Ingrese correctamente su fecha de nacimiento</p>
              </div>
            </div>
            <div class="mb-3 row">
              <div id="grupo__sexo" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold d-flex">Sexo</label>
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
                  <label class="form-label fw-bold d-flex">Estado civil</label>
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
                  <label class="form-label fw-bold d-flex">Nacionalidad</label>
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
                  <label class="form-label fw-bold d-flex">Estado en el que vive</label>
                  <i class="input-icon fs-5"></i>
                  <select id="estado" name="estado" class="form-select form-select" aria-label=".form-select-sm example">
                    <option id="estadoInput" value="">Escoge tu estado</option>
                    <option value="amazonas">Amazonas</option>
                    <option value="anzoategui">Anzoátegui</option>
                    <option value="apure">Apure</option>
                    <option value="aragua">Aragua</option>
                    <option value="barinas">Barinas</option>
                    <option value="bolivar">Bolívar</option>
                    <option value="carabobo">Carabobo</option>
                    <option value="cojedes">Cojedes</option>
                    <option value="delta_amacuro">Delta Amacuro</option>
                    <option value="css">Distrito Capital</option>
                    <option value="falcon">Falcón</option>
                    <option value="guarico">Guárico</option>
                    <option value="lara">Lara</option>
                    <option value="merida">Mérida</option>
                    <option value="miranda">Miranda</option>
                    <option value="monagas">Monagas</option>
                    <option value="nueva_esparta">Nueva Esparta</option>
                    <option value="portuguesa">Portuguesa</option>
                    <option value="sucre">Sucre</option>
                    <option value="tachira">Táchira</option>
                    <option value="trujillo">Trujillo</option>
                    <option value="vargas">Vargas</option>
                    <option value="yaracuy">Yaracuy</option>
                    <option value="zulia">Zulia</option>
                  </select>
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
              </div>
            </div>
            <div class="mb-3 row">
              <div id="grupo__telefono" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold d-flex">Telefono</label>
                  <i class="input-icon fs-5"></i>
                  <input id="telefonoInput" placeholder=" XXXXXXXX" name="telefono" class="form-control">
                </div>
                <p class="text-danger d-none">el formato de telefono debe ser 0412xxxxxxx (10 números) </p>
              </div>
              <div id="grupo__rol" class="col-sm col-md-3 ">
                <div class="relative">
                  <label class="form-label fw-bold d-flex">Rol</label>
                  <i class="input-icon fs-5"></i>
                  <select id="rol" name="rol" class="form-select form-select" aria-label=".form-select-sm example">
                    <option id="rolInput" value="">Escoge tu Rol</option>
                    <?php foreach ($matriz_roles as $rol) : ?>
                      <option value="<?php echo $rol["id"] ?>"><?php echo $rol["nombre"] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <p class="text-danger d-none">No puede dejar este campo vacio </p>
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


  <div class="modal fade" id="eliminar_usuario" tabindex="-1" aria-labelledby="Modaleliminar" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-light">
          <h5 class="modal-title" id="Modaleliminar">Estas seguro(a) que deseas eliminar este discipulo?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body fs-5">
          <p>Se eliminará el usuario <b id="delete_usuario_name"></b> <b id="delete_usuario_apellido"></b> permanetemente.</p>
          <form method="post" id="deleteForm">
            <input type="hidden" name="delete_usuario_cedula" class="delete_usuario_cedula">
            <input type="hidden" name="delete">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-danger" id="deleteButton">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Eliminar Participante -->



  <script type="text/javascript">
    actualizar = <?php echo ($actualizar) ? 'true' : 'false'; ?>;
    eliminar = <?php echo ($eliminar) ? 'true' : 'false'; ?>;
  </script>

  <script src="resources/js/listar-usuarios.js"></script>
</body>