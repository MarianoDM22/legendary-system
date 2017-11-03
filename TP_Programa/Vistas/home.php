<?php namespace Vistas;


 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- No viene de bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>BeerRecharge</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Font Awesome-->
    <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <!-- Mi CSS -->
    <link href="css/estilos.css" type="text/css" rel="stylesheet">

    <!-- Google Maps Key y URL -->
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyA8zxt5WxVz1tas7WyeLebU0d2gyL4DYOs" type="text/javascript"></script>     
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8zxt5WxVz1tas7WyeLebU0d2gyL4DYOs&callback=initMap">
    </script> 
    

  </head>

  <body id="page-top">

    <!-- Funcion Google Maps-->
    <script>
    
      function initMap() {
        var uluru = {lat: -38, lng: -57.55};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: uluru,
        });
        //PRIMER MARCADOR SUCURSAL 1
        
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          title: 'BeerRecharge MDP Sucursal 1'
        });
        
        //SEGUNDO MARCADOR SUCURSAL 2

        var marker2 = new google.maps.Marker({
          position: {lat: -38.01433842017485, lng: -57.54189133644104},
          map: map,
          title: 'BeerRecharge MDP Sucursal 2'
        });
      }
      
    </script>

    <?php //var_dump($_SESSION['Login']);


     ?>

        <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark flex-column flex-md-row bd-navbar bg-primary" id="mainNav">
      <div class="container">

        <a class="navbar-brand js-scroll-trigger" href="#page-top">BeerRecharge</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <!--
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
            </li>
          -->
            <li class="nav-item">
              <a class="nav-link" href="<?= ROOT_VIEW ?>/GestionTipoCerveza/index">Admin</a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="<?= ROOT_VIEW ?>/HomeCliente/index">Cliente</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= ROOT_VIEW ?>/Login/cerrarSesion">LogOut</a>
            </li>
          </ul>

          <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
            <li class="nav-item justify-content-end">
              <a class="nav-link" data-toggle="modal" data-target="#loginModal">
                <i class="fa fa-fw fa-sign-in"></i>LogIn/Regístrese</a>
            </li>
          </ul>

        </div>
      </div>

    </nav>


    


     <!-- About Section -->
    <section class="success" id="about">
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


        <!-- Contact Section -->
 <!--
    <section id="contact">
      <div class="container">
        <h2 class="text-center">Contáctanos/h2>
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

-->




 <!-- Google Maps -->
 <div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="center-block">
        <div id="map" style="width:600px; height:250px" >     </div> 
      </div>
    </div>
  </div>
</div>

   <!-- Login Modal-->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= ROOT_VIEW ?>/Login/verificarSesion" method="post" enctype="multipart/form-data"><!--SE ENVIA EL FORMULARIO A LA CONTROLADORA -->

            <div class="modal-header">
              <h5 class="modal-title">LogIn</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                  <label for="InputEmail">Direccion de Email</label>
                  <input class="form-control" id="InputEmail" type="email" name=email aria-describedby="emailHelp" placeholder="Correo electrónico">
                </div>
                <div class="form-group">
                  <label for="InputPassword">Contraseña</label>
                  <input class="form-control" id="InputPassword" name="passLogin" type="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox"> Recordar Contraseña</label>
                  </div>
                </div>

                <!-- <a class="btn btn-primary btn-block" href=" ">Login</a> --> <!-- ESTE BOTON NO ME RE DIRIGIA EL FORMULARIO A LA CONTROLADORA -->
                <input type="submit"  class="btn btn-primary btn-block" value="Login" name="upload">
            
            </div>
            <div class="modal-footer">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="text-center">

                      <a class="d-block small mt-3" id="registerLink" data-toggle="modal" data-target="#registerModal">Registra una cuenta</a>
                      <a class="d-block small mt-3" id="forgotLink" data-toggle="modal" data-target="#forgotModal">Olvidaste tu Contaseña?</a>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
    <!-- Fin Login Modal-->

  

    <!-- Register Modal-->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= ROOT_VIEW ?> /Registrar/nuevo" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title">Registre una cuenta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="InputName">Nombre</label>
                    <input class="form-control" id="InputName" name="nombre" type="text" aria-describedby="nameHelp" placeholder="Ingrese su nombre">
                  </div>
                  <div class="col-md-6">
                    <label for="InputLastName">Apellido</label>
                    <input class="form-control" id="InputLastName" name="apellido" type="text" aria-describedby="nameHelp" placeholder="Ingrese su apellido">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="InputAddress">Domicilio</label>
                    <input class="form-control" id="InputAddress" name="domicilio" type="text" aria-describedby="nameHelp" placeholder="Ingrese su domicilio">
                  </div>
                  <div class="col-md-6">
                    <label for="InputTel">Teléfono</label>
                    <input class="form-control" id="InputTel" name="telefono" type="text" aria-describedby="nameHelp" placeholder="Ingrese su teléfono">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="InputEmail1">Direccion de Email</label>
                <input class="form-control" id="InputEmail1" name="email" type="email" aria-describedby="emailHelp" placeholder="Correo electrónico">
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="InputPassword1">Contraseña</label>
                    <input class="form-control" id="InputPassword1" name="pass1" type="password" placeholder="Password">
                  </div>
                  <div class="col-md-6">
                    <label for="ConfirmPassword">Confirme su Contraseña</label>
                    <input class="form-control" id="ConfirmPassword" name="pass2" type="password" placeholder="Confirme password">
                  </div>
                </div>
              </div>
              <input type="submit"  class="btn btn-primary btn-block" value="Registrese" name="upload">
            
            </div>
            <div class="modal-footer">
               <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="text-center">

                      
                      <a class="d-block small mt-3" id="loginLink" data-toggle="modal" data-target="#loginModal">Login</a>
                       <a class="d-block small mt-3" id="forgot2Link" data-toggle="modal" data-target="#forgotModal">Olvidaste tu Contaseña?</a>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Fin Register Modal-->




    <!-- Forgot Modal-->
     <div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="<?= ROOT_VIEW ?>/Forgot/prueba" method="post" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title">Reestablecer Contraseña</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="text-center mt-4 mb-5">
                <h4>Olvidaste tu Contraseña?</h4>
                <p>Ingrese su dirección de email y te enviaremos instrucciones para que puedas reestablecer tu contraseña.</p>
              </div>

                <div class="form-group">
                  <label for="InputReEmail">Direccion de Email</label>
                  <input class="form-control" id="InputReEmail" type="email" aria-describedby="emailHelp" placeholder="Ingrese su correo electrónico">
                </div>
                
             
                <a class="btn btn-primary btn-block" href=" ">Reestablecer Contraseña</a>
            
            </div>

            <div class="modal-footer">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="text-center">

                      <a class="d-block small mt-3" id="register2Link" data-toggle="modal" data-target="#registerModal">Registra una cuenta</a>

                      <a class="d-block small mt-3" id="login2Link" data-toggle="modal" data-target="#loginModal">Login</a>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Fin Forgot Modal-->






      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

      <script>
        $(function () {
          $("#registerLink").on("click", function() 
            {
              $("#loginModal").modal("hide");
            });
          });
      </script>

      <script>
        $(function () {
          $("#forgotLink").on("click", function() 
            {
              $("#loginModal").modal("hide");
            });
          });
      </script>

      <script>
        $(function () {
          $("#loginLink").on("click", function() 
            {
              $("#registerModal").modal("hide");
            });
          });
      </script>

      <script>
        $(function () {
          $("#forgot2Link").on("click", function() 
            {
              $("#registerModal").modal("hide");
            });
          });
      </script>

      <script>
        $(function () {
          $("#register2Link").on("click", function() 
            {
              $("#forgotModal").modal("hide");
            });
          });
      </script>

      <script>
        $(function () {
          $("#login2Link").on("click", function() 
            {
              $("#forgotModal").modal("hide");
            });
          });
      </script>



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

      </script>

  </body>
</html>