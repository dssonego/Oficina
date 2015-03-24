<?php
require_once('../class/Veiculos.php');
require_once('../class/Login.php');

$objLogin = new Login();
$objLogin->verificarLogado();

$objVeiculo = new Veiculos();

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>Bem Vindo</title>
	<link rel="stylesheet" href="css/corpo.css" />

	<!-- BOOTSTRAP -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<!-- BOOTSTRAP -->
	
	

</head>
<body>
	<?php 
	$objVeiculo->ExcluirVeiculo($_POST["idexcluirveiculo"]); 
	?>
</body>
</html>