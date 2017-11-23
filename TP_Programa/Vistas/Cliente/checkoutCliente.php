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
  <body style="background-image: url(&quot;http://localhost/TP_Programa/images/fondocheck.png&quot;);">

    <?php require("headerCliente.php"); ?>

<form action="<?= ROOT_VIEW ?>/Pedido/finalizarCompra" method="post" enctype="multipart/form-data"><!-- FORMULARIO GENERAL PARA ENVIAR COMPRA FINAL A BD -->

  <div class="container"> <!-- TABLA DATOS PERSONALES -->
      <div class="row">
        <div class="col-lg-12">
          <br>
          <br>
          <h4  class="text-white text-center"><strong>Datos Personales:</strong></h4>
          <table class="table table-bordered" id="div">
            <thead class="thead-inverse text-center">
              <tr>            
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Domicilio</th> 
                <th>Email</th>
                <th>Telefono</th>
              </tr>
            </thead>
            <tbody class="text-white text-center">
              <tr>
                <td><?= $cliente->getNombre(); ?></td>                        
                <td><?= $cliente->getApellido(); ?></td>
                <td><?= $cliente->getDomicilio(); ?></td>
                <td><?= $cuenta->getEmail(); ?></td>
                <td><?= $cliente->getTelefono(); ?></td> 
              </tr>              
            </tbody>          
          </table>

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Modificar datos Personales
          </button>

        </div>  
      </div>

      <br> 

      <div class="row"> <!-- TABLA ENVIO -->
        <div class="col-lg-12">
          <h4 class="text-white text-center"><strong>Envio:</strong></h4>
          <table class="table table-bordered">
            
          </table>           
          <table class="table table-bordered"  >
            <thead class="thead-inverse text-center">
              
              <tr>
              
                <th>Domicilio</th>
                <th>Email</th>
                <th>Fecha</th> 
                <th colspan="2">Horario de entrega</th>
                <th>Telefono</th>
              </tr>

            </thead>
            <tbody class="text-white text-center">
              
              <tr>
                
                <td id="div"><?= $cliente->getDomicilio(); ?></td>                        
                <td id="div"><?= $cuenta->getEmail(); ?> </td>
                <td id="div"><input type="datetime-local" name="fecha"></td>   
                <td id="div">Desde: <input type="time" name="horaDesde" ></td>
                <td id="div">Hasta: <input type="time" name="horaHasta" placeholder="11" ></td>
                <td id="div"> <?= $cliente->getTelefono(); ?> </td>  
              </tr>               
            </tbody>    
          </table>

          <table class="table table-bordered" id="div"  >
            <thead class="thead-inverse text-center">
              <tr>
                <th>Sucursal</th>
                <th>Direccion</th>
              </tr>            
            </thead>
            <tbody class="text-white text-center">
              <tr>
                <td>
                  <select class="custom-select">
                    <option disabled>Seleccione la sucursal...</option>
                    <?php if ($sucursales != null){ foreach ($sucursales as $suc)
                      {?> 
                      <option value="<?= $suc->getId();  ?>"><?= $suc->getNombre(); ?></option>
                    <?php } //fin foreach 
                      }//fin if?>
                      <?php if($sucursales ==null){?><option>No hay sucursales</option> <?php }?>
                  </select>                
                </td>
                <td>
                   <?php if (isset($suc)) {?> <?=$suc->getDomicilio();  }?>
                </td>
              </tr>
            </tbody>          
          </table>              
        </div>
      </div>

      <br>

      <div class="row"><!-- TABLA RESUMEN -->
        <div class="col-lg-12">
          <h4 class="text-white text-center"><strong>Resumen del Pedido</strong></h4>
            <table class="table table-bordered" id="div">
              <thead class="thead-inverse text-center">
                <tr>            
                  <th>Descripcion</th>
                  <th>Precio</th>
                  <th>Cantidad</th> 
                  <th>Total</th> 
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody class="text-white text-center">
                <?php  foreach ($lineaPedido as $value) 
                { $prod=$instanciaProducto->buscarPorID($value->getMProducto());?>
                <tr>
                  <td><?= $prod->getDescripcion(); ?></td> 
                  <td>$<?= $value->getImporte(); ?></td>
                  <td><?= $value->getCantidad(); ?></td>
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
      </div>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary btn-lg">Finalizar Compra</button>
    </div>
  
</form><!-- fin formulario general -->
    
      
      
   

  <!-- Address Modal-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= ROOT_VIEW ?> /Pedido/actualizarDatosEnvio" method="post" enctype="multipart/form-data">
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
                    <input class="form-control" id="nombre" name="nombre" type="text" aria-describedby="nameHelp" value="<?= $cliente->getNombre(); ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label for="InputLastName">Apellido</label>
                    <input class="form-control" id="apellido" name="apellido" type="text" aria-describedby="nameHelp" value="<?= $cliente->getApellido(); ?>" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="InputAddress">Domicilio</label>
                <input class="form-control" id="domicilio" name="domicilio" type="text" aria-describedby="nameHelp" value="<?= $cliente->getDomicilio(); ?>" required>
              </div>  
              <div class="form-group">    
                <label for="InputTel">Teléfono</label>
                <input class="form-control" id="telefono" name="telefono" type="text" aria-describedby="nameHelp" value="<?= $cliente->getTelefono(); ?>" required>                
              </div>
            </div>
            <div class="form-group">
              <input class="form-control" id="cliente" name="cliente" type="hidden" value="<?=$cliente->getId(); ?>">
            </div>
            <div class="form-group">
              <input class="form-control" id="idCuenta" name="idCuenta" type="hidden" value="<?=$cuenta->getId(); ?>">
            </div>
            <div class="modal-footer center-block">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <input type="submit" name="guardar" class="btn btn-default" value="Guardar">              
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Fin Address Modal-->

    <?php require(ROOT . "Vistas/footer.php"); ?>

    <style>
  
    #div {background: rgba(0,0,0,0.6)}   /* transparencia solo del fondo , resaltando los botones y texto */
    #cell {background:rgba(255, 125, 0, 0);} /*transparencia total*/
  
    </style>

      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>