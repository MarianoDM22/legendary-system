<?php namespace Cliente;

session_start();

$lineaPedido=array();
$lineaPedido=$_SESSION['Carrito'];
$cuenta = $_SESSION['Login'];


use \Controladoras\ControlGestionSucursal as ControlGestionSucursal;
use \Controladoras\ControlCliente as ControlCliente;
use \Controladoras\ControlGestionProducto as ControlGestionProducto;

$DAOClientes= new ControlCliente();
$DAOSucursal= new ControlGestionSucursal();
$sucursales=$DAOSucursal->traerTodos();//me devuelve todas las sucursales de la BD, null si no hay 

$DAOProductos= new ControlGestionProducto();//creo la instancia de la controladora
//var_dump($DAOProductos); //este var dump tira como qe esta null la instancia daoproductos

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

    <div id="centrado" >
      <div class="container-fluid">
        <br>
        <br>
        <h4 style="text-align: center;" class="text-white"><strong>Datos Personales</strong></h4>
        <table class="table table-bordered" id="div">
          <thead class="thead-inverse">
                    <tr>            
                      <th id="textCentrado">Nombre</th>
                      <th id="textCentrado">Apellido</th>
                      <th id="textCentrado">Domicilio</th> 
                      <th id="textCentrado">Email</th>
                      <th id="textCentrado">Telefono</th>
                    </tr>
                  </thead>
                  <tbody>
                        <tr>
                          <td class="text-white" id="textCentrado">
                            <?= $cliente->getNombre(); ?>
                              
                          </td>                        
                          <td class="text-white" id="textCentrado">
                            <?= $cliente->getApellido(); ?>

                          </td>

                          <td class="text-white" id="textCentrado"> 
                            <?= $cliente->getDomicilio(); ?>  
                          </td>

                          <td class="text-white" id="textCentrado">
                            <?= $cuenta->getEmail();?>
                          </td>
                          <td class="text-white" id="textCentrado">
                            <?= $cliente->getTelefono(); ?>                          
                          </td>                  
                  </tbody>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
          Ingresar/Cambiar Dirección de envío</button>          
        </table>
        <br>
      </div>

      <div class="container-fluid">
        <h4 style="text-align: center;" class="text-white"><strong>Envio:</strong></h4>            
        <table class="table table-bordered" id="div">
          <thead class="thead-inverse">
                    <tr>            
                      <th id="textCentrado">Domicilio</th>
                      <th id="textCentrado">Email</th>
                      <th id="textCentrado">Fecha</th> 
                      <th id="textCentrado" colspan="2">Horario de entrega</th>
                      <th id="textCentrado">Telefono</th>
                    </tr>
                  </thead>
                  <tbody>
                        <tr>
                          <td class="text-white" id="textCentrado">
                            <?= $cliente->getDomicilio(); ?>
                              
                          </td>                        
                          <td class="text-white" id="textCentrado">
                            <?= $cuenta->getEmail(); ?>

                          </td>

                          <td class="text-white" id="textCentrado"> 
                            <input type="datetime-local" name="fecha" >  
                          </td>

                          <td class="text-white" id="textCentrado">
                            Desde: <input type="time" name="horaDesde" >
                          </td>
                          <td class="text-white" id="textCentrado">
                            Hasta: <input type="time" name="horaHasta" placeholder="11" >                       
                          </td>
                          <td class="text-white" id="textCentrado">
                            <?= $cliente->getTelefono(); ?> 
                          </td>                 
                  </tbody>
          
        </table>
        <table class="table table-bordered" id="div">
          <thead class="thead-inverse">
            <tr>
              <th id="textCentrado">Sucursal</th>
              <th id="textCentrado">Domicilio</th>
            </tr>            
          </thead>
          <tbody>
            <tr>
              <td class="text-white">
                <select class="custom-select">
                  <option disabled>Seleccione la sucursal...</option>
                  <?php  foreach ($sucursales as $suc) {?> 
                    <option value="<?= $suc->getId();  ?>"><?= $suc->getNombre(); ?></option>
                  <?php } //fin foreach ?> 
                </select>                
              </td>
              <td class="text-white" id="textCentrado">
                <?= $suc->getDomicilio();  ?>
              </td>
            </tr>
          </tbody>          
        </table>
        <br>      
      </div>
      <div>
        <div id="shipResum">
              <h4 style="text-align: center;" class="text-white"><strong>Resumen del Pedido</strong></h4>
                 <table class="table table-bordered" id="div">
                    <thead class="thead-inverse">
                      <tr>            
                        <th id="textCentrado">Descripcion</th>
                        <th id="textCentrado">Precio</th>
                        <th id="textCentrado">Cantidad</th> 
                        <th id="textCentrado">Total</th> 
                        <th id="textCentrado">Opciones</th>
                      </tr>
                    </thead>
                      <tbody>
                   
                      <?php 


                          foreach ($lineaPedido as $value)
                            $prodBuscado=$DAOProductos->BuscarPorId($value->getMProducto() );//busco el producto pasandole el id de prod qe tiene cada linea de pedido
                          {
                          ?>
                        
                          <tr>
                            <td class="text-white" id="textCentrado">                             
                              <img src="<?= "../" . $prodBuscado->getImagen(); ?>" width="50" ><!--muestro la imgagen del producto buscado -->
                            </td>
                            
                            <td class="text-white" id="textCentrado">
                              $<?= $value->getImporte(); ?>

                            </td>

                            <td class="text-white" id="textCentrado"> 
                              <?= $value->getCantidad(); ?>  
                            </td>

                            <td class="text-white" id="textCentrado">
                              <?= $value->getCantidad() * $value->getImporte();?>
                            </td>
                            <td class="text-white" id="textCentrado">
                              <form action="<?= ROOT_VIEW ?>/Pedido/borrar" method="POST">
                                <input type="hidden" name="id" value="<?= $value->getId(); ?>">
                                <button type="submit" class="btn btn-primary">Eliminar</button>
                              </form>
                            </td>
                           
                             
                          
                      <?php } //fin foreach ?>    
                    </tbody>   
                  </table>          
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
              <a class="btn btn-primary" href="<?= ROOT_VIEW ?>/">Actualizar</a>
            </div>
          </form>

        </div>
      </div>
    </div>
    <!--Fin Address Modal-->

    <style>
    #centrado 
        {margin-left: 300px;margin-right:300px;}
    #div
        {background: rgba(0,0,0,0.6)}   /* transparencia solo del fondo , resaltando los botones y texto */
    #textCentrado
        {text-align: center;} 
    </style>


    <?php require(ROOT . "Vistas/footer.php"); ?>


      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>