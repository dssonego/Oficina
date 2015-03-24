<?php	
	require_once(dirname(__FILE__).'/class/Login.php');
	
	$objConnection = new Connection();
	$objLogin = new Login();

?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/login.css" />
	<title>Oficina Mecanica</title>
	
</head>
<body class="login">
	<div class="container-geral">
		<div class="container login">
			<form action="" method="POST">
				<input type="text" name="email" id="email" required placeholder="E-mail"/>
				<input type="password" name="senha" id="senha" required placeholder="Senha"/>
				<input type="submit" value="Enviar" name="Enviar"/>
			</form>
		<?php
		if(isset($_POST["Enviar"]) && $_POST["Enviar"] == "Enviar"){
			$logar = $objLogin->Logar($_POST["email"],$_POST['senha']);
		}
		?>
		<br />
		<?php 
		if (isset($logar)){
		?>
			<div class="container-erro">
				<?php echo $logar ?>
			</div>
		<?php } ?>
		</div>
	</div>
</body>
</html>