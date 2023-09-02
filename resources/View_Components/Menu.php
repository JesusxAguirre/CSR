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
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

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
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a style="background-color: #313a46;" class="fs-3 nav-link btn-dark text-light  ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div id="fotoPerfil">
              <!-- AQUI VA LA FOTO DE PERFIL -->
              <!-- <img class="img-fluid" src="resources/img/nothingPhoto.png" alt="" width="50" height="10"> -->
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="?pagina=mi-perfil">Mi perfil</a></li>
            <li><button id="logout" name="cerrar" type="submit" class="dropdown-item">Cerrar sesion</button></li>
          </ul>
        </li>
      </ul>
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