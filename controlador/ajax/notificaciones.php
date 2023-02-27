<?php
require_once("../../vendor/autoload.php");
session_start();
use Csr\Modelo\Ecam;
use Csr\Modelo\Usuarios;

$objeto = new ecam();
$objeto2 = new Usuarios();

if (isset($_POST['not_estudiantes'])) {
    $notificaciones = $objeto->listar_notificacionSeccion();
    if (!empty($notificaciones)) {
        foreach ($notificaciones as $not) { ?>
          <li class="dropdown-item">
            <div class="alert alert-info my-0" role="alert">
              <i class="bi bi-chat-square-text-fill me-2"></i><?php echo $not['accion'] ?>
            </div>
          </li>
      <?php }
      }else{ ?>
        <li class="dropdown-item">No tienes notificaciones aun</li><?php
      } ?>
      <li>
        <a class="dropdown-item" href="?pagina=listar-notificaciones">Ver todas las notificaciones</a>
      </li><?php
}

if (isset($_POST['listarNot_estudiantes'])) {
  $notificaciones = $objeto->listar_notificacionSeccion2();
  if (!empty($notificaciones)) {
    foreach ($notificaciones as $not) { ?>
    <tr>
      <td>
        <div class="alert alert-primary my-0" role="alert">
          <i class="bi bi-circle-square me-2"></i><?php echo $not['accion'] ?>
        </div>
      </td>
    </tr>
  <?php }
  }else{ ?>
    <tr>
      <td>
        No tienes notificaciones actualmente
      </td>
    </tr><?php
  }
}

if (isset($_POST['not_profesores'])) {
    $notificaciones = $objeto->listar_notificacionProfesores();
    if (!empty($notificaciones)) {
        foreach ($notificaciones as $not) { ?>
          <li class="dropdown-item">
            <div class="alert alert-info my-0" role="alert">
              <i class="bi bi-chat-square-text-fill me-2"></i><?php echo $not['mensaje'] ?>
            </div>
          </li>
      <?php }
      }else{ ?>
        <li class="dropdown-item">No tienes notificaciones aun</li><?php
      }?>
      <li>
        <a class="dropdown-item" href="?pagina=listar-notificaciones">Ver todas las notificaciones</a>
      </li><?php
}
if (isset($_POST['listarNot_profesores'])) {
  $notificaciones = $objeto->listar_notificacionProfesores2();
  if (!empty($notificaciones)) {
      foreach ($notificaciones as $not) { ?>
      <tr>
        <td>
          <div class="alert alert-primary my-0" role="alert">
            <i class="bi bi-circle-square me-2"></i><?php echo $not['mensaje'] ?>
          </div>
        </td>
      </tr>
    <?php }
    }else{ ?>
      <tr>
        <td>
          No tienes notificaciones actualmente
        </td>
      </tr><?php
    }
}

if (isset($_POST['verFotoPerfil'])) {
  $foto = $objeto2->mi_perfil(); ?>
  <img class="img-fluid" src="<?php echo !empty($foto['ruta_imagen']) ? $foto['ruta_imagen'] : 'resources/img/nothingPhoto.png' ?>" alt="" width="50" height="10"><?php
}



?>