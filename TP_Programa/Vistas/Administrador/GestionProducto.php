<?php namespace Administrador;


 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- No viene de bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Gestion_Producto</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
     <!-- Mi CSS -->
    <link href="css/estilos.css" type="text/css" rel="stylesheet">

  </head>
  <body>

  	<?php require("nav.php"); ?>

  	<header class="bg-primary">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Gestión Productos</h1>
				</div>
			</div>
		</div>
	</header>



	<div class="container">
		<div class="row">
			<section class="col-md-10">
				<h2>Productos</h2>

		<?php
			if(isset($_SESSION['TipoCerveza'])) {
			$TipoCerveza = $_SESSION['TipoCerveza'];}
			var_dump($TipoCerveza);
		?>
			
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-insc">
				  Nuevo Producto
				</button>

				<!-- Modal Producto-->
				<div class="modal fade" id="modal-insc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">		  
					<div class="modal-dialog " role="document">
					    <div class="modal-content">
					      	<form action="<?= ROOT_VIEW ?>/GestionProducto/nuevo" method="post" enctype="multipart/form-data">
						      	<div class="modal-header">
							        <h5 class="modal-title">Nuevo Producto</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          	<span aria-hidden="true">&times;</span>
							        </button>
							   	</div>
								<div class="modal-body">
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-11">
												<label>Descripción: </label>
												<input type="text" name="descripcion" class="form-control" /><br>
												<label>Tipo de Cerveza: </label><br>
												<select name="TipoCerveza" class="custom-select">
													<option  disabled>Seleccione el Tipo de Cerveza...</option>
													<?php 
													foreach ($TipoCerveza as $key => $value) { ?>
														<option value="<?= $value->getId();  ?>"><?= $value->getDescripcion();  ?></option>
													<?php } ?>
												</select><br><br>
													<div class="row">
														<div class="col-sm-6">
															<label>Capacidad en Litros: </label>
															<input type="text" name="capacidad" class="form-control" />
														</div>
														<div class="col-sm-6">
															<label>Factor: </label>
															<input type="text" name="factor" class="form-control" /><br>
														</div>	
													</div>
												<label>Imagen: </label>
												<input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required="required"><br>
											</div>
										</div>	
									</div>
								</div>
								<div class="modal-footer">
								        <input type="submit" name="guardar" class="btn btn-default" value="Guardar">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							    </div>
						 	 </form>
					    </div>
				  	</div>
				</div>

				<!-- Fin Modal -->

			<?php
				if(isset($_SESSION['Producto'])) {
					$Producto = $_SESSION['Producto']; ?>

					<table class="table table-bordered table-responsive">
						<thead class="thead-inverse">
							<tr>
								<th>Id</th>
								<th>Descripcion</th>
								<th>Cerveza</th>
								<th>Capacidad en Litros</th>
								<th>Factor</th>
								<th>Precio</th>
								<th>Imagen</th>
								<th colspan="2">Opciones</td>
							</tr>
						</thead>
						<tbody>
							<?php 
									foreach ($Producto as $key => $value) { ?>
								
									<tr>
										<td><?= $value->getId(); ?></td>
										<td><?= $value->getDescripcion(); ?></td>
										<td><?= $value->getMTiposDeCerveza(); ?></td>
										<td><?= $value->getCapacidad(); ?></td>
										<td><?= $value->getFactor(); ?></td>
										<td>
										<form action="<?= ROOT_VIEW ?>/GestionProducto/calcularPrecio" method="POST">
											<input type="hidden" name="id" value="<?= $value->getId(); ?>">
										</form>
										</td>
										<td><img src="<?= "../" . $value->getImagen(); ?>" width="30"></td>

										<td>
										<!-- Boton Modal y Modal modificar-->
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-inscp-<?= $value->getId() ?>">Modificar</button>
										
											<div class="modal fade" id="modal-inscp-<?= $value->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

												<div class="modal-dialog" role="document">
												    <div class="modal-content">
												      	<form action="<?= ROOT_VIEW ?>/GestionProducto/modificar" method="post" enctype="multipart/form-data">
													      	<div class="modal-header">
														        <h5 class="modal-title">Modificar Producto</h5>
														        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
														          	<span aria-hidden="true">&times;</span>
														        </button>
														   	</div>
															<div class="modal-body">
																<div class="container-fluid">
																	<div class="row">
																		<div class="col-md-11">
																			<label>Descripción: </label>
																			<input type="text" name="descripcion" class="form-control" value="<?= $value->getDescripcion(); ?>" /><br>
																			<label>Tipo de Cerveza: </label><br>
																			<select name="TipoCerveza" class="custom-select">
																				<option disabled>Seleccione el Tipo de Cerveza...</option>
																				<?php 
																				foreach ($TipoCerveza as $key => $valor) { ?>
																					<option value="<?= $valor->getId();  ?>"><?= $valor->getDescripcion();  ?></option>
																				<?php } ?>
																			</select><br><br>
																				<div class="row">
																					<div class="col-sm-6">
																						<label>Capacidad en Litros: </label>
																						<input type="text" name="capacidad" class="form-control" value="<?= $value->getCapacidad(); ?>" />
																					</div>
																					<div class="col-sm-6">
																						<label>Factor: </label>
																						<input type="text" name="factor" class="form-control" value="<?= $value->getFactor(); ?>" /><br>
																					</div>	
																				</div>
																			<label>Imagen: </label>
																			<input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required="required"><br>
																		</div>
																	</div>	
																</div>			
															</div>
															<div class="modal-footer">
															        <input type="submit" name="guardar" class="btn btn-default" value="Guardar">
															        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
														    </div>
													 	 </form>
												    </div>
											  	</div>
											</div>
											<!-- Fin Modal -->
										</td>
										<td>
											<form action="<?= ROOT_VIEW ?>/GestionProducto/borrar" method="POST">
												<input type="hidden" name="id" value="<?= $value->getId(); ?>">
												<button type="submit" class="btn btn-primary" >Eliminar</button>
											</form>
										</td>
									</tr>

							<?php } ?>
						</tbody>
					</table>
				<?php } ?>

			</section>
    	</div>
	</div>
  	

	<?php require(ROOT . "Vistas/footer.php"); ?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>