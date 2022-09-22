<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();
session_start();
$busqueda = $_GET['busqueda'];
$matriz_participantes = $objeto->listar_participantes($busqueda);

?>
<?php if (!empty($matriz_participantes)) : ?>
  <select multiple name="asistentes[]" id="asistentes" class="form-control">             
  <?php foreach ($matriz_participantes as $participante) : ?>
  <option value="<?php echo $participante['participantes_cedula']; ?>"> <?php echo $participante['participantes_codigo']; ?></option>
  <?php endforeach;       ?>
  </select>
<?php endif ?>