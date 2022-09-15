<?php
require_once('../../modelo/clase_celula_consolidacion.php');
$objeto = new Consolidacion();

$busqueda = $_GET['busqueda'];
$matriz_participantes = $objeto->listar_participantes($busqueda);
?>
<?php if (!empty($matriz_participantes)) : ?>
  <?php foreach ($matriz_participantes as $participante) : ?>
  <option value="<?php echo $participante['participantes_cedula']; ?>"> <?php echo $participante['participantes_codigo']; ?></option>
  <?php endforeach;       ?>
<?php endif ?>