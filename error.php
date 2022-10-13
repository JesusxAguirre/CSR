<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error!</title>
    <!-- Bostrap 5 -->
    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-4">
            <img class="img-fluid" src="./resources/img/error.png" alt="">
            <h2 class="text-center fw-bold"><em>HA OCURRIDO UN PROBLEMA</em></h2>
            <h6 class="text-center">Has intentado acceder a una pagina no inicializada</h6>
            <div class="text-center">
                <button type="submit" class="btn btn-outline-secondary" onclick="redirigir()">PRESIONA AQUI PARA IR A LA PAGINA DE INICIO</button>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    function redirigir() {
        window.location= 'index.php'
    }
</script>