<!DOCTYPE html>
<html>

<head>
  <title>Envio de correo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">
  <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
  <link rel="stylesheet" href="./resources/css/consolidacion.css">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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

            <h4 class="page-title">Envio de correo</h4>

          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <div class="container-fluid">
                <form id="formulario" class="" method="POST" action="?pagina=envio-correo">
                  <div class="mb-3 row">
                    <div id="grupo__usuario" class="col-sm ">
                      <div class="relative">
                        <label class="form-label fw-bold" for="">Selecciona el usuario al cual quieres enviar un correo</label>
                        <i class="input-icon fs-5"></i>
                        <select name="usuario" id="usuario" class="form-control">
                          <option value="">Seleccione una opcion</option>
                          <?php foreach ($matriz_correo as $correo) : ?>
                            <option value="<?php echo $correo['usuario']; ?>"> <?php echo $correo['codigo']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <p class="text-danger d-none">Este campo no puede estar vacio</p>
                    </div>
                  </div>
                  <div class="mb-3 mt-3 row">
                    <div class="col-sm">
                      <label class="form-label fw-bold" ">Asunto</label>
                      <textarea name="html" class="form-control" id="exampleFormControlTextarea1" rows="3">

                        </textarea>
                    </div>
                  </div>
              </div>
              <div class="mb-3 mt-3 row">
                <div class="col-sm">
                  <label class="form-label fw-bold" ">Mensaje</label>
                          <div style=" height: auto;" id="mensaje">
                </div>
              </div>
            </div>

            <button name="enviar" type="submit" class="btn btn-primary">Enviar</button>

            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  </main>
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script>

  </script>
  <script src="resources/js/validacion-envio-correo.js"></script>
</body>
</html>