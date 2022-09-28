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


	<!-- Js boostrap -->
	<script src="./resources/js/bootstrap.min.js"></script>
	
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
<!-- Main.php -->
<?php
	require_once "./resources/View_Components/Main.php";
?>
<!-- Main.php -->
</div>
<script type="text/javascript">
    reporte = <?php echo json_encode($reporte, JSON_NUMERIC_CHECK);?>;

  </script>
  <script src="resources/js/dashboard.js"></script>

</body>
