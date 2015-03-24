<?php
require_once('Connection.php');


Class Veiculos{

	public function __construct(){
		$db = new Connection();
		$this->db = $db->instance();
	}

	/*MOSTRA OS VEICULO DO CLIENTE*/
	public function VisualizaClienteVeiculo(){
		$visualizaclienteveiculo=$this->db->prepare("SELECT * FROM veiculos WHERE id_cliente = :codigo");	
		$visualizaclienteveiculo->bindValue(":codigo",$_GET['codigo']);
		$visualizaclienteveiculo->execute();

		echo '<div class="container tabela-veiculos" style="margin: 0;padding: 0;width: 300px;float:right;">          
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead>
				<tr class="topo-tabela">
					<th>Placa</th>
					<th>Veiculo</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody class="searchable">';

				if($visualizaclienteveiculo->rowCount() >= 1){
					while($dados=$visualizaclienteveiculo->fetch(PDO::FETCH_ASSOC)){
						echo "
						<tr id='tdexcluir".$dados['id']."'>
							<td>".$dados['placa']."</td>
							<td>".$dados['marca']."</td>
							<td><a href='' class='excluir' id=".$dados['id']."><img src='../image/icones/excluir.png' alt='' style='height:17px;'></a></td>
						</tr>
					";

		}
		echo '</tbody>
				</table>
			</div>';
	}else{
		echo "<img src='../image/icones/nenhum-veiculo.png' alt='' class='nenhum-veiculo'/>";
	}
}
/*MOSTRA OS VEICULO DO CLIENTE*/	

/*CADASTRA UM VEICULO PARA O CLIENTE*/
public function CadastrarVeiculo($id_cliente,$nome,$placa,$marca){
		if(($placa != "") && ($marca != "")){
		$cadastraveiculo=$this->db->prepare("INSERT INTO veiculos (id_cliente,placa,marca) values (:id_cliente,:placa,:marca)");
		$cadastraveiculo->bindValue(":id_cliente",$id_cliente);
		$cadastraveiculo->bindValue(":placa",$placa);
		$cadastraveiculo->bindValue(":marca",$marca);
		$cadastraveiculo->execute();

		echo "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>
		Veiculo cadastrado ao cliente: <strong>".$nome."</strong>, placa: <strong>".$placa."</strong>, Marca: <strong>".$marca."</strong>
		</div>";
		}else{
			echo "<div class='alert alert-danger'>Preencha todos os campos!</div>";
		}
}
/*CADASTRA UM VEICULO PARA O CLIENTE*/

public function ExcluirVeiculo($id){
	$excluirveiculo=$this->db->prepare("DELETE FROM veiculos WHERE id = :id");
	$excluirveiculo->bindValue(":id",$id);
	$excluirveiculo->execute();
}

}
?>