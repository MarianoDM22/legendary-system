<?php namespace Cliente;


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

    <title></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
     <!-- Mi CSS -->
    <link rel="stylesheet"  href="css/estilos.css" type="text/css">

  </head>
  <body>
    

        <!-- Header -->
    <header>
      <div class="bg-dark">
        <div class="container-fluid">
          <div class="row">
            
    
            <div class="col-lg-12 col-sm-4">
              <nav class="navbar navbar-expand-md navbar-dark bg-dark bd-navbar">
                <div class="container">
                  <a class="navbar-brand" href="#"><img src="http://localhost/TP_Programa/images/Icono-lúpulo.png" width="40" height="40" alt=""><b>&nbsp;Beer Recharge</b></a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> 

                      <div class="collapse navbar-collapse text-center justify-content-end" id="navbarNav" >
                        <ul class="navbar-nav">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa d-inline fa-lg fa-user-circle-o"></i>&nbsp;</a>  
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                              <a class="dropdown-item" data-toggle="modal" data-target="#changeAcountModal">
                                <i class=""></i>Mi Cuenta</a>
                             
                              <a class="dropdown-item " data-toggle="modal" data-target="#historialModal">
                                <i class=""></i>Mis Ordenes</a>
                              
                              <div class="dropdown-divider"></div>

                              <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal"
                                >LogOut</a>
                            </div>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#checkoutModal">
                              <i class="fa fa-cart-arrow-down"></i> CheckOut</a>
                          </li>
                        </ul>
                      </div>   
                </div>      
              </nav>
            </div>
          
          </div>
        </div>
      </div>
    </header>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesión?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Selecione "Logout" si está listo para finalizar su sesión.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="<?= ROOT_VIEW ?>/Login/cerrarSesion">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Logout Modal-->


    <!-- Checkout Modal-->
    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tu carrito:</h5> 
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

            <?php
            session_start();
             if(isset($_SESSION['Carrito'])) 
             {
               $lineaCarrito = $_SESSION['Carrito'];

               
                ?>
          <div class="modal-body">

               <table class="table table-bordered">
                <thead class="thead-inverse">
                  <tr>            
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th> 
                    <th>Sub Total</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody class="text-center">
               
                  <?php 
                      foreach ($lineaCarrito as $value) 
                      { $prod=$instanciaProducto->buscarPorID($value->getMProducto());?>
                    
                      <tr>
                        <td><?= $prod->getDescripcion(); ?></td>
                        
                        <td>$<?= $value->getImporte(); ?></td>

                        <td> 
                          <?= $value->getCantidad(); ?>
                        </td>

                        <td>$<?= $value->getCantidad() * $value->getImporte();?></td>

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

          <div class="modal-footer">
            <div class="container">
              <div class="row" >
                <div class="col-md-3 text-right ">
                  <?php
                  {
                    $totalFilas=$ControladoraPedido->sumarLineasPedido($lineaCarrito);//sumo el importe total de todas las filas
                  }
                  ?>
                  <br>
                  <h3 class="text-left" ><strong>Total: $<?= $totalFilas ?></strong></h3>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-right">
                  <div class="center-block">
                    
                    <a class="btn btn-secondary" href="<?= ROOT_VIEW ?>/Pedido/destruirCarrito">Delete</a>
                    <a class="btn btn-primary" href="<?= ROOT_VIEW ?>/Pedido/checkOut">CheckOut</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

              <?php
             }//fin IF SESSION
              ?>

            <?php
            if ( !isset($_SESSION['Carrito']) )
            { ?>
               <div class="modal-body">
              <p>No hay productos en su carrito!</p>
               </div>
            <?php  
            }//fin if no session
            ?>
            
        </div>
      </div>
    </div>
    <!-- Fin Checkout Modal-->

    <!-- Change Pass Modal-->
    <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= ROOT_VIEW ?> /Pedido/actualizarPassword" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="InputPass">Contraseña actual</label>
                <input class="form-control" id="InputPass" type="password" placeholder="Ingrese su password actual" required>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="InputNewPass">Contraseña Nueva</label>
                    <input class="form-control" id="InputNewPass" type="password" placeholder="Ingrese su nueva password" required>
                  </div>
                  <div class="col-md-6">
                    <label for="ConfirmNewPassword">Confirme su Contraseña</label>
                    <input class="form-control" id="ConfirmNewPassword" type="password" placeholder="Confirme password" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input class="form-control" id="cliente" name="cliente" type="hidden" value="<?=$cliente->getId(); ?>">
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <a class="btn btn-primary" href="<?= ROOT_VIEW ?>//index">Confirmar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Fin Change Pass Modal-->

      <!-- Change Acount Modal-->
    <div class="modal fade" id="changeAcountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= ROOT_VIEW ?> /Pedido/actualizarDatosCliente" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title">Mi Cuenta</h5>
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
              <input class="form-control" id="home" name="home" type="hidden" value="home">
            </div>
            <div class="modal-footer center-block">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <button type="submit"  class="btn btn-default">Actualizar datos</button>            
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Fin Change Acount Modall-->

  <!-- Historial Modal-->
    <div class="modal fade" id="historialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
          
            <div class="modal-header">
              <h5 class="modal-title">Mi historial de ordenes</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <table class="table table-bordered table-responsive text-center">
              <thead class="thead-inverse">
                <tr>
                  <th class="text-center">Nro de Orden</th>
                  <th class="text-center">Estado</th>
                  <th class="text-center">Fecha</th>               
                  <th class="text-center">Tipo de Envio</td>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php 
                    foreach ($pedidos as $value) { ?>                   
                  
                    <tr>
                      <td class="cl-dark text-center"><strong><?=$value->getId(); ?></td>
                      <td class="cl-dark text-center"><?= $value->getEstado();?></strong></td>
                      <td class="cl-dark text-center"><strong><?= $value->getFecha();?></strong></td>
                      <?php if($value->getMSucursales()==null )$tipoEnvio="Domicilio"; else $tipoEnvio="Sucursal"?>
                      <td class="cl-dark text-center"><strong><?=$tipoEnvio ?></strong></td>
                    </tr>
                    
                <?php } //fin primer for each?>
              </tbody>
            </table>

            </div>

            <div class="modal-footer center-block">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>                   
            </div>
          
        </div>
      </div>
    </div>
    <!--Fin Historial Modal-->


      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>