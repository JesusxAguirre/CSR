<!DOCTYPE html>
<html>

<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.6">
	<!-- Espacio para CSS -->
	<?php require_once './resources/View_Components/importCSS.php' ?>
	<!-- Espacio para los JS -->
	<?php require_once './resources/View_Components/importJS.php' ?>
</head>

<body id="reporte">

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
	<!-- Main.php -->
	<?php
	require_once "./resources/View_Components/Main.php";
	?>
	<!-- Main.php -->
	<script type="text/javascript">
		reporte = <?php echo json_encode($reporte, JSON_NUMERIC_CHECK); ?>;
	</script>
	<script type="module" src="node_modules/highcharts/highcharts.js"></script>
	<script type="module" src="node_modules/highcharts/modules/export-data.js"></script>
	<script type="module" src="node_modules/highcharts/modules/exporting.js"></script>
	<script src="resources/js/dashboard.js"></script>
</body>

</html>