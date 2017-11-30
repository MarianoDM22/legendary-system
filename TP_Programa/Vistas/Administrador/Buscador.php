<?php namespace Vistas;
use \Controladoras\ControlPedido as ControlPedido;
$ControladoraPedido= new ControlPedido();

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- No viene de bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Buscador_por_Cliente?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
     <!-- Mi CSS -->
    <link rel="stylesheet" href="../css/estilos.css" type="text/css" >

  </head>
  <body style="background-image: url(&quot;http://localhost/TP_Programa/images/fondoGestionCerveza.jpg&quot;);">
  	<?php require("nav.php"); ?>

  	
		<div class="container">
			<div class="row">
				<div class="col-md-12 ">
					<h1 ><strong>Buscar Pedidos por Cliente</strong></h1>
					<br>
				</div>
			</div>
		</div>
	

	

	<div class="container" >
		<div>
			<section>

				<h2 class=""><strong>Ingrese Email del Cliente:</strong></h2>

				<div class="row">				
					
					<div class="col-lg-4 col-lg-offset-4">
						<form action="<?= ROOT_VIEW ?>/GestionOrden/buscador" method="POST">
	
							<div class="input-group">
							    <input class="form-control" id="email" name="email" placeholder="Ingrese Email" required>
							    <span class="input-group-btn">
							        <button type="submit" class="btn btn-primary">Buscar!</strong></button>
							    </span>
						    </div>

						</form>
					</div>
				</div>

				<br>
				
					<table class="table table-bordered table-responsive text-center table-light table-transparent" id="div">
						<thead class="thead-inverse">
							<tr>
								<th class="text-center">Nro de Orden</th>
								<th class="text-center">Estado</th>
								<th class="text-center">Cliente</th>
								<th class="text-center">Fecha</th>																
								<th class="text-center">Tipo de Envio</td>
							</tr>
						</thead>
						<tbody class="text-white text-center">
							<?php 
									foreach ($orden as $key => $value) { ?>										
								
									<tr>
										<td class="cl-dark text-center"><strong>
											<form action="<?= ROOT_VIEW ?>/GestionOrden/detalleOrden" method="POST">
												<input type="hidden" name="id" value="<?= $value->getId(); ?>">												
												<button type="submit" class="btn btn-primary" ><?= $value->getId(); ?></strong></button>
											</form>
										</td>
										<td  class="cl-dark text-center">
											<form action="<?= ROOT_VIEW ?>/GestionOrden/cambiarEstadoPedido" method="post" enctype="multipart/form-data">
												<select name="nuevoEstado">

													<strong><option name="Actual" value="<?= $value->getEstado();  ?>" selected><?= $value->getEstado();?></option></strong>
													<strong><option name="Procesando" value="Procesando">Procesando</option></strong>	
													<strong><option name="Enviado" value="Enviado">Enviado</option></strong>
													<strong><option name="Finalizado" value="Finalizado">Finalizado</option></strong>	
												</select>											
												<input type="hidden" name="idPedido" value="<?= $value->getId(); ?>">											
												<button type="submit" class="btn btn-primary" >Cambiar Estado</strong></button>	
											</form>
																										
										</td>

										<td class="cl-dark text-center"><strong><?= $instanciaCuentas->buscarCuentaPorIDCliente($value->getMCliente())->getEmail() ;?></strong></td>	
											
										<td class="cl-dark text-center"><strong><?= $value->getFecha();?></strong></td>										
										<?php if($value->getMSucursales()==null )$tipoEnvio="Domicilio"; else $tipoEnvio="Sucursal"?>
										<td class="cl-dark text-center"><strong><?=$tipoEnvio ?></strong></td>

									</tr>
									
							<?php } //fin primer for each?>
						</tbody>
					</table>

			</section>
    	</div>
	</div>



	<?php require(ROOT . "Vistas/footer.php"); ?>

	<style>
  
    #div {background: rgba(0,0,0,0.6)}   /* transparencia solo del fondo , resaltando los botones y texto */
    #cell {background:rgba(255, 125, 0, 0);} /*transparencia total*/
    #center-block {  display: block;  margin-left: auto;  margin-right: auto;}
  
    </style>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>