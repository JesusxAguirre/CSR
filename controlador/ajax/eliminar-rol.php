<?php
require_once("../../vendor/autoload.php");
use Csr\Modelo\Roles;
$objeto = new Roles();
$id = $_POST['id'];

echo $objeto->delete_rol($id);
?>