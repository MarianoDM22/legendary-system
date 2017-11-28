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

    <title>Orden Nro <?= $orden->getId(); ?></title>

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
					<h1 ><strong>Orden Nro <?= $orden->getId(); ?></strong></h1>
				</div>
			</div>
		</div>
	

	

	<div class="container " >
		<div >
			<section >
				<h2 class="text-white text-center"><strong>Datos del Cliente:</strong></h2>

					<table class="table table-bordered table-responsive" id="div">
						<thead class="thead-inverse">
							<tr>
								<th class="text-center"><strong>Nombre</strong></th>
								<th class="text-center"><strong>Apellido</strong></th>
								<th class="text-center"><strong>Domicilio</strong></th>
								<th class="text-center"><strong>Email</strong></th>
								<th class="text-center"><strong>Telefono</strong></th>
							</tr>
						</thead>
						<tbody class="text-white text-center">					
							<tr>
								<td class="text-center"><strong><?= $cliente->getNombre(); ?></strong></td>
								<td class="text-center"><strong><?= $cliente->getApellido(); ?></strong></td>
								<td class="text-center"><strong><?= $cliente->getDomicilio(); ?></strong></td>
								<td class="text-center"><strong><?= $cuenta->getEmail(); ?></strong></td>
                				<td class="text-center"><strong><?= $cliente->getTelefono(); ?></strong></td> 							
							</tr>		
						</tbody>
					</table>


					<h2 class="text-white text-center"><strong>Datos de Envio:</strong></h2>

					<table class="table table-bordered table-responsive" id="div">
						<thead class="thead-inverse">
							<tr>
								<th class="text-center"><strong>Domicilio/Sucursal</strong></th>
								<th class="text-center"><strong>Fecha</strong></th>
								<th colspan="2" class="text-center"><strong>Horario de entrega</strong></th>	
							</tr>
						</thead>
						<tbody class="text-white text-center">					
							<tr>
								<?php $suc=$instanciaSucursal->buscarPorID($envio->getDomicilio() ); ?>
								<?php if ($suc!=null) $envio->setDomicilio($suc->getDomicilio());?>
								<td class="text-center"><strong><?=$envio->getDomicilio();?></strong></td>
								<td class="text-center"><strong><?= $envio->getFechaProgramada(); ?></strong></td>   
                				<td class="text-center"><strong>Desde: <?= $envio->getHoraDesde(); ?></strong></td>
                				<td class="text-center"><strong> Hasta: <?= $envio->getHoraHasta(); ?></strong></td>									
							</tr>		
						</tbody>
					</table>

					<h2 class="text-white text-center"><strong>Detalle de la Orden:</strong></h2>
					<table class="table table-bordered table-responsive" id="div">
						<thead class="thead-inverse">
							<tr>
								<th class="text-center"><strong>Producto</strong></th>
								<th class="text-center"><strong>Precio</strong></th>
								<th class="text-center"><strong>Cantidad</strong></th>
								<th class="text-center"><strong>Total</strong></th>
							</tr>
						</thead>
						<tbody class="text-white text-center">
							<?php  foreach ($orden->getMLineasDePedido() as $value) 
                				{ $prod=$instanciaProducto->buscarPorID($value->getMProducto());?>
								
								<tr>
									<td class="text-center"><strong><?= $prod->getDescripcion(); ?></strong></td>
									<td class="text-center"><strong>$<?= $value->getImporte(); ?></strong></td>
                  					<td class="text-center"><strong><?= $value->getCantidad(); ?></strong></td>
                  					<td class="text-center"><strong>$<?= $value->getCantidad() * $value->getImporte();?></strong></td>
                  											
								</tr>
								<?php $subtotal+=$value->getImporte() * $value->getCantidad(); } ?>
								<tr>
									<td class="text-right" colspan=3><strong> Total Pedido: </strong></td>
									<td>$<?= $subtotal?></td>	
								</tr>
									
								
							
						</tbody>
					</table>
			</section>
    	</div>
	</div>

	
  	
	<div id="center-block">
		<form action="<?= ROOT_VIEW ?>/GestionOrden/finalizarCompra" method="post" enctype="multipart/form-data">
			<input type="hidden" name="idPedido" value="<?= $orden->getId(); ?>">
			<center> <button type="submit" class="btn btn-danger btn-lg" ><strong>Eliminar Pedido</strong></button></center> <!-- si retira en sucursal habilito boton terminar -->
		</form>			
	</div>
	<br>



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