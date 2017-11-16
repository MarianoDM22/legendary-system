<?php namespace Vistas;

use \Controladoras\ControlGestionProducto as ControlGestionTipoProducto;
$DAOProductos= new ControlGestionTipoProducto();
$productos = $DAOProductos->traertodos();
$_SESSION['prod']=$productos;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title></title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
   <!-- Mi CSS -->
  <link href="css/estilos.css" type="text/css" rel="stylesheet">


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




</head>

<body>


  <!-- INICIO HEADER  -->
  <nav class="navbar navbar-expand-md bg-primary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href=""><i class="fa d-inline fa-lg fa-cloud"></i><b>&nbsp;Beer Recharge MDP</b></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa d-inline fa-lg fa-bookmark-o"></i> Contactenos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href= "<?= ROOT_VIEW ?>/Login/cerrarSesion"><i class="fa d-inline fa-lg fa-envelope-o"></i>&nbsp;LogOut</a>
          </li>
        </ul>
        <a class="btn navbar-btn ml-2 text-white btn-secondary" data-toggle="modal" data-target="#loginModal">
        <i class="fa d-inline fa-lg fa-user-circle-o"></i>&nbsp; Iniciar Sesion</a>
      </div>
    </div>
  </nav><!-- fin header  -->




  <!-- INICIO MUESTRARIO CERVEZAS    -->
   
  <div class="p-5 bg-primary opaque-overlay" style="background-image: url(&quot;http://localhost/TP_Programa/images/fondoHome.jpg&quot;);">
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
                      <select>
                        <option value="volvo"> <?= $valor->getDescripcion();?> <?=$valor->getCapacidad(); ?> Litros</option>
                      </select>                  
                    </div>               
              <a href="#" class="btn btn-dark">Agregar al carrito</a>
            </div>
          </div>
        </div>

      <?php
      }//fin FOR EACH
      ?>
      </div>
    </div>
  </div>

  <!-- FINMUESTRARIO CERVEZAS  --> 


  <?php require(ROOT . "Vistas/footer.php"); ?>


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
          <form action="<?= ROOT_VIEW ?> /Login/nuevo" method="post" enctype="multipart/form-data">
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
                    <input class="form-control" id="InputName" name="nombre" type="text" aria-describedby="nameHelp" placeholder="Ingrese su nombre" required>
                  </div>
                  <div class="col-md-6">
                    <label for="InputLastName">Apellido</label>
                    <input class="form-control" id="InputLastName" name="apellido" type="text" aria-describedby="nameHelp" placeholder="Ingrese su apellido" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="InputAddress">Domicilio</label>
                    <input class="form-control" id="InputAddress" name="domicilio" type="text" aria-describedby="nameHelp" placeholder="Ingrese su domicilio" required>
                  </div>
                  <div class="col-md-6">
                    <label for="InputTel">Teléfono</label>
                    <input class="form-control" id="InputTel" name="telefono" type="text" aria-describedby="nameHelp" placeholder="Ingrese su teléfono" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="InputEmail1">Direccion de Email</label>
                <input class="form-control" id="InputEmail1" name="email" type="email" aria-describedby="emailHelp" placeholder="Correo electrónico" required>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="InputPassword1">Contraseña</label>
                    <input class="form-control" id="InputPassword1" name="pass1" type="password" placeholder="Password" required>
                  </div>
                  <div class="col-md-6">
                    <label for="ConfirmPassword">Confirme su Contraseña</label>
                    <input class="form-control" id="ConfirmPassword" name="pass2" type="password" placeholder="Confirme password" required>
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
      */
      </script>

  </body>
</html>