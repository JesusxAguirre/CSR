<!-- INICIO DE HEADER -->
<?php require_once "./resources/View_Components/header.php" ?>
<!-- FIN DE HEADER -->

  <main style="height: 100vh" class="pt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">Listar inventario</h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div  class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="header-title mb-3 fw-bold">Inventario</h4>
            
              <div class=""><span class="d-flex align-items-center">Buscar : <input id="caja_busqueda"  onkeyup="realizaProceso($('#caja_busqueda').val());" placeholder="Codigo, Nombre, Fecha" class="form-control w-auto ms-1" value=""></span></div>
              <div id='datos' style="height: 388px; overflow-y: scroll;" class="table-responsive">
                

              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
  </main>
  </div>
  
</body>
</html>