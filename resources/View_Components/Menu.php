<!-- NavBar -->
<nav style="background-color: #313a46;" class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container-fluid">
    <!-- NavBar Scroll Butomm -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- NavBar Scroll Butomm -->
    <a class="navbar-brand fw-bold text-uppercase " href="#">
      <img src="./resources/img/casawhite.jpg" alt="" width="120" height="94" class="d-inline-block align-text-top rounded-circle">
    </a>
    <a class="navbar-brand fw-bold text-uppercase  fs-xs-2" href="#">
      CASA SOBRE LA ROCA
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon "></span>

    </button>
    <div class="collapse navbar-collapse  justify-content-end" id="navbarSupportedContent">

      <form class="d-flex ms-auto ">

      </form>

      <!-- Chat -->
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a style="background-color: #313a46;" href="?pagina=chat" id="verChat" class="fs-3 nav-link btn-dark text-light ms-2" role="button" aria-expanded="false">
            <i class="bi bi-chat-fill"></i>
          </a>
        </li>
      </ul>
      <!-- Fin del chat -->
      <!-- Notificaciones con WebSocket -->
      <!-- <ul class="navbar-nav">
        <input class="d-none" type="text">
        <li class="nav-item dropdown">
          <a id="verNotificaciones2" class="fs-3 nav-link btn-dark text-light  ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bell"></i>
          </a>
          <ul id="notificaciones2" class="dropdown-menu dropdown-menu-end notificacionesPrevista">
          </ul>
        </li>
      </ul> -->
      <!-- Fin de notificaciones con WebSocket -->


      <ul class="navbar-nav">
        <input hidden id="status_profesorPOST" class="d-none" type="text" value="<?php echo $_SESSION['status_profesor'] ?>">
        <input hidden id="id_seccionPOST" class="d-none" type="text" value="<?php echo $_SESSION['id_seccion'] ?>">
        <input class="d-none" type="text">
        <li class="nav-item dropdown">
          <a style="background-color: #313a46;" id="verNotificaciones" class="fs-3 nav-link btn-dark text-light  ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="text-light bi bi-bell-fill fs-3"></i>
          </a>
          <ul id="notificaciones" class="dropdown-menu dropdown-menu-end">
            <!-- DATOS PRUEBA -->
          </ul>
        </li>
      </ul>

    
   
      <div class="dropdown ms-1 ms-lg-0">
        <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="avatar-img " src="resources/img/nothingPhoto.png" id="menu_img_perfil" width="42" alt="avatar">
        </a>
        <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
          <!-- Profile info -->
          <li class="px-3 mb-3">
            <div class="d-flex align-items-center">
              <!-- Avatar -->
              <div class="avatar me-3">
                <img class="avatar-img  shadow" id="menu_img_perfil2" src="resources/img/nothingPhoto.png" width="42" alt="avatar">
              </div>
              <div>
                <p class="small m-0" id='menu_nombre'></p>
                <p class="small m-0" id='menu_email'></p>
              </div>
            </div>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <!-- Links -->
          <li><a class="dropdown-item" href="?pagina=mi-perfil"><i class="bi bi-gear fa-fw me-2"></i>Mi perfil</a></li>
          <li><button id="logout" name="cerrar" type="submit" class="dropdown-item bg-danger-soft-hover" href="#"><i class="bi bi-power fa-fw me-2"></i>Cerrar sesion</button></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          
        </ul>
      </div>
    </div>
  </div>
</nav>

<!-- NavBar -->

<script src="resources/js/menu.js"></script>
<?php if (strpos($_SERVER["REQUEST_URI"], '?pagina=chat')) {
?> <script src="resources/js/webSocket_chat.js"></script> <?php
                                                        } else { ?>
  <script src="resources/js/webSocket_header.js"></script> <?php
                                                          }  ?>