<?php
require_once('../class/Clientes.php');
require_once('../class/Login.php');

$objLogin = new Login();
$objLogin->verificarLogado();

$objCliente = new Clientes();

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<title>Bem Vindo</title>
	<link rel="stylesheet" href="../css/corpo.css" />

	<!-- BOOTSTRAP -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<!-- BOOTSTRAP -->

	<!-- FILTRO -->
	<script>
		$(document).ready(function () {

			(function ($) {

				$('#filter').keyup(function () {

					var rex = new RegExp($(this).val(), 'i');
					$('.searchable tr').hide();
					$('.searchable tr').filter(function () {
						return rex.test($(this).text());
					}).show();

				})

			}(jQuery));

		});
	</script>
	<!-- FILTRO -->

	
	<script type="text/javascript">
		$(function(){
				// AJAX EXCLUIR VEICULO
				$('.excluir').click(function(){
					//Pega o ID do produto
					var id = $(this).attr('id');
					//Função ajax
					$.ajax({
						//Tipo de envio POST ou GET
						type: "POST",
						//Caminho do arquivo que processa o carrinho
						url: "../Veiculos/excluir-veiculos.php",
						//Arquvios passados via POST neste caso, segue o mesmo modelo para GET
						data: "idexcluirveiculo="+id,
						cache: false,
						//Se der tudo ok no envio...
						success: function(data){
							//Colocar a resposta do aqruivo na div de intens do carrinho
							$("#tdexcluir"+id).addClass( "excluindo" );
							$("#tdexcluir"+id).delay(2000).fadeOut('slow'); 
						}
					});

					return false;
				});
				// AJAX EXCLUIR VEICULO

				// AJAX EDITAR CLIENTE
				$('#edita-cliente').submit(function(event) {

					$('.form-group').removeClass('has-error'); // remove the error class
					$('.help-block').remove(); // remove the error text

					// get the form data
					// there are many ways to get this data using jQuery (you can use the class or id also)
					var formData = {
						'idcliente'              : $('input[name=id_cliente]').val(),
						'nome'              : $('input[name=nome]').val(),
						'email'             : $('input[name=email]').val(),
						'telefone'    : $('input[name=telefone]').val(),
						'celular'    : $('input[name=celular]').val(),
						'endereco'    : $('input[name=endereco]').val(),
						'complemento'    : $('input[name=complemento]').val(),
						'cidade'    : $('input[name=cidade]').val(),
						'estado'    : $('input[name=estado]').val()
					};

					// process the form
					$.ajax({
						type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
						url 		: 'editar-clientes.php', // the url where we want to POST
						data 		: formData, // our data object
						dataType 	: 'json', // what type of data do we expect back from the server
						encode 		: true
					})
						// using the done promise callback
						.done(function(data) {

							// log data to the console so we can see
							console.log(data); 

							// here we will handle errors and validation messages
							if ( ! data.success) {
								
								// handle errors for name ---------------
								if (data.errors.nome) {
									$('#nome-group').addClass('has-error'); // add the error class to show red input
									$('#nome-group').append('<div class="help-block">' + data.errors.nome + '</div>'); // add the actual error message under our input
								}

								// handle errors for superhero alias ---------------
								if (data.errors.telefone) {
									$('#telefone-group').addClass('has-error'); // add the error class to show red input
									$('#telefone-group').append('<div class="help-block">' + data.errors.telefone + '</div>'); // add the actual error message under our input
								}

							} else {

								// ALL GOOD! just show the success message!
								$('#edita-cliente').append('<div class="alert alert-success">' + data.message + '</div>');

								// usually after form submission, you'll want to redirect
								// window.location = '/thank-you'; // redirect a user to another page

							}
						})

						// using the fail promise callback
						.fail(function(data) {

							// show any errors
							// best to remove for production
							console.log(data);
						});

					// stop the form from submitting the normal way and refreshing the page
					event.preventDefault();
				});

			});


				// AJAX EDITAR CLIENTE
	</script>
	

</head>
<body>
	<?php echo $objCliente->VisualizaCliente(); ?>

</body>
</html>