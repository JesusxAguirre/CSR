<!DOCTYPE html>
<html>

<head>
	<title>Listar Roles</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.6">


	<!-- Bostrap 5 -->
	<link rel="stylesheet" href="./resources/css/bootstrap.min.css">
	<link rel="stylesheet" href="./resources/css/style.css">
	<link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">

	<!-- Jquery -->
	<script src="./resources/js/jquery-3.6.0.min.js"></script>

	<!-- Js boostrap -->
	<script src="./resources/js/bootstrap.min.js"></script>

	<!-- SweetAlert2 -->
	<script type="text/javascript" src="resources/js/sweetalert2.js"></script>

	<style type="text/css">
		.btn.btn-secondary {
			padding: 0.375rem !important;
		}
	</style>

</head>

<body>

	<!-- Menu.php -->
	<?php
	require_once "./resources/View_Components/Menu.php";
	?>
	<!-- Menu.php -->
	<!-- sidebar.php -->
	<?php
	require_once "./resources/View_Components/Sidebar.php";
	?>
	<!-- sidebar.php -->
	<main class="pt-3">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h4 class="page-title">Listar Roles</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-body">

							<div class="d-flex justify-content-between">
								<span class="d-flex align-items-center">Buscar : <input placeholder="#, Rol, Descripción" class="form-control w-auto ms-1" id="search-input"></span>
								<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crear">
									Nuevo Rol <i class="bi bi-plus"></i>
								</button>
							</div>
							<div class="table-responsive mt-4">
								<table role="table" class="table align-middle table-dark ">
									<thead class="">
										<tr role="row">
											<th colspan="1" role="columnheader" title="Toggle SortBy" class="sortable" style="cursor: pointer;">#</th>
											<th colspan="1" role="columnheader" title="Toggle SortBy" class="sortable" style="cursor: pointer;">Rol</th>
											<th colspan="1" role="columnheader" title="Toggle SortBy" class="sortable" style="cursor: pointer;">Descripción</th>
											<th colspan="1" role="columnheader" class="">Acciones</th>
										</tr>
									</thead>
									<tbody role="rowgroup" id="roles">

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

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Modal editar -->
	<div class="modal fade edit-modal" id="editar" tabindex="-1" aria-labelledby="ModalEditar" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary text-light">
					<h5 class="modal-title">Editar Rol</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="editForm">
						<div class="mb-3">
							<label class="form-label fw-bold" for="rolInput">
								Nombre del Rol
							</label>
							<input type="text" name="nombre" id="rolInput" class="form-control" placeholder="Administrador">
						</div>
						<div class="mb-3">
							<label class="form-label fw-bold" for="descripcionInput">
								Descripción
							</label>
							<input type="text" name="descripcion" id="descripcionInput" class="form-control" placeholder="">
						</div>
						<input type="hidden" name="id" id="idInput">
						<input type="hidden" name="edit">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary" form="editForm">Guardar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal permisos -->
	<?php foreach ($roles as $rol): ?>
		<div class="modal fade edit-modal" id="permisos<?php echo($rol['nombre']) ?>" tabindex="-1" aria-labelledby="ModalPermisos" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div style="background-color: #F8F9F9;" class="modal-content">
					<div class="modal-header bg-secondary text-light">
						<h5 class="modal-title" id="ModalPermisos">Permisos de rol: <?php echo($rol['nombre']) ?></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="" method="post" id="form<?php echo($rol['nombre']) ?>">
							<input type="hidden" name="rol" value="<?php echo($rol['nombre']) ?>">
							<input type="hidden" name="idRol" value="<?php echo($rol['id']) ?>">
							<div class="row mt-2">
								<div class="mt-2 col">
									<div class="card">
										<div class="card-body">
											<div class="table-responsive mt-4">
												<table role='table' class='table align-middle'>
													<thead>
														<tr role='row'>
															<th colspan='1' role='columnheader'>#</th>
															<th colspan='1' role='columnheader'>Modulo</th>
															<th colspan='1' role='columnheader'>Ver</th>
															<th colspan='1' role='columnheader'>Crear</th>
															<th colspan='1' role='columnheader'>Actualizar</th>
															<th colspan='1' role='columnheader'>Eliminar</th>
														</tr>
													</thead>
													<tbody role='rowgroup'>
														<?php foreach ($modulos as $modulo): ?>
															<tr role='row'>
																<td role='cell'><?php echo $modulo['id'] ?></td>
																<td role='cell'><?php echo $modulo['nombre'] ?></td>
																<td role='cell'>
																	
																	<button type="button" class="btn btn-<?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['listar']) ? "primary" : "secondary" ?>">
																		<span>
																			<?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['listar']) ? "SI" : "NO" ?>
																		</span>
																		<input type="checkbox" style="display: none;" name="permisos['<?php echo $modulo['id'] ?>'][]" value="1" <?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['listar']) ? "checked" : "" ?>>
																	</button>
																</td>
																<td role='cell'>
																	<button type="button" class="btn btn-<?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['crear']) ? "primary" : "secondary" ?>">
																		<span>
																			<?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['crear']) ? "SI" : "NO" ?>
																		</span>
																		<input type="checkbox" style="display: none;" name="permisos['<?php echo $modulo['id'] ?>'][]" value="2" <?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['crear']) ? "checked" : "" ?>>
																	</button>
																</td>
																<td role='cell'>
																	<button type="button" class="btn btn-<?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['actualizar']) ? "primary" : "secondary" ?>">
																		<span>
																			<?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['actualizar']) ? "SI" : "NO" ?>
																		</span>
																		<input type="checkbox" style="display: none;" name="permisos['<?php echo $modulo['id'] ?>'][]" value="3" <?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['actualizar']) ? "checked" : "" ?>>
																	</button>
																</td>
																<td role='cell'>
																	<button type="button" class="btn btn-<?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['eliminar']) ? "primary" : "secondary" ?>">
																		<span>
																			<?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['eliminar']) ? "SI" : "NO" ?>
																		</span>
																		<input type="checkbox" style="display: none;" name="permisos['<?php echo $modulo['id'] ?>'][]" value="4" <?php echo ($permisos[$rol['nombre']][$modulo['nombre']]['eliminar']) ? "checked" : "" ?>>
																	</button>
																</td>
															</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer justify-content-center">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success" form="form<?php echo($rol['nombre']) ?>">Guardar</button>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
	<!--FIN  Modal permisos -->


	<!-- Modal Eliminar -->
	<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="Modaleliminar" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger text-light">
					<h5 class="modal-title" id="Modaleliminar">¿Eliminar Rol?</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body fs-5">
					<p>Se eliminará el rol <b id="deleteRolName"></b> permanetemente.</p>
					<form method="post" id="deleteForm">
						<input type="hidden" name="id" class="id">
						<input type="hidden" name="delete">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-danger" id="deleteButton">Confirmar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Eliminar -->

	<!-- Modal crear -->
	<div class="modal fade edit-modal" id="crear" tabindex="-1" aria-labelledby="ModalCrear" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary text-light">
					<h5 class="modal-title">Crear Rol</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form class="form" method="post" id="createForm">
						<div class="mb-3">
							<label class="form-label fw-bold" for="rolInput">
								Nombre del Rol
							</label>
							<input type="text" name="nombre" id="rolInput" class="form-control" placeholder="Ej: Administrador" autocomplete="off">
						</div>
						<div class="mb-3">
							<label class="form-label fw-bold" for="descripcionInput">
								Descripción
							</label>
							<input type="text" name="descripcion" id="descripcionInput" class="form-control" placeholder="Sin descripción" autocomplete="off">
						</div>
						<input type="hidden" name="create">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary" form="createForm">Crear</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		alertStatus = <?php echo $alert['status'] ?? '""' ; ?>;
		alertMsg = <?php echo (isset($alert['msg'])) ? '"'.$alert['msg'].'"' : '""' ; ?>;
	</script>
	<script type="text/javascript" src="resources/js/listar-roles.js"></script>
</body>