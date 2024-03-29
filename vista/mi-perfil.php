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
            <img class="d-inline-block align-text-top rounded-circle shadow-sm" width="120" height="124" src="<?php echo !empty($ruta_imagen) ? $ruta_imagen : 'resources/img/nothingPhoto.png' ?>" alt="">
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
              <form class="form" method="post" id="formulario" action="?pagina=mi-perfil" enctype="multipart/form-data">
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
                        <input placeholder="22222222" id="cedula" name="cedula" value="<?php echo $cedula ?>" class="form-control">
                    </div>
                    <input value="<?php echo $cedula ?>" hidden name="cedula_antigua" id="cedulaInput2" type="text">
                    <p id="mensaje_cedula" class="text-danger d-none">La cedula deben de ser de 7 a 8 dígitos y solo puede contener numeros </p>
                  </div>
                  <div id="grupo__edad" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Edad</label>
                      <i class="input-icon fs-5"></i>
                      <input placeholder="21" id="edadInput" value="<?php echo $edad ?>" name="edad" type="text" class="form-control">
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
                        <option id="sexoInput" value='<?php echo $sexo ?>'><?php echo $sexo ?></option>
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
                        <option id="estado_civilInput" value="<?php echo strtolower($estado_civil) ?>"><?php echo $estado_civil ?></option>
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
                        <option id="nacionalidadInput" value="<?php echo strtolower($nacionalidad) ?>"><?php echo $nacionalidad ?></option>
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
                        <option id="estadoInput" value="<?php echo strtolower($estado) ?>"><?php echo $estado ?></option>
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
                      <input id="telefonoInput" value="<?php echo $telefono  ?>" placeholder=" XXXXXXXX" name="telefono" class="form-control">
                    </div>
                    <p class="text-danger d-none">el formato de telefono debe ser 0412XXXXXX (10 números) </p>
                  </div>

                  <div id="grupo__correo" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Correo</label>
                      <i class="input-icon fs-5"></i>
                      <input id="correo" placeholder="example@gmail.com" value="<?php echo $correo; ?>" name="correo" class="form-control">
                    </div>
                    <p id="mensaje_correo" class="text-danger d-none">El formato de correo es ejemplo@gmail.com </p>
                  </div>
                </div>
                <div class="mb-3" id="">
                </div>
                <button name="actualizar" type="submit" class="btn btn-primary">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="mt-2 col">
          <div class="card">
            <div class="card-body">
              <form class="form" method="post" id="formulario3" action="?pagina=mi-perfil" >
               
              <div id="grupo__correo2" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Correo</label>
                      <i class="input-icon fs-5"></i>
                      <input disabled id="correo2" placeholder="example@gmail.com" value="<?php echo $correo; ?>" name="correo2" class="form-control">
                    </div>
                    <p id="mensaje_correo" class="text-danger d-none">El formato de correo es ejemplo@gmail.com </p>
                  </div>
                  <div id="grupo__clave" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Clave</label>
                      <i class="input-icon fs-5"></i>
                      <input id="clave" value="" type="password" placeholder="******" name="clave" class="form-control mb-4">
                    </div>
                    <p class="text-danger d-none">La clave debe contener de 7 a 12 digitos </p>
                </div>
                <input value="<?php echo $cedula ?>" hidden name="cedula_antigua" id="cedulaInput2" type="text">

                <button name="recuperar_password" type="submit" class="btn btn-primary">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="mt-2 col">
          <div class="card">
            <div class="card-body">
              <form class="form" method="post" id="formulario2" action="?pagina=mi-perfil" enctype="multipart/form-data">
                <div id="grupo__imagen" class="col-sm col-md-3 ">
                  <div class="relative">
                    <i class="input-icon fs-5"></i>
                    <label class="form-label fw-bold">Imagen de perfil</label>
                    <input class="form-control" type="file" name="imagen" id="imagen">
                  </div>
                  <p class="text-danger d-none">el formato de imagen es jpg, jgeg o png y no puede estar vacio </p>
                </div>
                <div class="mb-3" id="">
                </div>
                <input value="<?php echo $cedula ?>" hidden name="cedula_antigua" id="cedulaInput2" type="text">

                <button name="actualizar_imagen" type="submit" class="btn btn-primary">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script type="text/javascript">
    actualizar = <?php echo ($actualizar) ? 'true' : 'false'; ?>;
  </script>
  <script src="resources/js/mi-perfil.js"></script>
</body>