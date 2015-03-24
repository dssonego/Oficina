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
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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

	<!-- MODAL VISUALIZA CLIENTES -->
	<script>
        $(function () {

            $('a.visualiza-clientes').click(function (e) {
                e.preventDefault();
                //alert("ok");

                $('#basicModal').modal("show")
                $('iframe').attr("src", $(this).attr("href"));
            });

            $('#basicModal').on('hidden.bs.modal', function () {
                $('iframe').attr("src", "");
            });

        });

        /*ATUALIZA PAGINA*/
        $(document).ready(function() {
     		$('.fade , .close-visualiza').click(function() {
             //$( "body" ).load( "index.php" );
             location.reload();
       		});
		});
		/*ATUALIZA PAGINA*/

    </script>
    <!-- MODAL VISUALIZA CLIENTES -->
    
	

</head>
<body>
	<!-- MODAL VISUALIZA CLIENTES -->
	<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content" id="modal-visualiza-cliente">
            <div class="modal-header">
            <button type="button" class="close close-visualiza" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Dados Cliente</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body" style="background-color: #fff;height:330px;">
                    <iframe width="100%" height="320" src="" frameborder="0" allowfullscreen=""></iframe>
                </div>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
        	</div>-->
    	</div>
  	</div>
	</div>
	<!-- MODAL VISUALIZA CLIENTES -->




	<div class="topo">
		<div class="container">
			<img src="../image/logo.png" alt="" />
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
				<li><a href="#"><img src="../image/icones/config.png" alt="" /></a></li>
				<li><a href="../logout.php" title="Sair"><img src="../image/icones/logout.png" alt="" /></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <section class="dados">
      		<div class="container">
      			<div class="col-md-4  col-sm-4">
      				<h1>Clientes</h1>
      			</div>
      			<div class="col-md-6 searcandnovo">
	      			<div class="col-md-6 col-sm-6 novo">
	      				<a href="#" title="Cadastrar Novo Cliente">
	      					Cadastrar Novo Cliente
	      				</a>
      				</div>
	      			<div class="col-md-6 col-sm-6 search">
	      				<div class="input-group">
							<input id="filter" type="text" class="form-control" placeholder="Clientes">
						</div> 
	      			</div>
      			</div>
      		</div>
      </section>

	<div id="tabela" class="container tabela">          
		<table class="table table-striped table-bordered table-hover table-condensed">
			<thead>
				<tr class="topo-tabela">
					<th>Nome</th>
					<th>Telefone</th>
					<th>Celular</th>
					<th>A&ccedil;&otilde;es</th>
				</tr>
			</thead>
			<tbody class="searchable">
				<?php echo $objCliente->TabelaCliente();?>
			</tbody>
		</table>
	</div>

</body>
</html>