<!-- Sidebar -->
<?php 
require_once('modelo/clase_usuario.php');

$objeto = new Usuarios();
//======= Permisos usuarios ====//
$permiso_usuarios_read = $objeto->get_permiso_usuarios_read();
$permiso_usuarios_create = $objeto->get_permiso_usuarios_create();
$permiso_usuarios_update = $objeto->get_permiso_usuarios_update();
$permiso_usuarios_delete = $objeto->get_permiso_usuarios_delete();
//======= Permisos casa sobre la roca ====//
$permiso_casa_read = $objeto->get_permiso_casa_read();
$permiso_casa_create = $objeto->get_permiso_casa_create();
$permiso_casa_update = $objeto->get_permiso_casa_update();
//======= Permisos ecam ====//
$permiso_ecam_read = $objeto->get_permiso_ecam_read();
$permiso_ecam_create = $objeto->get_permiso_ecam_create();


?>
<div class="offcanvas offcanvas-start sidebar bg-dark text-light " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">

  <div class="offcanvas-body p-0">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3 ">
            HOME
          </div>
        </li>
        <li>
          <a href="?pagina=dashboard" class="nav-link px-3 active fs-4">
            <span class="me-1 "><i class="bi bi-house-door-fill"></i></span>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="my-4">
          <hr class="dropdown-divider" />
        </li>
        <li>
          <div class="text-muted small fw-bold text-uppercase px-3">
            interfaces
          </div>
        </li>

        <?php if($permiso_casa_read > 0): ?>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#roca" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="me-2">
            <i class="bi bi-house-heart-fill fs-3"></i></span>
              <span >Casa sobre la roca</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>
          </a>
          <div class="collapse" id="roca">
            
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="?pagina=listar-casa-sobre-la-roca" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-clipboard-check"></i></span>
                  <span>Listar CSR</span>
                  </a>
                </li>             
                <?php if($permiso_casa_create > 0): ?>
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
    <?php endif; ?>
    <?php if($permiso_ecam_read > 0): ?>
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
                <li>
                  <a href="?pagina=aula-virtual" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-layout-wtf"></i></span>
                  <span>Aulas virtuales</span>
                  </a>
                </li>

                <li>
                  <a href="?pagina=materias" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-book-half"></i></span>
                  <span>Materias</span>
                  </a>
                </li>
             
                <li>
                  <a href="?pagina=crear-seccion" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-grid-3x3-gap-fill"></i> </span>
                  <span>Crear seccion</span>
                  </a>
                </li>
                <li>
                  <a href="?pagina=registrar-profesores" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-mortarboard-fill"></i></span>
                  <span>Secciones</span>
                  </a>
                </li>
                <li>
                  <a href="?pagina=registrar-estudiantes" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-file-person"></i> </span>
                  <span>Registrar Estudiantes</span>
                  </a>
                </li>
               
              </ul>
            </div>
          </div>
        </li>
        
        <?php endif; ?>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#user" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="me-2">
            <i class="bi bi-people-fill fs-3"></i></span>
              <span >Gestionar usuario</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>
           
          </a>
          <div class="collapse" id="user">
            <div>
              <ul class="navbar-nav ps-3">
              <?php if($permiso_usuarios_read > 0): ?>
                <li>
                  <a href="?pagina=listar-usuarios" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-clipboard-check"></i></span>
                  <span>Listar Usuarios</span>
                  </a>
                </li>
                <?php endif; ?> 
                <li>
                  <a href="?pagina=listar-roles" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-clipboard-check"></i></span>
                  <span>Listar Roles</span>
                  </a>
                </li>
               
              </ul>
            </div>
          </div>
        </li>
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#discipulado" role="button" aria-expanded="false" aria-controls="collapseExample">
            <span class="me-2">
            <i class="bi bi-cloud-check-fill fs-3"></i></span>
              <span >Gestionar celula discipulado</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>
           
          </a>
          <div class="collapse" id="discipulado">
            <div>
              <ul class="navbar-nav ps-3">             
                <li>
                  <a href="?pagina=listar-celula-discipulado" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-clipboard-check"></i></span>
                  <span>Listar celula discipulado</span>
                  </a>
                </li>            
                <li>
                  <a href="?pagina=registrar-celula-discipulado" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-box-seam-fill"></i></span>
                  <span>Registrar celula discipulado</span>
                  </a>
                </li>
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
              <span >Gestionar celula consolidacion</span>
              <span class="right-icon ms-auto">
                <i class="bi bi-chevron-down"></i>
              </span>
           
          </a>
          <div class="collapse" id="consolidacion">
            <div>
              <ul class="navbar-nav ps-3">             
                <li>
                  <a href="?pagina=listar-celula-consolidacion" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-clipboard-check"></i></span>
                  <span>Listar celula consolidacion</span>
                  </a>
                </li>            
                <li>
                  <a href="?pagina=registrar-celula-consolidacion" class="nav-link px-3">
                  <span class="me-2">
                  <i class="bi bi-box-seam-fill"></i></span>
                  <span>Registrar celula consolidacion</span>
                  </a>
                </li>
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

        <!-- PRUEBITA -->

        <li>
        <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="" role="button" aria-expanded="false" aria-controls="collapseExample">
        <span class="me-2">
        <i class="bi bi-envelope-fill fs-3"></i>
        <span>Envio de correo</span>
        </a>
        </li>

      </ul>
    </nav>
  </div>
</div>
<!-- Sidebar -->