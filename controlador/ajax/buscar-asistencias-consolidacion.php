<?php
require_once("../../vendor/autoload.php");

session_start();
use Csr\Modelo\Consolidacion;

$objeto = new Consolidacion;

$id = $_POST['codigo_consolidacion'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];


$matriz_asistencias = $objeto->listar_asistencias($id, $fecha_inicio, $fecha_final);
echo json_encode($matriz_asistencias);
print_r($matriz_asistencias);
?>

  <div class="table-responsive mt-4">
    <table role='table' class='table table-centered'>
      <thead>
        <tr role='row'>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>No</th>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Nombre de discipulo</th>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Telefono</th>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Codigo</th>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Total Asistencias</th>
          <th colspan='1' role='columnheader' class=' sortable' style='cursor: pointer;'>Total Reuniones</th>
        </tr>
      </thead>
      <tbody role='rowgroup'>
      <?php $cont = 1; foreach ($matriz_asistencias as $asistencias) : ?>
          <tr role='row'>
            <td role='cell'><?php echo $cont++ ?></td>
            <td role='cell'><?php echo $asistencias['nombre'].' '.$asistencias['apellido'] ?></td>
            <td class="" role='cell'><?php echo $asistencias['telefono'] ?></td>
            <td class="" role='cell'><?php echo $asistencias['codigo'] ?></td>
            <td role='cell' ><?php echo $asistencias['asistencias'] ?></td>
            <td role='cell'><?php echo $asistencias['total'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
