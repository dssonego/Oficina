<?php
session_start();
require_once('Connection.php');
	
Class Login{

	public function __construct(){
		$db = new Connection();
		$this->db = $db->instance();
	}

	function verificarLogado(){
		if(!isset($_SESSION["logado"])){
			header("Location: dirname(__FILE__)/../index.php");
			exit();
		}
	}
	
	function Logar($email,$senha){
		//$buscarusuario = $this->db->query("SELECT * from usuario where email ='".$email."'");
		$buscarusuario=$this->db->prepare("SELECT * from usuario where email =:email ");
		//$q_usuario = mysql_query("select * from usuario where usuario.email ='".$email."'");
		$buscarusuario->bindValue(":email",$email);
		$buscarusuario->execute();
		
		if($buscarusuario->rowCount() == 1){

				$dados = $buscarusuario->fetch(PDO::FETCH_ASSOC);
				if($dados["senha"] == $senha){
				$_SESSION["id_usuario"] = $dados["id"];
				$_SESSION["logado"] = "sim";
				header("Location: dirname(__FILE__)/../estoque.php");
				}else{
					$Erro = "Senha e/ou Email errado(s)!";
				return $Erro;
				}
				
		}else{
				$Erro = "Senha e/ou Email errado(s)!";
				return $Erro;
		};		
	}

	function NomeUsuario(){
		$nomeusuario = $this->db->query("SELECT * from usuario where id ='".$_SESSION['id_usuario']."'");

		$dados = $nomeusuario->fetch(PDO::FETCH_ASSOC);
		return $dados["nome"];

	}

	function deslogar(){
		session_destroy();
		header("Location: dirname(__FILE__)/../index.php");
	}
	
}
?>