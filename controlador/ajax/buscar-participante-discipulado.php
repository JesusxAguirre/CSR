<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();

$busqueda = $_GET['busqueda'];
$matriz_discipulado = $objeto->listar_participantes($busqueda);
?>
<?php if (!empty($matriz_discipulado)) : ?>
  <?php foreach ($matriz_discipulado as $discipulado) : ?>
    <tr role='row'>
      <td hidden class="id" role='cell'><?php echo $discipulado['id'] ?></td>
      <td class="codigo" role='cell'><?php echo $discipulado['codigo_celula_discipulado'] ?></td>
      <td class="dia" role='cell'><?php echo  $discipulado['dia_reunion'] ?></td>
      <td class="hora" role='cell'><?php $hora = substr($discipulado['hora'], 0, -3);
                                    echo $hora; ?></td>
      <td class="lider" role='cell'><?php echo  $discipulado['cod_lider'] ?></td>
      <td style="display: none;" class="cedula_lider" role='cell'><?php echo $discipulado['ced_lider'] ?></td>
      <td class="anfitrion" role='cell'><?php echo  $discipulado['cod_anfitrion'] ?></td>
      <td style="display: none;" class="cedula_anfitrion" role='cell'><?php echo $discipulado['ced_anfitrion'] ?></td>
      <td class="asistente" role='cell'><?php echo  $discipulado['cod_asistente'] ?></td>
      <td style="display: none;" class="cedula_asistente" role='cell'><?php echo $discipulado['ced_asistente'] ?></td>
      <td class="" role="cell">
        <button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#eliminar" class="btn btn-outline-danger delete-btn"><i class="fs-5 bi bi-trash-fill"></i></button>
      </td>
    </tr>
  <?php endforeach; ?>
<?php endif ?>