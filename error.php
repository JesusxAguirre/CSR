!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ERROR</title>
  <link rel="stylesheet" href="resources/css/bootstrap.min.css">
  <script src="resoources/js/bootstrap.min.js"></script>
  <style>
    .fondo {
      background-image: url("resources/img/error1.jpg");
      background-repeat: no-repeat;
      height: 100vh;

    }
  </style>
</head>

<body class="fondo">

  <main>
    <section class="pt-5">
      <div class="container">
        <div class="row">
          <div style="background: #000000b5;padding:2vw" class="col-12 text-center text-white ">
            <!-- Image -->
            <img src="resources/img/error404-01.svg" class="h-200px h-md-400px mb-4" alt="">
            <!-- Title -->
            <h1 class="display-1 text-danger mb-0">404</h1>
            <!-- Subtitle -->
            <h2>ha ocurrido un error comuniquese con el equipo de desarrollo</h2>
            <button type="submit" class="btn btn-secondary" onclick="redirigir()">PRESIONA AQUI PARA IR A LA PAGINA DE INICIO</button>
            <br><br>
            <!-- info -->
           <!--  <p class="mb-4">Si el problema persiste comuniquese con el equipo de mantenimiento.</p> -->
            <!-- spinner -->
            <div class="spinner-border text-warning" role="status">
              <span class="sr-only"></span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script>
    function redirigir() {
        window.location= 'index.php'
    }
</script>
</body>

</html>