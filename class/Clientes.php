<?php
require_once('Connection.php');
require_once('Veiculos.php');
	
Class Clientes{

	public function __construct(){
		$db = new Connection();
		$this->db = $db->instance();
	}

	function TabelaCliente(){
		$objVeiculo = new Veiculos();
		$tabelacliente=$this->db->prepare("SELECT * FROM clientes");
		$tabelacliente->execute();

		/*MOSTRA TABELA DE CLIENTES*/
		while($dados=$tabelacliente->fetch(PDO::FETCH_ASSOC)){
			echo "<tr>";
			echo	"<td>".$dados["nome"]."</td>";
			echo	"<td>".$dados["telefone"]."</td>";
			echo	"<td>".$dados["celular"]."</td>";
			echo	"<td style='width:200px;'>";
			echo "	<li class='dropdown' id='menuLogin'>
            <a class='dropdown-toggle' href='#' data-toggle='dropdown' id='navLogin'><img src='../image/icones/add_car.png' alt=''></a>
            <div class='dropdown-menu' style='padding:17px;width:220px;'>
              <form action='' method='POST' id='cadastraveiculo'>
                <input name='id_cliente' type='hidden' value='".$dados['id_cliente']."'> 
                <input name='nome' type='hidden' value='".$dados['nome']."'>
                <input name='placa' type='text' placeholder='Placa' required> 
                <input name='marca' type='text' placeholder='Marca' required><br>
                <input type='submit' value='Cadastrar Veiculo' name='Enviar'/>
              </form>
            </div>
            <a href='visualiza-clientes.php?codigo=".$dados['id_cliente']."' class='visualiza-clientes'><img src='../image/icones/visualiza.png' alt='' ></a>
            <img src='../image/icones/editar.png' alt=''>
            <img src='../image/icones/excluir.png' alt=''>
          </li>
			";
			echo"</td>";
			echo "</tr>";
		}
		/*MOSTRA TABELA DE CLIENTES*/ 

		/*ENVIA POR PARAMETRO OS DADOS - FUNÇÃO CADASTRAR VEICULO*/ 
		if(isset($_POST["Enviar"]) && $_POST["Enviar"] == "Cadastrar Veiculo"){
			$objVeiculo->CadastrarVeiculo($_POST["id_cliente"],$_POST["nome"],$_POST['placa'],$_POST['marca']);
		}
		/*ENVIA POR PARAMETRO OS DADOS - FUNÇÃO CADASTRAR VEICULO*/ 
	}


	public function VisualizaCliente(){
		$objCliente = new Clientes();
		$objVeiculo = new Veiculos();
		$visualizacliente=$this->db->prepare("SELECT * FROM clientes WHERE id_cliente = :codigo");
		$visualizacliente->bindValue(":codigo",$_GET['codigo']);
		$visualizacliente->execute();

		/*VISUALIZA E EDITA O CLIENTE*/
		$dados = $visualizacliente->fetch(PDO::FETCH_ASSOC);
			echo '
			<form action="editar-clientes.php" method="POST" id="edita-cliente" class="visualiza-cliente">

			<!-- NOME -->
			<div id="nome-group" class="form-group">
				<input type="text" class="form-control" name="nome" placeholder="Nome" value='.$dados['nome'].'>
			</div>

			<!-- E-MAIL -->
			<div id="email-group" class="form-group">
				<input type="text" class="form-control" name="email" placeholder="E-mail" value='.$dados['email'].'>
			</div>

			<!-- TELEFONE -->
			<div id="telefone-group" class="form-group" style="width:47%;float:left;">
				<input type="text" class="form-control" name="telefone" placeholder="Telefone" value='.$dados['telefone'].'>
			</div>

			<!-- CELULAR -->
			<div id="celular-group" class="form-group" style="width:47%;float:right;">
				<input type="text" class="form-control" name="celular" placeholder="Celular" value='.$dados['celular'].'>
			</div>

			<!-- ENDREÇO -->
			<div id="endereco-group" class="form-group">
				<input type="text" class="form-control" name="endereco" placeholder="Endereço" value='.$dados['endereco'].'>
			</div>

			<!-- COMPLEMENTO -->
			<div id="complemento-group" class="form-group">
				<input type="text" class="form-control" name="complemento" placeholder="Complemento" value='.$dados['complemento'].'>
			</div>

			<!-- CIDADE -->
			<div id="cidade-group" class="form-group" style="width:47%;float:left;">
				<input type="text" class="form-control" name="cidade" placeholder="cidade" value='.$dados['cidade'].'>
			</div>

			<!-- ESTADO -->
			<div id="estado-group" class="form-group" style="width:47%;float:right;">
				<input type="text" class="form-control" name="estado" placeholder="estado" value='.$dados['estado'].'>
			</div>


			<!-- ID_CLIENTE -->
			<div id="id-cliente-group" class="form-group">
				<input type="hidden" class="form-control" name="id_cliente" value='.$dados['id_cliente'].'>
			</div>

			<button type="submit" class="btn btn-success">Editar <span class="fa fa-arrow-right"></span></button>

			</form>
			';  
        /*VISUALIZA E EDITA O CLIENTE*/ 

        
        /*MOSTRA OS VEICULOS DESTE CLIENTE*/
        $objVeiculo->VisualizaClienteVeiculo();
        /*MOSTRA OS VEICULOS DESTE CLIENTE*/
		
	}

	/*EDITA O CLIENTE RECEBENDO OS PARAMETROS*/
	public function EditarCliente($id_cliente,$nome,$email,$telefone,$celular,$endereco,$complemento,$cidade,$estado){

		$errors         = array();  	// array to hold validation errors
		$data 			= array(); 		// array to pass back data

	// validate the variables ======================================================
	// if any of these variables don't exist, add an error to our $errors array

	if (empty($_POST['nome']))
		$errors['nome'] = 'Nome Obrigatório.';

	if (empty($_POST['telefone']))
		$errors['telefone'] = 'Telefone Obrigatório.';

	// return a response ===========================================================

	// if there are any errors in our errors array, return a success boolean of false
	if ( ! empty($errors)) {

		// if there are items in our errors array, return those errors
		$data['success'] = false;
		$data['errors']  = $errors;
	} else {

		$editacliente=$this->db->prepare("UPDATE clientes SET nome=:nome,email=:email,telefone=:telefone,celular=:celular,endereco=:endereco,complemento=:complemento,cidade=:cidade,estado=:estado 
										 WHERE id_cliente=:id_cliente");
		$editacliente->bindValue(":id_cliente",$id_cliente);
		$editacliente->bindValue(":nome",$nome);
		$editacliente->bindValue(":email",$email);
		$editacliente->bindValue(":telefone",$telefone);
		$editacliente->bindValue(":celular",$celular);
		$editacliente->bindValue(":endereco",$endereco);
		$editacliente->bindValue(":complemento",$complemento);
		$editacliente->bindValue(":cidade",$cidade);
		$editacliente->bindValue(":estado",$estado);
		$editacliente->execute();
		// if there are no errors process our form, then return a message

		// DO ALL YOUR FORM PROCESSING HERE
		// THIS CAN BE WHATEVER YOU WANT TO DO (LOGIN, SAVE, UPDATE, WHATEVER)

		// show a message of success and provide a true success variable
		$data['success'] = true;
		$data['message'] = 'Cliente editado com sucesso!';

	}

	// return all our data to an AJAX call
	echo json_encode($data);

		
	}
	/*EDITA O CLIENTE RECEBENDO OS PARAMETROS*/
	
	
}
?>