<!DOCTYPE html>
<html>

<head>
  <title>Registrar Casa Sobre La Roca</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">
  <!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
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
            <h4 class="page-title">Registrar Casa Sobre La Roca</h4>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="mt-2 col">
          <div class="card">
            <div class="card-body">
              <form id="formulario" class="" method="POST" action="?pagina=registrar-casa">
                <div class="mb-3 row">
                  <div id="grupo__lider" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold" for="">Selecciona el lider que esta abriendo la casa sobre la roca</label>
                      
                      <select name="lider[]" id="lider" class="form-control">
                        <option value="">Seleccione una opcion</option>
                        <?php foreach ($matriz_lider as $lider) : ?>
                          <option value="<?php echo $lider['cedula']; ?>"> <?php echo $lider['codigo']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <p class="text-danger d-none">Este campo no puede estar vacio</p>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div id="grupo__direccion" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold" for="formGridEmail">Direccion</label>
                      <input id="direccion" maxlength="30" placeholder="Calle 19 con calle 40" type="text" name="direccion" class="form-control">
                    </div>
                    <p class="text-danger d-none">Este campo no puede estar vacio</p>
                  </div>
                  <div id="grupo__nombre" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold" for="formGridEmail">Nombre de Anfitrion</label>
                      <input id="nombreAnfitrion" maxlength="12" placeholder="Juan Jimenez" type="text" id="" name="nombre" class="form-control">
                    </div>
                    <p class="text-danger d-none">Este campo lleva minimo 3 letras</p>
                  </div>
                  <div id="grupo__telefono" class="col-sm ">
                    <div class="relative">
                      <label class="form-label fw-bold" for="formGridEmail">Telefono de Anfitrion</label>
                      <input id="telefonoAnfitrion" maxlength="11" placeholder="0414-XXXXXXXX" type="text" id="" name="telefono" class="form-control">
                    </div>
                    <p class="text-danger d-none">Escriba un numero de telefono valido</p>
                  </div>
                  <div class="mb-3 row mt-4">
                    <div id="grupo__dia" class="col-sm ">
                      <div class="relative">
                        <label class="form-label fw-bold" for="formGridEmail">Dia de visita</label>
                        <input id="diaVisita" maxlength="7" placeholder="Jueves" id="dia" name="dia" class="form-control">
                      </div>
                      <p class="text-danger d-none">Escriba un dia de la semana con la primera letra mayuscula</p>
                    </div>
                    <div id="grupo__hora" class="col-sm ">
                      <div class="relative">
                        <label class="form-label fw-bold">Hora pautada</label>
                        <input id="horaVisita" type="time" placeholder="8:30" id="197" name="hora" class="form-control">
                      </div>
                      <p class="text-danger d-none">Este campo no puede estar vacio</p>
                    </div>
                    <div id="grupo__integrantes" class="col-sm ">
                      <div class="relative">
                        <label class="form-label fw-bold" for="">Número de personas que integran el hogar</label>
                        <input id="nroPersonas" placeholder="1" name="integrantes" class="form-control">
                      </div>
                      <p class="text-danger d-none">Este campo no puede estar vacio</p>
                    </div>
                  </div>
                </div>
                <div class="mb-3" id="">
                </div>
                <button name="registrar" type="submit" class="btn btn-primary">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  
  <script src="resources/js/validacion-registro-csr.js"></script>
</body>
</html>