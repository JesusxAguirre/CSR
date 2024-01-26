<?php
require_once("../../vendor/autoload.php");
session_start();
use Csr\Modelo\Roles;
$objeto = new Roles();
$busqueda = $_GET['busqueda'];

$roles = $objeto->buscar_roles($busqueda);
?>
<?php if (!empty($roles)): ?>
	<?php foreach ($roles as $rol): ?>
		<tr class="table-secondary" role="row">
			<td role="cell" class="fs-5 id"><?php echo $rol['id'] ?></td>
			<td role="cell" class="fs-5 nombre"><?php echo $rol['nombre'] ?></td>
			<td role="cell" class="fs-5 descripcion"><?php echo ($rol['descripcion'] != '') ? $rol['descripcion'] : '<em>Sin descripción</em>' ; ?></td>
			<td class="" role="cell">
				<button type="button" data-bs-toggle="modal" data-bs-target="#permisos<?php echo($rol['nombre']) ?>" class="btn btn-outline-secondary"><i class="fs-5 bi bi-key-fill"></i></button>
				<button type="button" data-bs-toggle="modal" data-bs-target="#editar" class="btn btn-outline-primary edit-btn"><i class="fs-5 bi bi-pencil-fill"></i></button>
				<button type="button" data-bs-toggle="modal" data-bs-target="#eliminar" class="btn btn-outline-danger delete-btn"><i class="fs-5 bi bi-trash-fill"></i></button>
			</td>
		</tr>
	<?php endforeach; ?>
<?php endif ?>