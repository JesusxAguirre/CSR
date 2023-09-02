<!DOCTYPE html>
<html>

<head>
  <title>Registrar Celula Consolidacion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">
  <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
  <link rel="stylesheet" href="./resources/css/consolidacion.css">
	<!-- Espacio para los JS -->
	<?php require_once './resources/View_Components/importJS.php' ?>
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

            <h4 class="page-title">Registrar Celula consolidacion</h4>

          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div class="container-fluid">
                <form id="formulario" method="POST" action="?pagina=registrar-celula-consolidacion">
                  <div class="mb-3 row">
                    <div id="grupo__codigoLider" class="col-sm col-md-4">
                      <div class="relative">
                        <label class="form-label fw-bold" for="">Codigo de lider de la celula</label>
                        <i class="input-icon2 fs-5"></i>
                        <input name="codigoLider" class="form-control" list="lider" id="codigoLider" placeholder="Escribe para buscar...">
                        <datalist id="lider">
                          <?php
                          foreach ($matriz_lideres as $lider) :
                          ?>
                            <option data-value="<?php echo $lider['cedula']; ?>"> <?php echo $lider['codigo'] . " " . $lider['nombre'] . " " . 
                            $lider['apellido']; ?></option>
                          <?php
                          endforeach;
                          ?>
                        </datalist>
                      </div>
                      <p class="text-danger d-none">Seleccione un codigo , este campo no puede quedar vacio </p>
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
                            <option data-value="<?php echo $usuario['cedula']; ?>"> <?php echo $usuario['codigo'] . " " . $usuario['nombre'] . " " . $usuario ['apellido']; ?></option>
                          <?php
                          endforeach;
                          ?>
                        </datalist>
                      </div>
                      <p class="text-danger d-none">Seleccione un codigo , este campo no puede quedar vacio </p>
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
                            <option data-value="<?php echo $usuario['cedula']; ?>"> <?php echo $usuario['codigo'] . " " . $usuario['nombre'] . " " . $usuario ['apellido']; ?></option>
                          <?php
                          endforeach;
                          ?>
                        </datalist>
                      </div>
                      <p class="text-danger d-none">Seleccione un codigo , este campo no puede quedar vacio </p>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <div id="grupo__dia" class="col-sm col-md-6">
                      <div class="relative">
                        <label class="form-label fw-bold" for="formGridCity">Dia de reunion</label>
                        <i class="input-icon fs-5"></i>
                        <input name="dia" placeholder="Jueves" id="dia" class="form-control">
                      </div>
                      <p class="text-danger d-none">Este campo debe contener 5 digitos como minimo, no acepta espacios ni numeros</p>
                    </div>
                    <div id="grupo__hora" class="col-sm col-md-6">
                      <div class="relative">
                        <label class="form-label fw-bold" for="formGridZip">Hora</label>
                  
                        <input name="hora" type="time" placeholder="1" id="formGridZip" class="form-control">
                      </div>
                      <p class="text-danger d-none">Este campo no puede quedar vacio</p>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <div id="grupo__participantes" class="col-sm col-md-6">
                      <div class="relative">
                        <label class="form-label fw-bold" for="formGridCity">Personas que asisten a la celula</label>
                        <i class="input-icon fs-5"></i>
                        <select multiple name="participantes[]" id="participantes" class="form-control">
                          <?php
                          foreach ($matriz_usuarios as $usuario) :
                          ?>
                            <option value="<?php echo $usuario['codigo']; ?>"> <?php echo $usuario['codigo']; ?></option>
                          <?php
                          endforeach;
                          ?>
                        </select>
                      </div>
                      <p class="text-danger d-none">Este campos no puede estar vacio</p>
                    </div>
                    <div id="grupo__direccion" class="col-sm col-md-6">
                      <div class="relative">
                        <label class="form-label fw-bold" for="formGridZip">Dirección de la celula</label>
                        <i class="input-icon2  fs-5"></i>
                        <input name="direccion" type="text" placeholder="" id="" class="form-control">
                      </div>
                      <p class="text-danger d-none">Este campo no puede quedar vacio</p>
                    </div>
                  </div>

                  <div class="mb-3" id="formGridCheckbox">
                  </div><button id="registrar" name="registrar" type="submit" class="btn btn-primary">Enviar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
  <script type="text/javascript">
    error = <?php echo ($error) ? 'true' : 'false'; ?>
  </script>
  <script src="resources/js/validacion-registro-consolidacion.js"></script>
</body>
</html>