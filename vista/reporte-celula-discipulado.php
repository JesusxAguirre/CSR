<!DOCTYPE html>
<html>

<head>
  <title>Registrar Celula Discipulado</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">


  <!-- Bostrap 5 -->
  <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
  <link rel="stylesheet" href="./resources/css/style.css">
  <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">


  <!-- Js boostrap -->
  <script src="./resources/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./resources/css/consolidacion.css">


  <!-- JQUERY -->
  <script src="./resources/js/jquery-3.6.0.min.js"></script>

  <!-- CHOICE 2 -->
  <link rel="stylesheet" href="resources/library/choice/public/assets/styles/choices.min.css">
  <script src="resources/library/choice/public/assets/scripts/choices.min.js"></script>
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

            <h4 class="page-title">Reportar Celula discipulado</h4>

          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div class="container-fluid">
                <form id="formulario" method="POST" action="?pagina=registrar-celula-discipulado">
                  <div class="mb-3 row">
                  <div id="grupo__codigoDiscipulado" class="col-sm col-md-4">
                      <div class="relative">
                        <label class="form-label fw-bold" for="">Codigo de lider de la celula</label>
                        <i class="input-icon2 fs-5"></i>
                        <input name="codigoDiscipulado" class="form-control" list="lider" id="codigoDiscipulado" placeholder="Escribe para buscar...">
                        <datalist id="lider">
                          <?php
                          foreach ($matriz_lideres as $lider) :
                          ?>
                            <option data-ejemplo="<?php echo $lider['cedula']; ?>" value="<?php echo $lider['codigo']; ?>">
                          <?php
                          endforeach;
                          ?>
                        </datalist>
                      </div>
                      <p class="text-danger d-none">Este campo no puede estar vacio</p>
                    </div>
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
                        <i class="input-icon2  fs-5"></i>
                        <input name="hora" type="time" placeholder="1" id="formGridZip" class="form-control">
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

  <script src="resources/js/reporte-celula-discipulado.js"></script>
  <script>

  </script>
</body>