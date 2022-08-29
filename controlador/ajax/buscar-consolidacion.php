<?php
require_once('../../modelo/clase_celula_consolidacion.php');
$objeto = new Consolidacion;

$busqueda = $_GET['busqueda'];
$matriz_consolidacion = $objeto->listar_buscar_consolidacion($busqueda);
?>
<?php if (!empty($matriz_consolidacion)) : ?>
  <?php foreach ($matriz_consolidacion as $consolidacion) : ?>
    <tr role='row'>
      <td hidden class="id" role='cell'><?php echo $consolidacion['id'] ?></td>
      <td class="codigo" role='cell'><?php echo $consolidacion['codigo_celula_consolidacion'] ?></td>
      <td class="dia" role='cell'><?php echo  $consolidacion['dia_reunion'] ?></td>
      <td class="hora" role='cell'><?php $hora = substr($consolidacion['hora'], 0, -3);
                                    echo $hora; ?></td>
      <td class="lider" role='cell'><?php echo  $consolidacion['lider']['codigo'] ?></td>
      <td style="display: none;" class="cedula_lider" role='cell'><?php echo $consolidacion['lider']['cedula'] ?></td>
      <td class="anfitrion" role='cell'><?php echo  $consolidacion['anfitrion']['codigo'] ?></td>
      <td style="display: none;" class="cedula_anfitrion" role='cell'><?php echo $consolidacion['anfitrion']['cedula'] ?></td>
      <td class="asistente" role='cell'><?php echo  $consolidacion['asistente']['codigo'] ?></td>
      <td style="display: none;" class="cedula_asistente" role='cell'><?php echo $consolidacion['asistente']['cedula'] ?></td>
      <td class="" role="cell">
        <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#eliminar" class="btn btn-outline-danger delete-btn"><i class="fs-5 bi bi-trash-fill"></i></button>
      </td>
    </tr>
  <?php endforeach; ?>
<?php endif ?>