<?php namespace Cliente;


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
    <link href="css/estilos.css" type="text/css" rel="stylesheet">

  </head>
  <body>
    

        <!-- Header -->
    <header>
      <div class="bg-dark">
        <div class="container-fluid">
          <div class="row">
            
            <div class="col-lg-6 col-sm-8">


            </div>
          
            <div class="col-lg-6 col-sm-4">
              <nav class="navbar navbar-expand-md navbar-dark bg-dark bd-navbar">
                <div class="container">
                  <a class="navbar-brand" href="#"><i class="fa d-inline fa-lg fa-cloud"></i><b>&nbsp;Beer Recharge</b></a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> 

                      <div class="collapse navbar-collapse text-center justify-content-end" id="navbarNav" >
                        <ul class="navbar-nav">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa d-inline fa-lg fa-user-circle-o"></i>&nbsp;</a>  
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="#">Mi Cuenta</a>
                              <a class="dropdown-item " data-toggle="modal" data-target="#changeModal">
                                <i class=""></i>Cambiar Contraseña</a>
                              <a class="dropdown-item" href="#">Mis Ordenes</a>
                              
                              <div class="dropdown-divider"></div>

                              <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal"
                                >LogOut</a>
                            </div>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#checkoutModal">
                              <i class=""></i>CheckOut</a>
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
          <div class="modal-body">

           <?php
             if(isset($_SESSION['Carrito'])) {
               $lineaCarrito = $_SESSION['Carrito']; ?>

              <!-- todas las lineas del pedido-->
              <table class="table table-bordered">
                <thead class="thead-inverse">
                  <tr>            
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Cantidad</th> 
                    <th>Sub Total</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
               
                  <?php 
                      foreach ($lineaCarrito as $key => $value) { ?>
                    
                      <tr>
                        <td>
                          <img src="<?= "../" . $value->getImagen(); ?>" width="40">
                          <?= $value->getDescripcion(); ?>    
                        </td>
                        
                        <td>$<?= $value->getPrecio(); ?></td>
                        <td> 
                          <select class="custom-select" name="qty">
                            <option> 1 </option>
                            <option> 2 </option>
                            <option> 3 </option>
                            <option> 4 </option>
                          </select>
                        </td>
                        <td>$<?= $value->getPrecioSubTotal($value); ?> </td>
                        <td>
                          <form action="<?= ROOT_VIEW ?>/ /borrar" method="POST">
                            <input type="hidden" name="id" value="<?= $value->getId(); ?>">
                            <button type="submit" class="btn btn-primary">Eliminar</button>
                          </form>
                        </td>
                      </tr>  
                      
                  <?php } ?>     
                </tbody>  
              </table>      
          </div>
          
          <?php } ?><!-- Fin sessionl-->

          
          <?php
          if( !isset($_SESSION['Carrito']) ){?>
            <p>No hay productos en su carrito!</p>
          <?php } ?>
          

        </div>
      </div>
    </div>
    <!-- Fin Checkout Modal-->

    <!-- Change Pass Modal-->
    <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="InputPass">Contraseña actual</label>
              <input class="form-control" id="InputPass" type="password" placeholder="Ingrese su password actual">
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <label for="InputNewPass">Contraseña Nueva</label>
                  <input class="form-control" id="InputNewPass" type="password" placeholder="Ingrese su nueva password">
                </div>
                <div class="col-md-6">
                  <label for="ConfirmNewPassword">Confirme su Contraseña</label>
                  <input class="form-control" id="ConfirmNewPassword" type="password" placeholder="Confirme password">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="<?= ROOT_VIEW ?>//index">Confirmar</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Change Pass Modal-->



      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>