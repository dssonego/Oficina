<?php
require_once('../class/Clientes.php');
require_once('../class/Login.php');

$objLogin = new Login();
$objLogin->verificarLogado();

$objCliente = new Clientes();

$objCliente->EditarCliente($_REQUEST["idcliente"],$_REQUEST["nome"],$_REQUEST["email"],$_REQUEST["telefone"],$_REQUEST["celular"],$_REQUEST["endereco"],$_REQUEST["complemento"],$_REQUEST["cidade"],$_REQUEST["estado"]); 
?>