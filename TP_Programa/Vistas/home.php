<?php namespace Vistas;

use \Controladoras\ControlGestionProducto as ControlGestionTipoProducto;
$DAOProductos= new ControlGestionTipoProducto();

$productos = $DAOProductos->traertodos();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Beer Recharge MDP</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
   <!-- Mi CSS -->
  <link href="css/estilos.css" type="text/css" rel="stylesheet">
</head>

<body id="top" style="background-image: url(&quot;http://localhost/TP_Programa/images/fondocheck.png&quot;);" >

  <?php require("header.php"); ?> <!-- llamado a la barra nav de home-->

   <!-- slider-->
   <section  id="slider">
      <div class="container">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="images/slider/cerveceria1.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/slider/cerveceria2.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/slider/cerveceria3.jpg" alt="Third slide">
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
      </div>
    </section>
      <!-- fin slider-->
  
  <!-- About Section -->
    <section class="success text-white" id="about">
      <div class="container">
        <h2 class="text-center">Nosotros</h2>
        <hr class="star-light">
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sapien magna, commodo ac arcu consectetur, porttitor maximus ligula. Praesent ac ex condimentum ligula auctor scelerisque id eu ligula. Quisque semper nisl eget cursus lacinia. Nullam nisl augue, elementum id justo vitae, accumsan vehicula dolor. Morbi quis volutpat lacus, at ullamcorper nisl. Pellentesque maximus enim est. Sed non turpis risus.</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sapien magna, commodo ac arcu consectetur, porttitor maximus ligula. Praesent ac ex condimentum ligula auctor scelerisque id eu ligula. Quisque semper nisl eget cursus lacinia. Nullam nisl augue, elementum id justo vitae, accumsan vehicula dolor. Morbi quis volutpat lacus, at ullamcorper nisl. Pellentesque maximus enim est. Sed non turpis risus.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- Fin About Section -->


  <!-- INICIO MUESTRARIO CERVEZAS    -->   
  <section class="text-white" id="prod"> 
      <div class="container">    
          <h2 class="text-center">Nuestros Productos</h2>
          <hr class="star-primary">
           <div class="row">
           
              <?php
              foreach ($productos as $valor) 
              { ?>      
               

                <div class="p-4 align-self-center col-md-4">
                  <div class="card background">
                    <img src="http://localhost/TP_Programa/<?=$valor->getImagen(); ?>" class="img-responsive" style="width:100%" alt="Image ">           
                    <div class="card-block p-2">
                      <div class="panel-body ">   

                      </div>
                      <div class="p-1 col-md-4">                
                                        
                      </div>                               
                    </div>
                  </div>
                </div>

              <?php
              }//fin FOR EACH
              ?>
          
        </div>
      </div>
  </section>
  <!-- FINMUESTRARIO CERVEZAS  --> 

  <!-- Contact Section -->
    <section class="text-white" id="contact">
      <form action="<?= ROOT_VIEW ?>/Contacto/Enviar" method="post" enctype="multipart/form-data">
          <div class="container">
          <h2 class="text-center">Contáctenos<h2>
          <hr class="star-primary">
          <div class="row">
            <div class="col-lg-8 mx-auto">
            
              <form name="sentMessage" id="contactForm" novalidate>
                <!--<div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <label>Nombre</label>
                    <input class="form-control" id="name" type="text" placeholder="Name" required data-validation-required-message="Ingrese su nombre">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <label>Dirección de Email</label>
                    <input class="form-control" id="email" type="email" placeholder="Email" required data-validation-required-message="Por favor ingrese su nombre">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <label>Número de Teléfono</label>
                    <input class="form-control" id="phone" type="tel" placeholder="Numero de Telefono" required data-validation-required-message="Por favor ingrese su numero de Telefono">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>-->
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <label>Email de respuesta:</label>
                    <input class="form-control" id="headers" name="headers" placeholder="Su email aqui" required data-validation-required-message="Por favor ingrese su Email">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <label>Asunto</label>
                    <input class="form-control" id="subject" name="subject" placeholder="Su asunto aqui" required data-validation-required-message="Por favor ingrese un asunto">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <label>Mensaje</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Su mensaje aqui" required data-validation-required-message="Por favor ingrese su mensaje"></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success btn-lg" id="sendMessageButton">Enviar</button>
                </div>
              </form>
            </div>
            <div class="col-lg-12 text-right">
              <a class="fa fa-arrow-circle-up btn-lg btn-secondary" href="#top" aria-hidden="true"></a>
            </div>
          </div>
        </div>        
      </form>      
    </section>
  <!--Fin Contact Section -->


  <?php require(ROOT . "Vistas/footer.php"); ?>


  <!-- Background transparenteL -->
  
    <style>
      div.background 
      {
        background: url(klematis.jpg) repeat;
        border: 0px ;
      }

      div.transbox 
      {
        margin: 10px;
        background-color: #ffffff;
        border: 1px solid black;
        opacity: 0.6;
        filter: alpha(opacity=60); /* For IE8 and earlier */
      }

      div.transbox p 
      {
        margin: 5%;
        font-weight: bold;
        color: #000000;
      }
    </style>
    
    <!--  -->
 

      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


      <script>
        /*
        var btn_log=$("#btn-log");

        btn_log.on("clik", function(evento){
          evento.preventDefault();

          var usr=$("#usr").val();
          var pass=$("#pass").val();

          $.ajax({
              url :"contoladora del log in",
              type:"POST",
              data: {
                lo que espera:usr,
                :pass,
              },
              beforesend:function() {
                $("#loader-container").show();
              },
              success:function(rta){

                alert(rta);
                $("#loader-container").hide();
              }
          });
        });
      */
      </script>

  </body>
</html>