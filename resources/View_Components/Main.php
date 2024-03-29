<main class="pt-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="page-title-box">

          <h4 class="page-title">Dashboard</h4>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-5 col-lg-6">
        <div class="row">
          <div class="col-sm-6">
            <div class="card widget-flat mt-4">
              <div class="card-body">
                <div class="float-end">
                  <i class="widget-icon bi bi-bookmark-heart-fill"></i>
                </div>
                <h5 class="fw-normal mt-0 text-muted">CSR Abiertas</h5>
                <h3 class="mt-3 mb-3"><?php echo $casas_abiertas['casas_abiertas']; ?></h3>

              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="card widget-flat mt-4">
              <div class="card-body">
                <div class="float-end">
                  <i class="widget-icon bi bi-bookmark-heart-fill"></i>
                </div>
                <h5 class="fw-normal mt-0 text-muted">Numero de discipulos</h5>
                <h3 class="mt-3 mb-3"><?php echo $cantidad_discipulos['cantidad_discipulos'] ?></h3>
                <!--    <p class="mb-0 text-muted">
                  <span class="text-success me-2">
                   
                  <span class="text-nowrap">Mas que el ultimo mes</span>
                </p> -->
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-sm-6">
            <div class="card widget-flat mt-4">
              <div class="card-body">
                <div class="float-end">
                  <i class="widget-icon bi bi-bookmark-heart-fill"></i>
                </div>
                <h5 class="fw-normal mt-0 text-muted">Lideres casa sobre la roca</h5>
                <h3 class="mt-3 mb-3"><?php echo $lideres_con_CSR['cantidad_lideres']; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card widget-flat mt-4">
              <div class="card-body">
                <div class="float-end">
                  <i class="widget-icon bi bi-bookmark-heart-fill"></i>
                </div>
                <h5 class="fw-normal mt-0 text-muted">Estudiantes en ECAM</h5>
                <h3 class="mt-3 mb-3"><?php echo $cantidad_estudiantes ?></h3>
                
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-xl-7 col-lg-6">
        <div class="card-h-100 card mt-4">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <h4 class="header-title">Grafico anual casa sobre la roca</h4>
            </div>
            <div id="grafico"></div>
          </div>
        </div>
      </div>
    </div>
    <row class="row mt-2">
      <div class="col-xl-5 col-lg-6">
        <div class="card">
          <div class="card-body">
            <h4 class="header-title">Lideres sin casa sobre la roca </h4>
            <div style="height: 388px; overflow-y: scroll;" class="table-responsive ">
              <table class="mb-0 table table-hover ">
                <tbody>
                  <?php foreach ($matriz_lideres as $lider) : ?>
                    <tr>
                      <td>
                        <h5 class="font-14 my-1 fw-normal"><?php echo $lider['nombre'] . ' ' . $lider['apellido']; ?></h5>
                      </td>
                    </tr>
                  <?php endforeach; ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-7 col-lg-6">
        <div class="card">
          <div class="card-body">
            <h4 class="header-title mt-2 mb-3">
              Lider del mes
            </h4>
            <div class="table-responsive">
              <table class="mb-0 table table-hover">
                <tbody>
                <?php foreach ($lider_mes as $lider) : ?>
                  <tr>
                    <td>
                      <h5 class="font-14 my-1 fw-normal"><?php echo $lider['nombre'] . ' ' . $lider['apellido'] ?></h5>
                    </td>
                    <td>
                      <h5 class="font-14 my-1 fw-normal text-verde"><?php echo $lider['casas_visitadas'] ?></h5>
                      <span class="text-muted font-13">Casas visitadas</span>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</main>