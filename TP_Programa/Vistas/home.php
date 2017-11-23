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

<body id="top" style="background-image: url(&quot;http://localhost/TP_Programa/images/fondoHome.jpg&quot;);" >

  <?php require("header.php"); ?> <!-- llamado a la barra nav de home-->
  
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
    <div>
      <div class="container">
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
    </div>
  </section>
  <!-- FINMUESTRARIO CERVEZAS  --> 

  <!-- Contact Section -->
    <section class="text-white" id="contact">
      <div class="container">
        <h2 class="text-center">Contáctanos<h2>
        <hr class="star-primary">
        <div class="row">
          <div class="col-lg-8 mx-auto">
          
            <form name="sentMessage" id="contactForm" novalidate>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Nombre</label>
                  <input class="form-control" id="name" type="text" placeholder="Name" required data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Dirección de Email</label>
                  <input class="form-control" id="email" type="email" placeholder="Email Address" required data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Número de Teléfono</label>
                  <input class="form-control" id="phone" type="tel" placeholder="Phone Number" required data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Mensage</label>
                  <textarea class="form-control" id="message" rows="5" placeholder="Message" required data-validation-required-message="Please enter a message."></textarea>
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
        </div>
      </div>
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