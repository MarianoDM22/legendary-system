<?php namespace Cliente;

session_start();

$lineaPedido=array();
$lineaPedido=$_SESSION['Carrito'];
$cuenta = $_SESSION['Login'];


use \Controladoras\ControlGestionSucursal as ControlGestionSucursal;
use \Controladoras\ControlCliente as ControlCliente;
$DAOClientes= new ControlCliente();
$DAOSucursal= new ControlGestionSucursal();


$sucursales=$DAOSucursal->traerTodos();//me devuelve todas las sucursales de la BD, null si no hay 

$idCliente=$cuenta->getMCliente();//tomo el id de cliente asignado a la cuenta logueada
$cliente=$DAOClientes->buscarClientePorId($idCliente);//RECIBE EL OBJETO CLIENTE O NULL SI NO LO ENCUENTRA

 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- No viene de bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>CheckOut</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Font Awesome-->
    <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Mi CSS -->
    <link href="css/estilos.css" type="text/css" rel="stylesheet">

  </head>
  <body>

    <?php require("headerCliente.php"); ?>

    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-5">
          <div id="shipAdd">
            <h2>1. Direccion de Envío: </h2>
            <br>

              <address>
              <!-- aca van los datos por defecto que estan en session-->
              <?= $cliente->getNombre(); ?>
              <?= $cliente->getApellido(); ?>
              <br>
              <?= $cliente->getDomicilio(); ?>
              <br>
              <?= $cuenta->getEmail(); ?>
              <br>
              <?= $cliente->getTelefono(); ?>
              <br>
            </address> 
            
          </div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
          Ingresar/Cambiar Dirección de envío.</button>   
        </div>

        <div class="col-lg-5">
          <div id="shipOpt">
            <h2>2. Opciones de Envío: </h2>
            <br>
              <p> Seleccione el tipo de envio que desee (a sucursal o a su domicilio), para una mejor refrencia de en dónde
              se encuentran nuestros locales, utilice el mapa al pie de esta página.</p>

              <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                  <input type="radio" name="options" id="option1" autocomplete="off" checked>A Sucursal:
                </label>
                
                <select class="custom-select">
                  <option disabled>Seleccione la sucursal...</option>
                  <?php  foreach ($sucursales as $suc) {?> 
                    <option value="<?= $suc->getId();  ?>"><?= $suc->getNombre(); ?>, <?= $suc->getDomicilio();  ?></option>
                  <?php } //fin foreach ?> 
                </select>  

                  <br>
                          
                <label class="btn btn-primary">
                  <input type="radio" name="options" id="option2" autocomplete="off">A Domicilio:
                </label>

                <!--Como indca la consigna, se deberia indicar fecha y rango de horarios -->
              </div>

          </div>
        </div>  

      </div>

      <div class="row">
        <div class="col-lg-10">
          <div id="shipResum" >
            <h2>Resumen del Pedido: </h2>
              <br>
               <table class="table table-bordered">
                  <thead class="thead-inverse">
                    <tr>            
                      <th>Descripcion</th>
                      <th>Precio</th>
                      <th>Cantidad</th> 
                      <th>Total</th> 
                      <th>Opciones</th>
                    </tr>
                  </thead>
                    <tbody class="text-center">
                 
                    <?php 
                        foreach ($lineaPedido as $value) 
                        {?>
                      
                        <tr>
                          <td>

                          </td>
                          <td>$<?= $value->getImporte(); ?></td>
                          <td>
                            <select class="custom-select">
                              <option selected><?= $value->getCantidad(); ?></option>
                              <option> 1 </option>
                              <option> 2 </option>
                              <option> 3 </option>
                              <option> 4 </option>
                            </select>
                          </td>
                          <td><?= $value->getCantidad() * $value->getImporte();?></td>
                          <td>
                            <form action="<?= ROOT_VIEW ?>/Pedido/borrar" method="POST">
                              <input type="hidden" name="id" value="<?= $value->getId(); ?>">
                              <button type="submit" class="btn btn-primary">Eliminar</button>
                            </form>
                          </td>
                        </tr>     
                    <?php } //fin foreach ?>    
                  </tbody>   
                </table>          
          </div>
           <button type="button" class="btn btn-secondary btn-lg">CheckOuT!</button>
        </div>    
      </div> 

    </div>



  <!-- Address Modal-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= ROOT_VIEW ?> /" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title">Dirección de envío</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="InputName">Nombre</label>
                    <input class="form-control" id="InputName" name="nombre" type="text" aria-describedby="nameHelp" value="<?= $cliente->getNombre(); ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label for="InputLastName">Apellido</label>
                    <input class="form-control" id="InputLastName" name="apellido" type="text" aria-describedby="nameHelp" value="<?= $cliente->getApellido(); ?>" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="InputAddress">Domicilio</label>
                <input class="form-control" id="InputAddress" name="domicilio" type="text" aria-describedby="nameHelp" value="<?= $cliente->getDomicilio(); ?>" required>
              </div>  
              <div class="form-group">    
                <label for="InputTel">Teléfono</label>
                <input class="form-control" id="InputTel" name="telefono" type="text" aria-describedby="nameHelp" value="<?= $cliente->getTelefono(); ?>" required>
              </div>
            </div>
            <div class="modal-footer center-block">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <a class="btn btn-primary" href="<?= ROOT_VIEW ?>/">Confirmar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Fin Address Modal-->



    <?php require(ROOT . "Vistas/footer.php"); ?>


      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>