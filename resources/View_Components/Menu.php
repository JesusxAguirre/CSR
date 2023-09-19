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
          <img class="avatar-img " src="resources/img/nothingPhoto.png" id="menu_img_perfil" width="42px" alt="avatar">
        </a>
        <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
          <!-- Profile info -->
          <li class="px-3 mb-3">
            <div class="d-flex align-items-center">
              <!-- Avatar -->
              <div class="avatar me-3">
                <img class="avatar-img  shadow" id="menu_img_perfil2" src="resources/img/nothingPhoto.png" width="42px" alt="avatar">
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
          <li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Help</a></li>
          <li><button id="logout" name="cerrar" type="submit" class="dropdown-item bg-danger-soft-hover" href="#"><i class="bi bi-power fa-fw me-2"></i>Cerrar sesion</button></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <!-- Dark mode options START -->
          <li>
            <div class="bg-light dark-mode-switch theme-icon-active d-flex align-items-center p-1 rounded mt-2">
              <button type="button" class="btn btn-sm mb-0" data-bs-theme-value="light">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sun fa-fw mode-switch" viewBox="0 0 16 16">
                  <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
                  <use href="#"></use>
                </svg> Light
              </button>
              <button type="button" class="btn btn-sm mb-0" data-bs-theme-value="dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars fa-fw mode-switch" viewBox="0 0 16 16">
                  <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"></path>
                  <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
                  <use href="#"></use>
                </svg> Dark
              </button>
              <button type="button" class="btn btn-sm mb-0 active" data-bs-theme-value="auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half fa-fw mode-switch" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
                  <use href="#"></use>
                </svg> Auto
              </button>
            </div>
          </li>
          <!-- Dark mode options END-->
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