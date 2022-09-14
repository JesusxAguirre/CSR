<?php
require_once('../../modelo/clase_celula_discipulado.php');
$objeto = new Discipulado();

$busqueda = $_GET['busqueda'];
$matriz_participantes = $objeto->listar_participantes($busqueda);
?>
<?php if (!empty($matriz_participantes)) : ?>

<?php endif ?>