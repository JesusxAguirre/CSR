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
      <div class="card mb-2">
        <div class="mb-8 position-relative min-vh-25 mb-7 card-header">
          <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image: url(resources/img/paisaje.jpg);"></div>
          <div class="avatar avatar-5xl avatar-profile">
            <img class="d-inline-block align-text-top rounded-circle shadow-sm" width="120" height="124" src="<?php echo !empty($ruta_imagen) ? $ruta_imagen : 'resources/img/nothingPhoto.png' ?>" alt="">
          </div>

        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8">
              <h4 id="nombre_perfil" class="mb-1"></span></h4>
              <h5 id="codigo_perfil" class="fs-0 fw-normal"></h5>
              <h5 id="prueba"></h5>
              <div class="border-dashed border-bottom my-4 d-lg-none"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col my-2">
          <div class="card">
            <div class="card-body">
              <form class="form" method="post" id="formulario" action="?pagina=mi-perfil" enctype="multipart/form-data">
                <div class="mb-3 row">
                  <div id="grupo__nombre" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Primer Nombre</label>
                      <i class="input-icon fs-5"></i>
                      <input placeholder="Juan" value="" id="nombreInput" name="nombre" type="text" class="form-control">
                    </div>
                    <p class="text-danger d-none">El nombre que ser de 3 a 20 dígitos y solo puede contener letras </p>
                  </div>
                  <div id="grupo__apellido" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Primer Apellido</label>
                      <i class="input-icon fs-5"></i>
                      <input placeholder="Jimenez" id="apellidoInput" value="" name="apellido" type="text" class="form-control">
                    </div>
                    <p class="text-danger d-none">El apellido deben ser de 3 a 20 dígitos y solo puede contener letras </p>
                  </div>
                  <div id="grupo__cedula" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold" ">Cedula</label>    
                  <i class=" input-icon fs-5"></i>
                        <input placeholder="22222222" id="cedula" name="cedula" value="" class="form-control">
                    </div>
                    <input value="" hidden name="cedula_antigua" id="cedulaInput2" type="text">
                    <p id="mensaje_cedula" class="text-danger d-none">La cedula deben de ser de 7 a 8 dígitos y solo puede contener numeros </p>
                  </div>
                  <div id="grupo__edad" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Edad</label>
                      <i class="input-icon fs-5"></i>
                      <input placeholder="21" id="edadInput" value="" name="edad" type="date" class="form-control">
                    </div>
                    <p class="text-danger d-none">Ingrese una fecha de nacimiento valida. Recuerde que debe ser mayor de edad</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div id="grupo__sexo" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Sexo</label>
                      <i class="input-icon fs-5"></i>
                      <select name="sexo" id="sexo" class="form-select form-select" aria-label=".form-select-sm example">
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                      </select>
                    </div>
                    <p class="text-danger d-none">No puede dejar este campo vacio</p>
                  </div>
                  <div id="grupo__civil" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Estado civil</label>
                      <i class="input-icon fs-5"></i>
                      <select name="civil" id="civil" class="form-select form-select" aria-label=".form-select-sm example">
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
                        <option value="">Escoge tu estado</option>
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
                      <label class="form-label fw-bold">Telefono</label>
                      <i class="input-icon fs-5"></i>
                      <input maxlength="16" id="telefonoInput" value="" placeholder=" XXXXXXXX" name="telefono" class="form-control">
                    </div>
                    <p class="text-danger d-none">el formato de telefono debe ser 0412XXXXXX (10 números) </p>
                  </div>

                  <div id="grupo__correo" class="col-sm col-md-3 ">
                    <div class="relative">
                      <label class="form-label fw-bold">Correo</label>
                      <i class="input-icon fs-5"></i>
                      <input maxlength="60" id="correo" placeholder="example@gmail.com" value="" name="correo" class="form-control">
                    </div>
                    <p id="mensaje_correo" class="text-danger d-none">El formato de correo es ejemplo@gmail.com</p>
                  </div>
                </div>
                <div class="mb-3" id="">
                </div>
                <button name="actualizar" type="submit" class="btn btn-primary">Actualizar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- FORMULARIO 2 RECUPERAR CONTRASENA -->
      <div class="row">
        <div class="col my-2">
          <div class="card">
            <div class="card-body">
              <div class="mb-3">
                <h5>Actualizar contraseña</h5>
              </div>

              <form class="form" method="post" id="formulario3" action="?pagina=mi-perfil">
                <div class="row">
                  <div id="grupo__correo2" class="col-lg-4 col-md-6 col-sm-6">
                    <div>
                      <label for="correo2" class="form-label fw-bold">Correo</label>
                      <i class="input-icon fs-5"></i>
                      <input maxlength="60" disabled id="correo2" placeholder="example@gmail.com" value="" name="correo2" class="form-control mb-2">
                      <p id="mensaje_correo" class="text-danger d-none">El formato de correo es ejemplo@gmail.com </p>
                    </div>

                    <div>
                      <label class="form-label fw-bold">Ingrese su contraseña actual</label>
                      <i class="input-icon fs-5"></i>
                      <input maxlength="20" id="clave" value="" type="password" placeholder="******" name="clave" class="form-control mb-2">
                      <p id="error_password1" class="text-danger d-none">La contraseña debe contener de 6 a 16 digitos. Incluyendo minimo un caracter especial [!@#$%^&*] y un numero</p>
                    </div>
                    <!-- <input value="" hidden name="cedula_antigua" id="cedulaInput3" type="text"> -->
                  </div>

                  <div id="grupo__clave" class="col-lg-4 col-md-6 col-sm-6">
                    <div>
                      <label for="new_password1" class="form-label fw-bold">Ingrese su nueva contraseña</label>
                      <i class="input-icon fs-5"></i>
                      <input maxlength="20" id="new_password1" name="new_password1" value="" type="password" placeholder="******" class="form-control mb-2">
                      <p id="error_password2" class="text-danger d-none">La contraseña debe contener de 6 a 16 digitos. Incluyendo minimo un caracter especial [!@#$%^&*] y un numero</p>
                      <p id="error_claveIgual" class="text-danger d-none">La contraseña no puede ser igual a la actual</p>
                    </div>

                    <div>
                      <label for="new_password2" class="form-label fw-bold">Ingrese su contraseña nuevamente</label>
                      <i class="input-icon fs-5"></i>
                      <input maxlength="20" id="new_password2" name="new_password2" value="" type="password" placeholder="******" class="form-control mb-2">
                      <p id="error_password3" class="text-danger d-none">La contraseña que ha ingresado no coincide</p>
                    </div>
                  </div>
                </div>
                <button name="recuperar_password" type="submit" class="btn btn-primary mt-3">Actualizar</button>
              </form>

            </div>
          </div>
        </div>
      </div>


      <!-- FORMULARIO 3 CAMBIAR FOTO DE PERFIL -->
      <div class="row">
        <div class="col my-2">
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
                <input value="" hidden name="cedula_antigua" id="cedulaInput4" type="text">

                <button name="actualizar_imagen" type="submit" class="btn btn-primary">Actualizar</button>
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