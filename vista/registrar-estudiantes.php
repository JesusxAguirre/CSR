<!DOCTYPE html>
<html lang="es">

<head>
  <title>Registrar estudiantes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">

  <!-- Bostrap 5 -->
  <link rel="stylesheet" href="resources/css/bootstrap.min.css">
  <link rel="stylesheet" href="resources/css/style.css">
  <link rel="stylesheet" href="resources/css/cursos.css">
  <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="resources/library/choice/public/assets/styles/choices.min.css">


  <!-- Js boostrap -->
  <script src="resources/js/bootstrap.min.js"></script>
  <script src="resources/js/cursos.js"></script>

  <!-- Jquery-->
  <script src="./resources/js/jquery-3.6.0.min.js"></script>

  <script src="resources/library/choice/public/assets/scripts/choices.min.js"></script>

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
  <form method="POST" action="?pagina=registrar-curso" class="">
    <main class="pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="page-title-box">
              <h4 class="page-title">Registrar Estudiantes</h4>
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="mt-2 col">
            <div class="card">
              <div class="card-body">
                <div class="mb-3 row">
                  <div class="col"><label class="form-label fw-bold" for="formGrid">Seccion</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Elige una seccion</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="mb-3 mt-3 row">
                  <div class="col">
                    <label class="form-label fw-bold" for="">Escoge los estudiantes</label>
                    <select name="estudiantes[]" class="form-select" id="estudiantes" placeholder="This is a placeholder" multiple>
                    </select>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      </div>


      </div>
      </div>
    </main>
  </form>
  <script>
    var PrimerElement = new Choices('#estudiantes', {
      allowSearch: false
    })
    var secondElement = new Choices('#profesores', {
      allowSearch: false
    })
  </script>

  </b ody>

</html>