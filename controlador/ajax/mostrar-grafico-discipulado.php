<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();

$fecha_inicio = $_GET['fecha_inicio'];
$fecha_final = $_GET['fecha_final'];

$datos = $objeto->listar_asistencias_meses($fecha_inicio, $fecha_final);
print json_encode($datos);
?>

<?php if (!empty($datos)) : ?>
  <a class="btn btn-primary" data-bs-toggle="modal" href="#discipulado-grafico" role="button">abrir reporte</a>

  <!-- Modal para formulario de fechas de-->
  <div class="modal fade" id="discipulado-grafico" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Reporte estadistico discipulado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
        <div id="grafico"></div>  
      </div>
      </div>
    </div>
  </div>
 
<?php endif ?>