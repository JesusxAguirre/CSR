<!DOCTYPE html>
<html lang="es">

<head>
	<title>Listar Cursos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.6">
	
	<!-- Bostrap 5 -->
	<link rel="stylesheet" href="resources/css/bootstrap.min.css">
	<link rel="stylesheet" href="resources/css/style.css">
	<link rel="stylesheet" href="resources/css/cursos.css">
	<link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">


	<!-- Js boostrap -->
	<script src="resources/js/bootstrap.min.js"></script>

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
	<main style="height: 100vh" class="pt-3">
		<div class="container-fluid">
			<div class="card border bg-transparent rounded-3">
				<!-- Card header START -->
				<div class="card-header bg-transparent border-bottom">
					<h3 class="mb-0">Lista de cursos</h3>
				</div>
				<!-- Card header END -->

				<!-- Card body START -->
				<div class="card-body">

					<!-- Search and select START -->
					<div class="row g-3 align-items-center justify-content-between mb-4">
						<!-- Search -->
						<div class="col-md-8">
							<form class="rounded position-relative">
								<input class="form-control pe-5 bg-transparent" type="search" placeholder="Search" aria-label="Search">
								<button class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset" type="submit">
									<i class="fas fa-search fs-6 "></i>
								</button>
							</form>
						</div>
					</div>
					<!-- Search and select END -->

					<!-- Course list table START -->
					<div class="table-responsive border-0">
						<table class="table  align-middle p-4 mb-0 table-hover">
							<!-- Table head -->
							<thead class="table-dark">
								<tr>
									<th scope="col" class="border-0 rounded-start">Título del curso</th>
									<th scope="col" class="border-0">Estudiantes</th>
									<th scope="col" class="border-0">Fecha de inicio</th>
									<th scope="col" class="border-0">Fecha de culminacion</th>
									<th scope="col" class="border-0 rounded-end">Action</th>
								</tr>
							</thead>

							<!-- Table body START -->
							<tbody>
								<!-- Table item -->
								<tr>
									<!-- Course item -->
									<td>
										<div class="d-flex align-items-center">
											<!-- Image -->
											<div class="">
												<img src="resources/img//oracion.jpg" style="width: 120px;"  class="rounded" alt="">
											</div>
											<div class="mb-0 ms-2">
												<!-- Title -->
												<h6><a class="link" href="#">Oracion 1</a></h6>
												<!-- Info -->
												<div class="d-sm-flex">
													<p class="h6 fw-light mb-0 small me-3"><i class="bi bi-border-all  me-2" style="color: orange;"></i>18 Modulos</p>
													<p class="h6 fw-light mb-0 small"><i class="bi bi-check-circle-fill text-success me-2"></i></i>6 Completados</p>
												</div>
											</div>
										</div>
									</td>
									<!-- estudiantes item -->
									<td class=" text-sm-start">125</td>
									<!-- fecha de inicio item -->
									<td class=" text-sm-start">
									01/08/2022
									</td>
									<!-- fecha de culminacion item -->
									<td class=" text-sm-start">
									01/10/2022
									</td>
										<td>										
											<a href="#" class="btn btn-sm btn-success-soft btn-round me-1 mb-0"><i class="far fa-fw fa-edit"></i></a>
										<button class="btn btn-sm btn-danger-soft btn-round mb-0"><i class="fas fa-fw fa-times"></i></button>
									</td>
								</tr>
								
							</tbody>
							<!-- Table body END -->
						</table>
					</div>
					<!-- Course list table END -->

		
				</div>
				<!-- Card body START -->
			</div>
		</div>
	</main>


</body>

</html>