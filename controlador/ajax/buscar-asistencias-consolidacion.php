<?php
session_start();
require_once('../../modelo/clase_celula_consolidacion.php');

$objeto = new Consolidacion();

$id = $_GET['codigo_consolidacion'];
$fecha_inicio = $_GET['fecha_inicio'];
$fecha_final = $_GET['fecha_final'];


$matriz_asistencias = $objeto->listar_asistencias($id, $fecha_inicio, $fecha_final);
?>

<?php if (!empty($matriz_asistencias)) : ?>
  <div class="table-responsive mt-4">
    <table role='table' class='table table-centered'>
      <thead>
        <tr role='row'>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Nombre de participante</th>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>telefono</th>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>codigo</th>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Mes</th>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Total de asistencias</th>
        </tr>
      </thead>
      <tbody role='rowgroup'>
        <?php foreach ($matriz_asistencias as $asistencias) : ?>
          <tr role='row'>
            <td role='cell'><?php echo $asistencias['nombre'] ?></td>
            <td class="" role='cell'><?php echo $asistencias['telefono'] ?></td>
            <td class="" role='cell'><?php echo $asistencias['codigo'] ?></td>
            <td role='cell' >Septiembre</td>
            <td role='cell'><?php echo $asistencias['numero_asistencias'] ?></td>
          </tr>
        <?php endforeach;     ?>
      </tbody>
    </table>
  </div>
<?php endif ?>