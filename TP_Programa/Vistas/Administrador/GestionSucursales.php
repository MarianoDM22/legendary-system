<?php namespace Administrador;


 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- No viene de bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Gestion_Sucursales</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
     <!-- Mi CSS -->
    <link href="css/estilos.css" type="text/css" rel="stylesheet">

  </head>
  <body>

  	<?php require("nav.php"); ?>
  	
  	<header class="bg-dark"">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Gestión Sucursales</h1>
				</div>
			</div>
		</div>
	</header>

	<div class="container">
		<div class="row">
			<section class="col-md-8">
				<h2>Sucursales</h2>

				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-insc">
				  Nueva Sucursal
				</button>

				<!-- Modal Nueva Sucursal-->
				<div class="modal fade" id="modal-insc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">		  
					<div class="modal-dialog" role="document">
					    <div class="modal-content">
					      	<form action= "<?= ROOT_VIEW ?> /GestionSucursal/nuevo" method="post" enctype="multipart/form-data">
						      	<div class="modal-header">
							        <h5 class="modal-title">Nueva Sucursal</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          	<span aria-hidden="true">&times;</span>
							        </button>
							   	</div>
								<div class="modal-body">
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-11">
												<label>Nombre: </label>
												<input type="text" name="nombre" class="form-control" required><br>
												<label>Direccion: </label>
												<input type="text" name="direccion" class="form-control" required><br>
												<div class="row">
													<div class="col-sm-6">
														<label>Latitud: </label>
														<input type="text" name="latitud" class="form-control" required>
													</div>
													<div class="col-sm-6">
														<label>Longitud: </label>
														<input type="text" name="longitud" class="form-control" required><br>
													</div>	
												</div>
											</div>
										</div>	
									</div>			
								</div>
								<div class="modal-footer">
								        <input type="submit"  class="btn btn-default" value="Guardar" name="upload">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							    </div>
						 	 </form>
					    </div>
				  	</div>
				</div>
				<!-- Fin Modal -->


					<table class="table table-bordered table-responsive">
						<thead class="thead-inverse">
							<tr>
								<th>Id</th>
								<th>Nombre</th>
								<th>Direccion</th>
								<th colspan="2">Coordenadas</th>
								<th colspan="2">Opciones</td>
							</tr>
						</thead>
						<tbody>
							<?php

									foreach ($cervezas  as $key => $value) { ?>
								
									<tr>
										<td><?= $value->getId(); ?></td>
										<td><?= $value->getNombre(); ?></td>
										<td><?= $value->getDomicilio(); ?></td>
										<td><?= $value->getLatitud(); ?></td>
										<td><?= $value->getLongitud(); ?></td>
										<td>
											<!-- Boton Modal y Modal modificar-->
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-inscp-<?= $value->getId() ?>">Modificar</button>
											
											<div class="modal fade" id="modal-inscp-<?= $value->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

												<div class="modal-dialog" role="document">
												    <div class="modal-content">
												      	<form action="<?= ROOT_VIEW ?>/GestionSucursal/modificar" method="post" enctype="multipart/form-data">
													      	<div class="modal-header">
														        <h5 class="modal-title">Modificar Sucursal</h5>
														        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
														          	<span aria-hidden="true">&times;</span>
														        </button>
														   	</div>
															<div class="modal-body">
																<div class="container-fluid">
																	<div class="row">
																		<div class="col-md-11">
																			<label>Nombre: </label>
																			<input type="text" name="nombre" class="form-control" value="<?= $value->getNombre(); ?>" required><br>
																			<label>Direccion: </label>
																			<input type="text" name="direccion" class="form-control" value="<?= $value->getDomicilio(); ?>" required><br>
																			<div class="row">
																				<div class="col-sm-6">
																					<label>Latitud: </label>
																					<input type="text" name="latitud" class="form-control" value="<?= $value->getLatitud(); ?>" required>
																				</div>
																				<div class="col-sm-6">
																					<label>Longitud: </label>
																					<input type="text" name="longitud" class="form-control" value="<?= $value->getLongitud(); ?>" required><br>
																				</div>	
																			</div>
																			<input type="hidden" name="id" class="form-control" value="<?= $value->getId();?>" >
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
											<form action="<?= ROOT_VIEW ?>/GestionSucursal/borrar" method="POST">
												<input type="hidden" name="id" value="<?= $value->getId(); ?>">
												<button type="submit" class="btn btn-primary" >Eliminar</button>
											</form>
										</td>
									</tr>

							<?php } ?>
						</tbody>
					</table>

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