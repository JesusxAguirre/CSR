<?php
require_once('../../modelo/clase_celula_consolidacion.php');
$objeto = new Consolidacion;

$busqueda = $_GET['busqueda'];
$matriz_consolidacion = $objeto->buscar_consolidacion($busqueda);
?>
<?php if (!empty($matriz_consolidacion)) : ?>
  <?php foreach ($matriz_consolidacion as $consolidacion) : ?>
    <tr role='row'>
      <td hidden class="id" role='cell'><?php echo $consolidacion['id'] ?></td>
      <td class="codigo" role='cell'><?php echo $consolidacion['codigo_celula_consolidacion'] ?></td>
      <td class="dia" role='cell'><?php echo  $consolidacion['dia_reunion'] ?></td>
      <td class="hora" role='cell'><?php $hora = substr($consolidacion['hora'], 0, -3);
                                    echo $hora; ?></td>
      <td class="lider" role='cell'><?php echo  $consolidacion['cod_lider'] ?></td>
      <td style="display: none;" class="cedula_lider" role='cell'><?php echo $consolidacion['ced_lider'] ?></td>
      <td class="anfitrion" role='cell'><?php echo  $consolidacion['cod_anfitrion'] ?></td>
      <td style="display: none;" class="cedula_anfitrion" role='cell'><?php echo $consolidacion['ced_anfitrion'] ?></td>
      <td class="asistente" role='cell'><?php echo  $consolidacion['cod_asistente'] ?></td>
      <td style="display: none;" class="cedula_asistente" role='cell'><?php echo $consolidacion['ced_asistente'] ?></td>
      <td class="" role="cell">
        <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#agregar_usuario" class="btn btn-outline-primary agregar-btn"> <i class=" fs-5 bi bi-person-plus-fill"></i> </button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#agregar_asistencia" class="btn btn-outline-primary asistencias-btn"> <i class=" fs-5 bi bi-calendar-date-fill"></i> </button>
        <button type="button" class="btn btn-outline-danger modal-btn"><i class="fs-5 bi bi bi-person-dash-fill"></i></button>
      </td>
    </tr>
  <?php endforeach; ?>
<?php endif ?>