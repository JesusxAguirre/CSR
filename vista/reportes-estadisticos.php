<!DOCTYPE html>
<html>

<head>
  <title>Reporte Casa Sobre La Roca</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.6">


  <!-- Bostrap 5 -->
  <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
  <link rel="stylesheet" href="./resources/css/style.css">
  <link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">


  <!-- Fontawesone css -->
  <link rel="stylesheet" href="./resources/library/fontawesome/css/all.css">
  <!-- Js boostrap -->
  <script src="./resources/js/bootstrap.min.js"></script>

  <!-- Js fontawesone -->
  <script src="./resources/library/fontawesone/js/all.js"></script>

  <!-- estilos del archivo-->
  <link rel="stylesheet" href="resources/css/reportes-estadisticos.css">
  <link rel="stylesheet" href="node_modules\highcharts\css\highcharts.css">


  <!-- CHOICE 2 -->
  <link rel="stylesheet" href="resources/library/choice/public/assets/styles/choices.min.css">
  <script src="resources/library/choice/public/assets/scripts/choices.min.js"></script>

  <!-- JQUERY -->
  <script src="./resources/js/jquery-3.6.0.min.js"></script>


  <!-- SWEETT ALERT-->
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
  <main style="height: 100vh;" class="pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">

            <h4 class="page-title">Reportes estadisticos</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
          
                <div class="row g-4">



                  <div class="card m-2 col-sm col-md-2 col-lg-4" style="width: 18rem;">
                    <div class="card-header bg-success text-white">
                      Reporte estadistico de cantidad de celulas de discipulado
                    </div>
                    <img class="card-img-top" src="resources/img/cantidad-de-celulas-de-d.png" alt="Card image cap">
                    <div class="card-body">
                      <p class="card-text">Aqui se puede generar un reporte de la cantidad de celulas de discipulado. presiona el boton de abajo.</p>
                      <a class="btn btn-primary" data-bs-toggle="modal" id="reporte" href="#discipulado-form" role="button">Generar reporte</a>
                    </div>
                  </div>


                  <div class="card m-2 col-sm col-md-2 col-lg-4" style="width: 18rem;">
                    <div class="card-header bg-success text-white">
                      Reporte estadistico de cantidad de discipulos
                    </div>
                    <img class="card-img-top" src="resources/img/cantidad-de-discipulos.png" alt="Card image cap">
                    <div class="card-body">
                      <p class="card-text">Aqui se puede generar un reporte de la cantidad de discipulos. presiona el boton de abajo.</p>
                      <a class="btn btn-primary" data-bs-toggle="modal" id="reporte" href="#discipulado-form2" role="button">Generar reporte</a>
                    </div>
                  </div>


                  <div class="card m-2 col-sm col-md-2 col-lg-4" style="width: 18rem;">
                    <div class="card-header bg-success text-white">
                      Reporte estadistico de cantidad de celulas de consolidacion
                    </div>
                    <img class="card-img-top" src="resources/img/cantidad-de-celulas-de-c.png" alt="Card image cap">
                    <div class="card-body">
                      <p class="card-text">Aqui se puede generar un reporte de la cantidad de celulas de consolidacion. presiona el boton de abajo.</p>
                      <a class="btn btn-primary" data-bs-toggle="modal" id="reporte" href="#consolidacion-form" role="button">Generar reporte</a>
                    </div>
                  </div>


                  <div class="card m-2 col-sm col-md-2 col-lg-4" style="width: 18rem;">
                    <div class="card-header bg-success text-white">
                      Reporte estadistico crecimiento de lider
                    </div>
                    <img class="card-img-top" src="resources/img/reporte-de-crecimiento-d.png" alt="Card image cap">
                    <div class="card-body">
                      <p class="card-text">Aqui se puede generar un reporte de el crecimiento de un lider. presiona el boton de abajo.</p>
                      <a class="btn btn-primary" data-bs-toggle="modal" id="reporte" href="#lider-form" role="button">Generar reporte</a>
                    </div>
                  </div>


                  <div class="card m-2 col-sm col-md-2 col-lg-4" style="width: 18rem;">
                    <div class="card-header bg-success text-white">
                      Reporte estadistico CSR
                    </div>
                    <img class="card-img-top" src="resources/img/reporte-de-csr.png" alt="Card image cap">
                    <div class="card-body">
                      <p class="card-text">Aqui se puede generar un reporte de las visitas de una casa sobre la roca. presiona el boton de abajo.</p>
                      <a class="btn btn-primary mt-3" data-bs-toggle="modal" id="reporte" href="#csr-form" role="button">Generar reporte </a>
                    </div>
                  </div>


                </div>





                <div id="respuesta"></div>
                <div id="respuesta2"></div>
                <div id="respuesta3"></div>
                <div id="respuesta4"></div>
                <div id="respuesta5"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>



  <!-- Modal para formulario de fechas de discipulados creados-->
  <div class="modal fade" id="discipulado-form" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico cantidad de celulas de discipulados creadas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="formulario" class="container-fluid">
            <div class="mb-3 row">
              <div id="grupo__fecha_inicio" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de inicio de la consulta</label>

                  <input name="fecha_inicio" id="fecha_inicio" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
              <div id="grupo__fecha_final" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de fin de la consulta</label>

                  <input name="fecha_final" id="fecha_final" class="form-control" type="month" />
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
  <!-- Modal para formulario de fechas de discipulados asignados a una celula-->
  <div class="modal fade" id="discipulado-form2" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico para cantidad de discipulos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="formulario2" class="container-fluid">
            <div class="mb-3 row">
              <div id="grupo__fecha_inicio2" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de inicio de la consulta</label>

                  <input name="fecha_inicio2" id="fecha_inicio2" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
              <div id="grupo__fecha_final2" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de fin de la consulta</label>

                  <input name="fecha_final2" id="fecha_final2" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
            </div>
            <div class="mb-3" id="formGridCheckbox">
            </div>
            <button id="consultar2" name="consultar2" type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal para formulario de fechas de celulas de consolidacion creados-->
  <div class="modal fade" id="consolidacion-form" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico cantidad de celulas de consolidacion creadas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="formulario3" class="container-fluid">
            <div class="mb-3 row">
              <div id="grupo__fecha_inicio3" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de inicio de la consulta</label>

                  <input name="fecha_inicio3" id="fecha_inicio3" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
              <div id="grupo__fecha_final3" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de fin de la consulta</label>

                  <input name="fecha_final3" id="fecha_final3" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
            </div>
            <div class="mb-3" id="formGridCheckbox">
            </div>
            <button id="consultar3" name="consultar3" type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal para formulario de fechas de celulas de consolidacion creados-->
  <div class="modal fade" id="lider-form" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico Crecimiento de lider</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="formulario4" class="container-fluid">
            <div class="mb-3 row">
              <div id="grupo__lider" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Seleccione un lider</label>
                  <i class="input-icon fs-5"></i>
                  <select name="lider[]" id="lider" class="form-control">
                    <option value="">Seleccione una opcion</option>
                    <?php foreach ($matriz_lideres as $lider) : ?>
                      <option value="<?php echo $lider['cedula']; ?>"> <?php echo $lider['codigo']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
            </div>
            <div class="mb-3 row">
              <div id="grupo__fecha_inicio4" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de inicio de la consulta</label>

                  <input name="fecha_inicio4" id="fecha_inicio4" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
              <div id="grupo__fecha_final4" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de fin de la consulta</label>

                  <input name="fecha_final4" id="fecha_final4" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
            </div>
            <div class="mb-3" id="formGridCheckbox">
            </div>
            <button id="consultar4" name="consultar4" type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal para formulario de fechas de CSR creados-->
  <div class="modal fade" id="csr-form" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico de asistencias de casa sobre la roca</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="formulario5" class="container-fluid">
            <div class="mb-3 row">
              <div id="grupo__CSR" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Seleccione una CSR</label>

                  <select name="CSR[]" id="CSR" class="form-control">
                    <option value="">Seleccione una opcion</option>
                    <?php foreach ($matriz_csr as $csr) : ?>
                      <option value="<?php echo $csr['id']; ?>"> <?php echo $csr['codigo']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
            </div>
            <div class="mb-3 row">
              <div id="grupo__fecha_inicio5" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de inicio de la consulta</label>

                  <input name="fecha_inicio5" id="fecha_inicio5" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
              <div id="grupo__fecha_final5" class="col-sm ">
                <div class="relative">
                  <label class="form-label fw-bold" for="">Coloque la fecha de fin de la consulta</label>

                  <input name="fecha_final5" id="fecha_final5" class="form-control" type="month" />
                </div>
                <p class="text-danger d-none">Este campo no puede estar vacio</p>
              </div>
            </div>
            <div class="mb-3" id="formGridCheckbox">
            </div>
            <button id="consultar5" name="consultar5" type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </div>
      </div>
    </div>
  </div>






  <!-- Modal de graficos-->
  <!-- Modal para formulario de fechas de-->
  <div class="modal fade" id="discipulado-grafico" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico cantidad de celulas de discipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="grafico"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal para formulario para consultar numero de discipulos por fecha-->
  <div class="modal fade" id="discipulado-grafico2" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico cantidad de discipulos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div id="grafico2"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal grafico de consolidacion -->
  <div class="modal fade" id="consolidacion-grafico" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico cantidad de celulas de consolidacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="grafico3"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal grafico de lider -->
  <div class="modal fade" id="lider-grafico" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico crecimiento de lider</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="grafico4"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal grafico de CSR -->
  <div class="modal fade" id="csr-grafico" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico casa sobre la roca</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="grafico5"></div>
        </div>
      </div>
    </div>
  </div>
  <script type="module" src="node_modules\highcharts\highcharts.js"></script>
  <script type="module" src="node_modules\highcharts\modules\export-data.js"></script>
  <script type="module" src="node_modules\highcharts\modules\exporting.js"></script>
  <script src="resources/js/reporte-estadisticos-celulas.js"></script>

</body>

</html>