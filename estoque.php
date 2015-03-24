<?php
require_once(dirname(__FILE__).'/class/Login.php');
$objLogin = new Login();

$objLogin->verificarLogado();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>Bem Vindo</title>
	<link rel="stylesheet" href="css/corpo.css" />

	<!-- BOOTSTRAP -->
	<link href="bootstrap/bootstrap.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap/bootstrap.min.js"></script>
	

</head>
<body>

	<div class="topo">
		<div class="container">
			<img src="image/logo.png" alt="" />
		</div>
	</div>

	<nav class="navbar">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              	<li class="active"><a href="#"><span class="estoque"></span>Estoque</a></li>
			  	<li><a href="#"><span class="agenda"></span>Agenda</a></li>
				<li><a href="#"><span class="clientes"></span>Clientes</a></li>
				<li><a href="#"><span class="financeiro"></span>Financeiro</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              	<li class="bem-vindo">Seja bem vindo(a) <span><?php echo $objLogin->NomeUsuario();?></span></li>
				<li><a href="#"><img src="image/icones/config.png" alt="" /></a></li>
				<li><a href="logout.php" title="Sair"><img src="image/icones/logout.png" alt="" /></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

</body>
</html>