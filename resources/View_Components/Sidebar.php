<div class="offcanvas offcanvas-start sidebar bg-dark text-light " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">

  <div class="offcanvas-body p-0">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 ">
            HOME
          </div>
        </li>
        <?php if ($_SESSION['permisos']['dashboard']['listar'] > 0) : ?>
          <li>
            <a href="?pagina=dashboard" class="nav-link px-3 active fs-4">
              <span class="me-1 "><i class="bi bi-house-door-fill"></i></span>
              <span class="h5">Inicio</span>
            </a>
          </li>
        <?php  endif ;?>
        <li>
          <a href="?pagina=agenda" class="nav-link px-3 active fs-4">
            <span class="me-1 "><i class="bi bi-house-door-fill"></i></span>
            <span class="h5">Gestionar Agenda</span>
          </a>
        </li>
        <li class="my-4">
          <hr class="dropdown-divider" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3">
            Interfaces
          </div>
        </li>

        <?php if ($_SESSION['permisos']['casa_sobre_la_roca']['listar'] > 0 or $_SESSION['permisos']['casa_sobre_la_roca']['crear']> 0) : ?>
          <li>
            <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#roca" role="button" aria-expanded="false" aria-controls="collapseExample">
              <span class="me-2">
                <i class="bi bi-house-heart-fill fs-3"></i></span>
              <span>Gestionar Casa Sobre La Roca</span>
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
                <?php if ($_SESSION['permisos']['casa_sobre_la_roca']['listar'] > 0) : ?>
                <li>
                  <a href="?pagina=reporte-casa" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-clipboard2-plus-fill"></i></span>
                    <span>Reporte CSR</span>
                  </a>
                </li>
                <?php endif; ?>
              </ul>

            </div>
          </li>
        <?php endif; ?>

        <?php if (!$_SESSION['rol'] <= 2) { ?>
          <li>
            <a style="padding-left: 17.5px" class="nav-link sidebar-link pe-3" data-bs-toggle="collapse" href="#ecam" role="button" aria-expanded="false" aria-controls="collapseExample">
              <span class="me-2 fs-4">
                <i class="bi bi-building"></i></span>
              <span>Gestionar ECAM</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>

            </a>
            <div class="collapse" id="ecam">
              <div>
                <ul class="navbar-nav ps-3">
                  <?php if ($_SESSION['rol'] == 4) { ?>
                    <li>
                      <a href="?pagina=aula-virtual-Est" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-grid-3x3-gap-fill"></i>
                        </span>
                        <span>Aula Virtual Estudiantes</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if ($_SESSION['rol'] == 4) { ?>
                    <li id="boletinNotas">
                      <!-- Aqui se mostrata el boletin de notas cuando llegue la fecha de cierre de la seccion -->
                    </li>
                  <?php } ?>

                  <?php if ($_SESSION['status_profesor'] == 1) { ?>
                    <li>
                      <a href="?pagina=aula-virtual-Prof" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-grid-3x3-gap-fill"></i>
                        </span>
                        <span>Aula Virtual Profesores</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if ($_SESSION['rol'] <= 2) { ?>
                    <li>
                      <a href="?pagina=agregar-materias" class="nav-link px-3">
                        <span class="me-2">
                        <i class="bi bi-bookshelf"></i></span>
                        <span>Agregar Materias</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if ($_SESSION['rol'] <= 2) { ?>
                    <li>
                      <a href="?pagina=listar-materias" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-book-half"></i></span>
                        <span>Listar Materias ECAM</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if ($_SESSION['rol'] <= 2) { ?>
                    <li>
                      <a href="?pagina=agregar-profesores" class="nav-link px-3">
                        <span class="me-2">
                        <i class="bi bi-people-fill"></i></span>
                        <span>Profesores de la ECAM</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if ($_SESSION['rol'] <= 2) { ?>
                    <li>
                      <a href="?pagina=crear-secciones" class="nav-link px-3">
                        <span class="me-2">
                        <i class="bi bi-view-list"></i></span>
                        <span>Crear Secciones</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if ($_SESSION['rol'] <= 2) { ?>
                    <li>
                      <a href="?pagina=listar-secciones" class="nav-link px-3">
                        <span class="me-2">
                        <i class="bi bi-house text-info"></i></span>
                        <span>Listar Secciones</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if ($_SESSION['rol'] <= 2) { ?>
                    <li>
                      <a href="?pagina=listar-secciones-cerradas" class="nav-link px-3">
                        <span class="me-2">
                        <i class="bi bi-house text-danger"></i></span>
                        <span>Listar Secciones Cerradas</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if ($_SESSION['rol'] <= 2) { ?>
                    <li>
                      <a href="?pagina=control-notas" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-123"></i></span>
                        <span>Control de Notas</span>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </li>
        <?php } ?>




        <?php if ($_SESSION['rol'] != 4 && $_SESSION['rol'] != 3) { ?>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#discipulado" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="me-2">
              <i class="bi bi-cloud-check-fill fs-3"></i></span>
            <span>Gestionar Celula de Discipulado</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>

          </a>
          <div class="collapse" id="discipulado">
            <div>
              <ul class="navbar-nav ps-3">
                <?php if (isset($_SESSION['permisos']['celula_discipulado']['listar'])) {
                  if ($_SESSION['permisos']['celula_discipulado']['listar'] > 0) { ?>
                    <li>
                      <a href="?pagina=listar-celula-discipulado" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-clipboard-check"></i></span>
                        <span>Listar Celula de Discipulado</span>
                      </a>
                    </li>
                <?php }
                } ?>

                <?php if (isset($_SESSION['permisos']['celula_discipulado']['crear'])) {
                  if ($_SESSION['permisos']['celula_discipulado']['crear'] > 0) { ?>
                    <li>
                      <a href="?pagina=registrar-celula-discipulado" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-box-seam-fill"></i></span>
                        <span>Registrar Celula de Discipulado</span>
                      </a>
                    </li>
                <?php }
                } ?>

                <li>
                  <a href="?pagina=reporte-celula-discipulado" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-clipboard2-plus-fill"></i></span>
                    <span>Buscar Reporte Celula de Discipulado</span>
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
            <span>Gestionar Celula de Consolidacion</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>

          </a>
          <div class="collapse" id="consolidacion">
            <div>
              <ul class="navbar-nav ps-3">
                <?php if (isset($_SESSION['permisos']['celula_consolidacion']['listar'])) {
                  if ($_SESSION['permisos']['celula_consolidacion']['listar'] > 0) { ?>
                    <li>
                      <a href="?pagina=listar-celula-consolidacion" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-clipboard-check"></i></span>
                        <span>Listar Celula de Consolidacion</span>
                      </a>
                    </li>
                <?php }
                } ?>

                <?php if (isset($_SESSION['permisos']['celula_consolidacion']['crear'])) {
                  if ($_SESSION['permisos']['celula_consolidacion']['crear'] > 0) { ?>
                    <li>
                      <a href="?pagina=registrar-celula-consolidacion" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-box-seam-fill"></i></span>
                        <span>Registrar Celula de Consolidacion</span>
                      </a>
                    </li>
                <?php }
                } ?>

                <li>
                  <a href="?pagina=reporte-celula-consolidacion" class="nav-link px-3">
                    <span class="me-2">
                      <i class="bi bi-clipboard2-plus-fill"></i></span>
                    <span>Buscar Reporte Celula de Consolidacion</span>
                  </a>
                </li>

              </ul>
            </div>
          </div>
        </li>
        <?php } ?>

        <?php if (isset($_SESSION['permisos']['reporte_estadistico_celulas']['listar'])) {
          if ($_SESSION['permisos']['reporte_estadistico_celulas']['listar'] > 0) { ?>
            <li>
              <a class="nav-link px-3 sidebar-link" href="?pagina=reportes-estadisticos">
                <span class="me-2">
                  <i class="bi bi-clipboard-data-fill fs-3"></i></span>
                <span>Gestionar Reportes Estadisticos de Celulas </span>

              </a>
            </li>
        <?php }
        } ?>

        <?php if (isset($_SESSION['permisos']['reporte_estadistico_ecam']['listar'])) {
          if ($_SESSION['permisos']['reporte_estadistico_ecam']['listar'] > 0) { ?>
            <li>
              <a href="?pagina=reportes-ecam" class="nav-link px-3">
                <span class="me-2">
                  <i class="bi bi-bar-chart-line"></i></span>
                <span>Gestionar Reportes Estadisticos ECAM</span>
              </a>
            </li>
        <?php }
        } ?>

        <?php if (isset($_SESSION['permisos']['envio_correo']['listar'])) {
          if ($_SESSION['permisos']['envio_correo']['listar'] > 0) { ?>
            <li>
              <a class="nav-link px-3 sidebar-link" href="?pagina=envio-correo" role="button">
                <span class="me-2">
                  <i class="bi bi-envelope-fill fs-3"></i>
                  <span>Gestionar Envio de Correo</span>
              </a>
            </li>
        <?php }
        } ?>

        <?php if ($_SESSION['permisos']['seguridad']['listar'] > 0) { ?>
          <li>
            <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#seguridad" role="button" aria-expanded="false" aria-controls="collapseExample">
              <span class="me-2">
                <i class="bi bi-shield-lock-fill fs-3"></i></span>
              <span>Gestionar Seguridad</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>

            </a>

            <div class="collapse" id="seguridad">
              <div>
                <ul class="navbar-nav ps-3">
                  <?php if ($_SESSION['permisos']['bitacora_usuario']['listar'] > 0) { ?>
                    <li>
                      <a class="nav-link px-3 sidebar-link" href="?pagina=bitacora-usuario" role="button">
                        <span class="me-2">
                          <i class="bi bi-person-lines-fill fs-3"></i>
                          <span>Bitacora de usuario</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if ($_SESSION['permisos']['gestionar_roles']['listar'] > 0) { ?>
                    <li>
                      <a href="?pagina=listar-roles" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-clipboard-check"></i></span>
                        <span>Listar Roles</span>
                      </a>
                    </li>
                  <?php } ?>


                  <?php if ($_SESSION['permisos']['gestionar_usuario']['listar'] > 0) { ?>
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
                            <?php if ($_SESSION['permisos']['gestionar_usuario']['listar'] > 0) { ?>
                              <li>
                                <a href="?pagina=listar-usuarios" class="nav-link px-3">
                                  <span class="me-2">
                                    <i class="bi bi-clipboard-check"></i></span>
                                  <span>Listar Usuarios</span>
                                </a>
                              </li>
                            <?php } ?>

                          </ul>
                        </div>
                      </div>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </li>
        <?php } ?>


      </ul>
    </nav>
  </div>
</div>
<!-- Sidebar -->