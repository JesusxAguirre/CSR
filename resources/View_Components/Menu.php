<!-- NavBar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <!-- NavBar Scroll Butomm -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- NavBar Scroll Butomm -->
    <a class="navbar-brand fw-bold text-uppercase " href="#">
      <img src="./resources/img/casawhite.jpg" alt="" width="120" height="94" class="d-inline-block align-text-top rounded-circle">
    </a>
    <a class="navbar-brand fw-bold text-uppercase  fs-6-xs href=" #">
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
          <a href="?pagina=chat" id="verChat" class="fs-3 nav-link btn-dark text-light ms-2" role="button" aria-expanded="false">
            <i class="bi bi-chat-fill"></i>
          </a>
        </li>
      </ul>
      <!-- Fin del chat -->
      <!-- Notificaciones con WebSocket -->
      <ul class="navbar-nav">
        <input class="d-none" type="text">
        <li class="nav-item dropdown">
          <a id="verNotificaciones2" class="fs-3 nav-link btn-dark text-light  ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bell"></i>
          </a>
          <ul id="notificaciones2" class="dropdown-menu dropdown-menu-end notificacionesPrevista">
            <!-- DATOS PRUEBA CON WEBSOCKET-->
            <!-- <div class="alert alert-primary text-center" role="alert">
              <i>A simple primary alert—check it out!</i>
            </div> -->
          </ul>
        </li>
      </ul>
      <!-- Fin de notificaciones con WebSocket -->



      <!-- NOTIFICACIONES ORIGINALES -->
      <ul class="navbar-nav">
        <input id="status_profesorPOST" class="d-none" type="text" value="<?php echo $_SESSION['status_profesor'] ?>">
        <input id="id_seccionPOST" class="d-none" type="text" value="<?php echo $_SESSION['id_seccion'] ?>">
        <input class="d-none" type="text">
        <li class="nav-item dropdown">
          <a id="verNotificaciones" class="fs-3 nav-link btn-dark text-light  ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="text-light bi bi-bell-fill fs-3"></i>
          </a>
          <ul id="notificaciones" class="dropdown-menu dropdown-menu-end">
            <!-- DATOS PRUEBA -->
          </ul>
        </li>
      </ul>
      <!-- Fin notificaciones originales -->

      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="fs-3 nav-link btn-dark text-light  ms-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div id="fotoPerfil">
              <!-- AQUI VA LA FOTO DE PERFIL -->
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="?pagina=mi-perfil">Mi perfil</a></li>
            <form action="?pagina=dashboard" method="post">
              <li><button name="cerrar" type="submit" class="dropdown-item">Cerrar sesion</button></li>
            </form>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- NavBar -->
<script src="./resources/js/menu.js"></script>
<script src="./resources/js/webSocket_prueba.js"></script>