<?php
require_once('../../modelo/clase_roles.php');
$objeto = new Roles();
$id = $_POST['id'];

echo $objeto->delete_rol($id);
?>