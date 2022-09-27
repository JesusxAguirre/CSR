<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();
session_start();
$busqueda = $_GET['busqueda'];
$matriz_discipulado = $objeto->buscar_discipulado($busqueda);
?>
<?php if (!empty($matriz_discipulado)) : ?>
  <?php foreach ($matriz_discipulado as $discipulado) : ?>
    <tr role='row'>
      <td hidden class="id" role='cell'><?php echo $discipulado['id'] ?></td>
      <td class="codigo" role='cell'><?php echo $discipulado['codigo_celula_discipulado'] ?></td>
      <td class="dia" role='cell'><?php echo  $discipulado['dia_reunion'] ?></td>
      <td class="hora" role='cell'><?php $hora = substr($discipulado['hora'], 0, -3); echo $hora; ?></td>
      <td class="lider" role='cell'><?php echo  $discipulado['cod_lider'] ?></td>
      <td class="anfitrion" role='cell'><?php echo  $discipulado['cod_anfitrion'] ?></td>
      <td class="asistente" role='cell'><?php echo  $discipulado['cod_asistente'] ?></td>
      <td class="" role="cell">
        <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#agregar_usuario" class="btn btn-outline-primary agregar-btn"> <i class=" fs-5 bi bi-person-plus-fill"></i> </button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#agregar_asistencia" class="btn btn-outline-primary asistencias-btn"> <i class=" fs-5 bi bi-calendar-date-fill"></i> </button>
        <button type="button" class="btn btn-outline-danger modal-btn "><i class="fs-5 bi bi bi-person-dash-fill"></i></button>
      </td>
    </tr>
  <?php endforeach; ?>
<?php endif ?>