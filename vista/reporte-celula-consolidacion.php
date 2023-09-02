<!DOCTYPE html>
<html>

<head>
  <title>Registrar Celula Discipulado</title>
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

            <h4 class="page-title">Reportar Celula Consolidacion</h4>

          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div id="formulario" class="container-fluid">

                <div class="mb-3 row">
                  <div id="grupo__codigo_consolidacion" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold" for="">Codigo de la celula</label>
                      <i class="input-icon2 fs-5"></i>
                      <select name="codigo_consolidacion" id="codigo_consolidacion" class="form-control">
                        <option value="">Seleccione una opcion</option>
                        <?php
                        foreach ($matriz_codigo as $consolidacion) :
                        ?>
                          <option value="<?php echo $consolidacion['id']; ?>"> <?php echo $consolidacion['codigo_celula_consolidacion']; ?></option>
                        <?php
                        endforeach;
                        ?>
                      </select>
                    </div>
                    <p class="text-danger d-none">Este campo no puede estar vacio</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div id="grupo__fecha_inicio" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold" for="">Coloque la fecha de inicio de la consulta</label>
                      
                      <input name="fecha_inicio" id="fecha_inicio" class="form-control" type="date" />
                    </div>
                    <p class="text-danger d-none">Este campo no puede estar vacio</p>
                  </div>
                  <div id="grupo__fecha_final" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold" for="">Coloque la fecha de fin de la consulta</label>
                      
                      <input name="fecha_final" id="fecha_final" class="form-control" type="date">
                    </div>
                    <p class="text-danger d-none">Este campo no puede estar vacio</p>
                  </div>
                </div>
                <div class="mb-3" id="formGridCheckbox">
                </div>
                <button id="consultar" name="consultar" type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div id="respuesta" class="container-fluid">

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>

  <script src="resources/js/reporte-celula-consolidacion.js"></script>
</body>
</html>