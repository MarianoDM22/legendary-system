<?php




?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-beta.1.css" type="text/css"> 

  <!-- Google Maps Key y URL -->
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyA8zxt5WxVz1tas7WyeLebU0d2gyL4DYOs" type="text/javascript"></script>     
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8zxt5WxVz1tas7WyeLebU0d2gyL4DYOs&callback=initMap">
    </script> 

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
      <a class="navbar-brand" href="#"><i class="fa d-inline fa-lg fa-cloud"></i><b>&nbsp;Beer Recharge</b></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false"
        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa d-inline fa-lg fa-bookmark-o"></i> Contactenos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href= "<?= ROOT_VIEW ?>/Login/cerrarSesion"><i class="fa d-inline fa-lg fa-envelope-o"></i>&nbsp;LogOut</a>
          </li>
        </ul>
        <a class="btn navbar-btn ml-2 text-white btn-secondary" data-toggle="modal" href="#loginModal">
        <i class="fa d-inline fa-lg fa-user-circle-o"></i>&nbsp; Iniciar Sesion</a>
      </div>
    </div>
  </nav><!-- fin header  -->


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
  <!-- FIN Funcion Google Maps-->


  <!-- INICIO MUESTRARIO CERVEZAS  -->
   
  <div class="p-5 bg-primary opaque-overlay" style="background-image: url(&quot;../images/fondoHome.jpg&quot;);">
    <div class="container">
      <div class="row">

        <div class="p-4 align-self-center col-md-4">
          <div class="card background">
            <img src="../images/porter.jpg" class="img-responsive" style="width:100%" alt="Image ">
            <div class="card-block p-2">
              <div class="panel-body ">                
              </div>
                <div class="p-1 col-md-4">                
                      <select>
                        <option value="volvo">Botellon 2L</option>
                        <option value="saab">Botella 1L</option>
                        <option value="mercedes">Lata 0,473L</option>
                        <option value="audi">Barril 50L</option>
                      </select>                  
                    </div>               
              <a href="#" class="btn btn-dark">Agregar al carrito</a>
            </div>
          </div>
        </div>

        <div class="p-4 align-self-center col-md-4">
          <div class="card background">
            <img src="../images/scotch.jpg" class="img-responsive" style="width:100%" alt="Image">
            <div class="card-block p-2 ">
              <div class="panel-body">                
              </div>
                <div class="p-1 col-md-4">                
                      <select>
                        <option value="volvo">Botellon 2L</option>
                        <option value="saab">Botella 1L</option>
                        <option value="mercedes">Lata 0,473L</option>
                        <option value="audi">Barril 50L</option>
                      </select>                  
                    </div>               
              <a href="#" class="btn btn-dark">Agregar al carrito</a>
            </div>
          </div>
        </div>

        <div class="p-4 align-self-center col-md-4">
          <div class="card background">
            <div class="panel-body"><img src="../images/honey-beer.jpg" class="img-responsive" style="width:100%" alt="Image">
            <div class="card-block p-2">            
              </div>
                <div class="p-1 col-md-4">                
                    <select>
                      <option value="volvo">Botellon 2L</option>
                      <option value="saab">Botella 1L</option>
                      <option value="mercedes">Lata 0,473L</option>
                      <option value="audi">Barril 50L</option>
                    </select>                  
                  </div>                 
              <a href="#" class="btn btn-dark">Agregar al carrito</a>
            </div>
          </div>
        </div>

        <div class="p-4 align-self-center col-md-4">
          <div class="card background">
            <div class="panel-body">
              <img src="../images/porter.jpg" class="img-responsive" style="width:100%" alt="Image">
            <div class="card-block p-2">              
              </div>
                <div class="p-1 col-md-4">                
                  <select>
                    <option value="volvo">Botellon 2L</option>
                    <option value="saab">Botella 1L</option>
                    <option value="mercedes">Lata 0,473L</option>
                    <option value="audi">Barril 50L</option>
                  </select>                  
                </div>                         
              <a href="#" class="btn btn-dark">Agregar al carrito</a>
            </div>
          </div>
        </div>

        <div class="p-4 align-self-center col-md-4">
          <div class="card background">
            <div class="panel-body"><img src="../images/kolsch.jpg" class="img-responsive" style="width:100%" alt="Image">
            <div class="card-block p-2">              
              </div>
                <div class="p-1 col-md-4">                
                      <select>
                        <option value="volvo">Botellon 2L</option>
                        <option value="saab">Botella 1L</option>
                        <option value="mercedes">Lata 0,473L</option>
                        <option value="audi">Barril 50L</option>
                      </select>                  
                    </div>               
              <a href="#" class="btn btn-dark">Agregar al carrito</a>
            </div>
          </div>
        </div>

        <div class="p-4 align-self-center col-md-4">
          <div class="card background">
            <div class="panel-body"><img src="../images/barley-wine.jpg" class="img-responsive" style="width:100%" alt="Image">
            <div class="card-block p-2">              
              </div> 
                <div class="p-1 col-md-4">                
                      <select>
                        <option value="volvo">Botellon 2L</option>
                        <option value="saab">Botella 1L</option>
                        <option value="mercedes">Lata 0,473L</option>
                        <option value="audi">Barril 50L</option>
                      </select>                  
                    </div>              
              <a href="#" class="btn btn-dark">Agregar al carrito</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- FINMUESTRARIO CERVEZAS  --> 




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


  <!-- Footer -->
  <div class="py-2 bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center align-self-center">
          <p class="mb-5"> <strong>Beer Recharge </strong>
            <br>Sucursal 1: Gral. Roca 2850, Mar del PLata
            <br>Sucursal 2: Olavarria 6580, Mar del PLata            
            <br>
            <br>Seguinos!
          <div class="my-3 row">
            <div class="col-4">
              <a href="https://www.facebook.com" target="_blank"><i class="fa fa-3x fa-facebook"></i></a>
            </div>
            <div class="col-4">
              <a href="https://twitter.com" target="_blank"><i class="fa fa-3x fa-twitter"></i></a>
            </div>
            <div class="col-4">
              <a href="https://www.instagram.com" target="_blank"><i class="fa fa-3x fa-instagram"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-6 p-0">
          <div id="map" style="width:500px; height:200px"></div> 
          </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>