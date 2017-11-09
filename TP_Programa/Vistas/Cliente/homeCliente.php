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
    <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Mi CSS -->
    <link href="css/estilos.css" type="text/css" rel="stylesheet">

  </head>
  <body>

    <?php require("headerCliente.php"); ?>

    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-2">

          <h1 class="my-4">Categorias</h1>

          <div class="list-group">
            <a href= "" class="list-group-item">Categoria 1</a>
            <a href=" " class="list-group-item">Categoria 2</a>
            <a href=" " class="list-group-item">Categoria 3</a>
          </div>

        </div>

        <div class="col-lg-10">
        
        <!-- slider-->
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="../images/slider/cerveceria1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="../images/slider/cerveceria2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="../images/slider/cerveceria3.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Siguiente</span>
            </a>
          </div>
         <!-- fin slider-->


          <!-- aca se comienzan a listar los productos -->            
              
                <div class="card-deck">
                  <?php 
                    foreach ($producto as $key => $value) {  ?>
                      <div class="p-4 align-self-center col-md-4"> 
                        <div class="card bg-light text-center">
                          <form action= "<?= ROOT_VIEW ?> /" method="post" enctype="multipart/form-data" class="addToCart">
                            <a href=""><img src="<?= "../" . $value->getImagen(); ?>" width="50"></a>
                              <div class="card-body">
                                  <h4 class="card-title" name="descripcion"><a href=" "><?= $value->getDescripcion(); ?></a></h4>
                                  <h5 class="card-subtitle" name="precio"> $<?= $value->getPrecio(); ?></h5>
                                  <div class="center-block">
                                    <select class="custom-select" name="qty">
                                      <option> 1 </option>
                                      <option> 2 </option>
                                      <option> 3 </option>
                                      <option> 4 </option>
                                    </select>
                                    <input class="btn btn-primary" name="botonAgregar" type="submit" value="Agregar">
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