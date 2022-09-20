<!DOCTYPE html>
<html>

<head>
  <title>Envio de correo</title>
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

  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

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
                        <select multiple name="usuario[]" id="usuario" class="form-control">
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
                          <div style=" height: auto;" id="asunto">
                    </div>
                  </div>
              </div>
              <div class="mb-3 mt-3 row">
                <div class="col-sm">
                  <label class="form-label fw-bold" ">Recuperando datos quill por consola</label>
                            <button type=" button" id="envio">Enviar</button>
                </div>
              </div>
              <input hidden id="asunto2" />
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
    //libreria quill

    var toolbarOptions = [
      [{
        'header': [1, 2, 3, 4, 5, 6, false]
      }],
      [{
        'font': []
      }],
      [{
        'color': []
      }, {
        'background': []
      }], // dropdown with defaults from theme

      [{
        'align': []
      }],
      ['bold', 'italic', 'underline', 'strike'], // toggled buttons
      [{
        'header': 1
      }, {
        'header': 2
      }], // custom button values
      [{
        'list': 'ordered'
      }, {
        'list': 'bullet'
      }],
      [{
        'indent': '-1'
      }, {
        'indent': '+1'
      }], // outdent/indent


      ['clean'] // remove formatting button
    ];
    var options = {
      debug: 'info',
      modules: {
        toolbar: toolbarOptions
      },
      placeholder: 'Escribe el asusnto del correo',
      theme: 'snow'
    };
    var quill = new Quill('#asunto', options);
  </script>
  <script src="resources/js/validacion-envio-correo.js"></script>

</body>