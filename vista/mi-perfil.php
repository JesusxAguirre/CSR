<!DOCTYPE html>
<html>

<head>
  <title>Mi perfil</title>
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
  <link rel="stylesheet" href="resources/css/mi-perfil.css">
  <!-- Sweet alert 2-->
  <script src="resources/js/sweetalert2.js"></script>
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
      <div class="mb-3 card">
        <div class="mb-8 position-relative min-vh-25 mb-7 card-header">
          <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image: url(resources/img/paisaje.jpg);"></div>
          <div class="avatar avatar-5xl avatar-profile">
            <img class="d-inline-block align-text-top rounded-circle shadow-sm" width="120" height="124" src="resources/img/mi-foto.jpg" alt="">
          </div>

        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8">
              <h4 class="mb-1"><?php echo $nombre . " " . $apellido ?></span></h4>
              <h5 class="fs-0 fw-normal"><?php echo $codigo ?></h5>
              <div class="border-dashed border-bottom my-4 d-lg-none"></div>
            </div>

          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="mt-2 col">
          <div class="card">
            <div class="card-body">
              <form class="form" method="post" id="editForm" action="?pagina=listar-usuarios">
                <div class="mb-3 row">
                  <div id="grupo__nombre" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Primer Nombre</label>
                      <i class="input-icon fs-5"></i>
                      <input placeholder="Juan" value="<?php echo $nombre ?>" id="nombreInput" name="nombre" type="text" class="form-control">
                    </div>
                    <p class="text-danger d-none">El nombre que ser de 3 a 20 dígitos y solo puede contener letras </p>
                  </div>
                  <div id="grupo__apellido" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Primer Apellido</label>
                      <i class="input-icon fs-5"></i>
                      <input placeholder="Jimenez" id="apellidoInput" value="<?php echo $apellido ?>" name="apellido" type="text" class="form-control">
                    </div>
                    <p class="text-danger d-none">El apellido deben ser de 3 a 20 dígitos y solo puede contener letras </p>
                  </div>
                  <div id="grupo__cedula" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold" ">Cedula</label>    
                  <i class=" input-icon fs-5"></i>
                        <input placeholder=" 22222222" id="cedulaInput" name="cedula" value="<?php echo $cedula ?>" class="form-control">
                    </div>
                    <input hidden name="cedula_antigua" id="cedulaInput2" type="text">
                    <p id="mensaje_cedula" class="text-danger d-none">La cedula deben de ser de 7 a 8 dígitos y solo puede contener numeros </p>
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
          </div>
        </div>
      </div>
    </div>
  </main>

</body>