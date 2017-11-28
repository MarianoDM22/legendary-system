<?php namespace Cliente;

session_start();
      if (isset($_SESSION['Carrito']) )
      {
        if (count($_SESSION['Carrito'])==0 )
        {
            unset($_SESSION["Carrito"]);
        }
      }
    
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
    <link href="Vistas/css/estilos.css" type="text/css" >

  </head>
  <body style="background-image: url(&quot;http://localhost/TP_Programa/images/fondoHome.jpg&quot;);">

    <?php require("headerCliente.php"); ?>

    <div class="container" >
      <div class="row">
        <div class="col-lg-12">
          <!-- aca se comienzan a listar los productos -->                
                <div class="card-deck">
                  <?php 
                    foreach ($producto as $key => $value) {  ?>
                      <div class="p-4 align-self-center col-md-4" > 
                        <div class="card bg-light text-center">
                          <form action= "<?= ROOT_VIEW ?>/Pedido/agregarAlCarrito" method="post" enctype="multipart/form-data">
                            <div class="card background">

                              <img src="http://localhost/TP_Programa/<?=$value->getImagen(); ?>" class="img-responsive" style="width:100%" alt="Image ">
                            
                              <div class="card-body">
                                <h4 class="card-title"><a href=" "><?= $value->getDescripcion(); ?></a></h4>
                                <h5 class="card-subtitle" > $<?= $value->getPrecio(); ?></h5>
                                  <div class="center-block">
                                    <input type="number" name="cantidad" min="1" max="50" value="1" style="width: 3em;">                                 

                                    <button type="submit" class="fa fa-cart-plus btn-lg btn-primary "></button> 

                                    <input type="hidden" name="importe" class="form-control" value= "<?= $value->getPrecio();  ?>" >
                                    <input type="hidden" name="id" class="form-control" value="<?= $value->getId();?>" >
                                    <input type="hidden" name="descripcion" class="form-control" value="<?= $value->getDescripcion(); ?>" >
                                  </div>
                              </div>

                            </div>  
                          </form>
                        </div>
                      </div>     
                  <?php } ?>
                </div>
             
          <!-- fin listado de productos -->

        </div>
        <!-- fin del col 10 -->
          
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