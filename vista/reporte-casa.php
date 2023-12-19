<!DOCTYPE html>
<html>

<head>
  <title>Reporte Casa Sobre La Roca</title>
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
  require_once "resources/View_Components/Menu.php";

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
            <h4 class="page-title">Reporte Casa Sobre La Roca</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="mt-2 col">
          <div class="card">
            <div class="card-body">
              <form action="?pagina=reporte-casa" id="formulario" method="POST" class="">
                <div class="mb-3 row">
                  <div id="grupo__CSR" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold" for="">Selecciona la CSR que deseas reportar</label>
                      <i class="input-icon fs-5"></i>
                      <select name="CSR" id="CSR" class="form-control">
                        <option value="">Seleccione una opcion</option>
                        <?php foreach ($matriz_csr as $csr): ?>
                          <option value="<?php echo $csr['id']; ?>">
                            <?php echo $csr['codigo']; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <p class="text-danger d-none">Este campo no puede estar vacio</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div id="grupo__hombres" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold" for="formGridEmail">Número de Hombres que asistieron</label>
                      <i class="input-icon fs-5"></i>
                      <input maxlength="2" placeholder="1" type="text" id="hombres" name="hombres" class="form-control">
                    </div>
                    <p class="text-danger d-none">Este campo solo acepta Números</p>
                  </div>
                  <div id="grupo__mujeres" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold">Número de Mujeres que asistieron</label>
                      <i class="input-icon fs-5"></i>
                      <input maxlength="2" placeholder="2" type="text" name="mujeres" id="mujeres" class="form-control">
                    </div>
                    <p class="text-danger d-none">Este campo solo acepta Números</p>
                  </div>
                  <div id="grupo__niños" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold">
                        Número de Niños que asistieron</label>
                      <i class="input-icon fs-5"></i>
                      <input maxlength="2" placeholder="1" type="text" id="niños" name="niños" class="form-control">
                    </div>
                    <p class="text-danger d-none">Este campo solo acepta Números</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div id="grupo__confesiones" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold">
                        Confensiones de fe en la ultima visita </label>
                      <i class="input-icon fs-5"></i>
                      <input maxlength="2" placeholder="1" type="text" id="confesiones" name="confesiones"
                        class="form-control">
                    </div>
                    <p class="text-danger d-none">Este campo solo acepta Números</p>
                  </div>
                </div>
                <div class="mb-3" id="formGridCheckbox">
                </div><button name="registrar" type="submit" class="btn btn-primary">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script type="text/javascript">
    error = <?php echo ($error) ? 'true' : 'false'; ?>
  </script>
  <script src="resources/js/validacion-reporte-csr.js"></script>
</body>

</html>