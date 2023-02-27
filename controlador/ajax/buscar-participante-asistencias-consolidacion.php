<?php
require_once("../../vendor/autoload.php");

use Csr\Modelo\Consolidacion;
$objeto = new Consolidacion();
session_start();
$busqueda = $_GET['busqueda'];
$matriz_participantes = $objeto->listar_participantes($busqueda);

?>

  <select multiple name="asistentes[]" id="asistentes" class="form-control">             
  <?php foreach ($matriz_participantes as $participante) : ?>
  <option value="<?php echo $participante['participantes_cedula']; ?>"> <?php echo $participante['participantes_codigo']; ?></option>
  <?php endforeach;       ?>
  </select>
