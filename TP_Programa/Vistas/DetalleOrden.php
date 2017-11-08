<?php namespace Vistas;


 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- No viene de bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Orden Nro <?= $value->getId(); ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
     <!-- Mi CSS -->
    <link href="css/estilos.css" type="text/css" rel="stylesheet">

  </head>
  <body>
  	<header class="bg-primary">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Orden Nro <?= $value->getEstado(); ?></h1>
				</div>
			</div>
		</div>
	</header>

	<?php require("nav.php"); ?>

	<div class="container">
		<div class="row">
			<section class="col-md-8">
				<h2>Orden Nro <?= $value->getEstado(); ?></h2>


			<?php
				if(isset($_SESSION['Pedido'])) {
					$Pedido = $_SESSION['Pedido']; ?>

					<table class="table table-bordered table-responsive">
						<thead class="thead-inverse">
							<tr>
								<th>Producto</th>
								<th>Capacidad/Litros</th>
								<th>Cantidad</th>
								<th>Importe</th>
							</tr>
						</thead>
						<tbody>
							<?php 
									foreach ($Pedido as $key => $value) { ?>
								
									<tr>
										<td><?= $value->getDescripcion(); ?></td>
										<td><?= $value->getCapacidad(); ?></td>
										<td><?= $value->getCantidad(); ?></td>
										<td><?= $value->getImporte(); ?></td>							
									</tr>

							<?php } ?>
						</tbody>
					</table>
			<?php } ?>

			</section>
    	</div>
	</div>
  	


	<?php require("footer.php"); ?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>