<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();

$busqueda = $_GET['busqueda'];
$matriz_participantes = $objeto->listar_participantes($busqueda);
?>
<?php if (!empty($matriz_participantes)) : ?>
  <!-- Modal eliminar usuario -->
  <div class="modal fade edit-modal" id="eliminar_usuario" tabindex="-1" aria-labelledby="eliminar_usuario" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title">Eliminar participante de Celula de discipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive mt-4">
            <table role='table' class='table table-centered'>
              <thead>
                <tr role='row'>
                  <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Codigo de celula</th>
                  <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Nombre participante</th>
                  <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Apellido participante</th>
                  <th colspan='1' role='columnheader' class=''>Codigo participante</th>
                  <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Telefono participante</th>
                  <th colspan='1' role='columnheader' title='Toggle SortBy' class='sortable' style='cursor: pointer;'>Acciones</th>
                </tr>
              </thead>
              <tbody role='rowgroup'>
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
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- Modal eliminar usuario -->
<?php endif ?>