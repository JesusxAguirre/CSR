<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.6">


<!-- Bostrap 5 -->
	<link rel="stylesheet" href="./resources/css/bootstrap.min.css">
	<link rel="stylesheet" href="./resources/css/style.css">
	<link rel="stylesheet" href="./vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="node_modules\highcharts\css\highcharts.css">


	<!-- Js boostrap -->
	<script src="./resources/js/bootstrap.min.js"></script>
	

  <!-- JQUERY -->
  <script src="./resources/js/jquery-3.6.0.min.js"></script>
	
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
    reporte = <?php echo json_encode($reporte, JSON_NUMERIC_CHECK);?>;

  </script>
	<script type="module" src="node_modules/highcharts/highcharts.js"></script>
  <script type="module" src="node_modules/highcharts/modules/export-data.js"></script>
  <script type="module" src="node_modules/highcharts/modules/exporting.js"></script>
  <script src="resources/js/dashboard.js"></script>

</body>
