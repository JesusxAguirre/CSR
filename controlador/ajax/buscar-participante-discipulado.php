<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();

$busqueda = $_GET['busqueda'];
$matriz_participantes = $objeto->listar_participantes($busqueda);
?>
<?php if (!empty($matriz_participantes)) : ?>
  <!-- Modal eliminar usuario -->
  <?php foreach ($matriz_participantes as $participante) : ?>
    <tr role='row'>
      <td hidden class="id" role='cell'><?php echo $participante['id'] ?></td>
      <td class="codigo" role='cell'><?php echo $participante['codigo_celula'] ?></td>
      <td class="participantes_nombre" role='cell'><?php echo  $participante['participantes_nombre'] ?></td>
      <td class="participantes_apellido" role='cell'><?php echo $participante['participantes_apellido'] ?></td>
      <td class="participantes_codigo" role='cell'><?php echo  $participante['participantes_codigo'] ?></td>
      <td class="participantes_telefono" role='cell'><?php echo  $participante['participantes_telefono'] ?></td>
      <td class="participantes_cedula" role="cell">
        <button type="submit" data-bs-toggle="modal" data-bs-target="#eliminar" class="btn btn-outline-danger delete-btn" name="eliminar_participantes" value="<?php echo $participante['participantes_cedula'] ?>" class="btn btn-outline-danger delete-btn"><i class="fs-5 bi bi-trash-fill"></i></button>
      </td>
    </tr>
  <?php endforeach;       ?>
  <!-- Modal eliminar usuario -->
<?php endif ?>