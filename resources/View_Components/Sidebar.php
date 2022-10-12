<div class="offcanvas offcanvas-start sidebar bg-dark text-light " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">

  <div class="offcanvas-body p-0">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 ">
            HOME
          </div>
        </li>
        <?php if (empty($_SESSION['id_seccion'])) { ?>
          <li>
          <a href="?pagina=dashboard" class="nav-link px-3 active fs-4">
            <span class="me-1 "><i class="bi bi-house-door-fill"></i></span>
            <span>Dashboard</span>
          </a>
        </li>
       <?php } ?>
        <li class="my-4">
          <hr class="dropdown-divider" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3">
            interfaces
          </div>
        </li>


        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#roca" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="me-2">
              <i class="bi bi-house-heart-fill fs-3"></i></span>
            <span>Casa sobre la roca</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>
          </a>
          <div class="collapse" id="roca">

            <ul class="navbar-nav ps-3">
              <?php if ($_SESSION['permisos']['casa_sobre_la_roca']['listar'] > 0) : ?>
                <li>
                  <a href="?pagina=listar-casa" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-clipboard-check"></i></span>
                    <span>Listar CSR</span>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($_SESSION['permisos']['casa_sobre_la_roca']['crear'] > 0) : ?>
                <li>
                  <a href="?pagina=registrar-casa" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-box-seam-fill"></i> </span>
                    <span>Registrar CSR</span>
                  </a>
                </li>
              <?php endif; ?>
              <li>
                <a href="?pagina=reporte-casa" class="nav-link px-3">
                  <span class="me-2">
                    <i class="bi bi-clipboard2-plus-fill"></i></span>
                  <span>Reporte CSR</span>
                </a>
              </li>
            </ul>

          </div>
        </li>


        <li>
          <a style="padding-left: 17.5px" class="nav-link sidebar-link pe-3" data-bs-toggle="collapse" href="#ecam" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="me-2 fs-4">
              <i class="bi bi-building"></i></span>
            <span>ECAM</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>

          </a>
          <div class="collapse" id="ecam">
            <div>
              <ul class="navbar-nav ps-3">
              <?php if($_SESSION['status_profesor'] == 0 && !empty($_SESSION['id_seccion'])) { ?>
                <li>
                  <a href="?pagina=aula-virtual-Est" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-grid-3x3-gap-fill"></i>
                  </span>
                  <span>Aula virtual</span>
                  </a>
                </li>
                <?php } ?>

                <?php if ($_SESSION['status_profesor'] == 1) { ?>
                  <li>
                    <a href="?pagina=aula-virtual-Prof" class="nav-link px-3">
                      <span class="me-2">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                      </span>
                      <span>Aula virtual</span>
                    </a>
                  </li>
                <?php } ?>
                <?php if (!empty($_SESSION['id_seccion'])) { ?>
                <li id="boletinNotas">
                  <!-- Aqui se mostrata el boletin de notas cuando llegue la fecha de cierre de la seccion -->
                </li>
                <?php } ?>

                <?php if ($_SESSION['status_profesor'] == 1) { ?>
                <li>
                  <a href="?pagina=materias" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-book-half"></i></span>
                    <span>Materias</span>
                  </a>
                </li>
                <?php } ?>

                <?php if ($_SESSION['status_profesor'] == 1) { ?>
                <li>
                  <a href="?pagina=crear-seccion" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-layout-wtf"></i></span>
                    <span>Crear seccion</span>
                  </a>
                </li>
                <?php } ?>
                
                <?php if ($_SESSION['status_profesor'] == 1) { ?>
                <li>
                  <a href="?pagina=control-notas" class="nav-link px-3">
                    <span class="me-2">
                    <i class="bi bi-123"></i></span>
                    <span>Control de notas</span>
                  </a>
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </li>

        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#user" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="me-2">
              <i class="bi bi-people-fill fs-3"></i></span>
            <span>Gestionar usuario</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>

          </a>
          <div class="collapse" id="user">
            <div>
              <ul class="navbar-nav ps-3">
                <?php if ($_SESSION['permisos']['gestionar_usuario']['listar'] > 0) : ?>
                  <li>
                    <a href="?pagina=listar-usuarios" class="nav-link px-3">
                      <span class="me-2">
                        <i class="bi bi-clipboard-check"></i></span>
                      <span>Listar Usuarios</span>
                    </a>
                  </li>
                <?php endif ?>
                <?php if ($_SESSION['permisos']['gestionar_roles']['listar'] > 0) : ?>
                  <li>
                    <a href="?pagina=listar-roles" class="nav-link px-3">
                      <span class="me-2">
                        <i class="bi bi-clipboard-check"></i></span>
                      <span>Listar Roles</span>
                    </a>
                  </li>
                <?php endif ?>
              </ul>
            </div>
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#discipulado" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="me-2">
              <i class="bi bi-cloud-check-fill fs-3"></i></span>
            <span>Gestionar celula discipulado</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>

          </a>
          <div class="collapse" id="discipulado">
            <div>
              <ul class="navbar-nav ps-3">
              <?php if ($_SESSION['permisos']['celula_discipulado']['listar'] > 0) : ?>
                <li>
                  <a href="?pagina=listar-celula-discipulado" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-clipboard-check"></i></span>
                    <span>Listar celula discipulado</span>
                  </a>
                </li>
                <?php endif; ?>
                <?php if ($_SESSION['permisos']['celula_discipulado']['crear'] > 0) : ?>
                <li>
                  <a href="?pagina=registrar-celula-discipulado" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-box-seam-fill"></i></span>
                    <span>Registrar celula discipulado</span>
                  </a>
                </li>
                <?php endif; ?>
                <li>
                  <a href="?pagina=reporte-celula-discipulado" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-clipboard2-plus-fill"></i></span>
                    <span>Reporte celula discipulado</span>
                  </a>
                </li>

              </ul>
            </div>
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#consolidacion" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="me-2">
              <i class="bi bi-patch-check-fill fs-3"></i></span>
            <span>Gestionar celula consolidacion</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>

          </a>
          <div class="collapse" id="consolidacion">
            <div>
              <ul class="navbar-nav ps-3">
                <?php if ($_SESSION['permisos']['celula_consolidacion']['listar'] > 0) : ?>
                  <li>
                    <a href="?pagina=listar-celula-consolidacion" class="nav-link px-3">
                      <span class="me-2">
                        <i class="bi bi-clipboard-check"></i></span>
                      <span>Listar celula consolidacion</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($_SESSION['permisos']['celula_consolidacion']['crear'] > 0) : ?>
                  <li>
                    <a href="?pagina=registrar-celula-consolidacion" class="nav-link px-3">
                      <span class="me-2">
                        <i class="bi bi-box-seam-fill"></i></span>
                      <span>Registrar celula consolidacion</span>
                    </a>
                  </li>
                <?php endif; ?>
                <li>
                  <a href="?pagina=reporte-celula-consolidacion" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-clipboard2-plus-fill"></i></span>
                    <span>Reporte celula consolidacion</span>
                  </a>
                </li>

              </ul>
            </div>
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" href="?pagina=reportes-estadisticos">
            <span class="me-2">
              <i class="bi bi-clipboard-data-fill fs-3"></i></span>
            <span>Reportes estadisticos de celulas </span>

          </a>
        </li>
        <li>
          <a href="?pagina=reportes-ecam" class="nav-link px-3">
            <span class="me-2">
            <i class="bi bi-bar-chart-line"></i></span>
            <span>Reportes estadisticos ECAM</span>
          </a>
        </li>

        <!-- PRUEBITA -->

        <li>
          <a class="nav-link px-3 sidebar-link" href="?pagina=envio-correo" role="button">
            <span class="me-2">
              <i class="bi bi-envelope-fill fs-3"></i>
              <span>Envio de correo</span>
          </a>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" href="?pagina=bitacora-usuario" role="button">
            <span class="me-2">
              <i class="bi bi-person-lines-fill fs-3"></i>
              <span>Bitacora de usuario</span>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</div>
<!-- Sidebar -->