<?php namespace Vistas;
/*
use \Controladoras\ControlGestionSucursal as ControlGestionSucursal;
$DAOSucursal= new ControlGestionSucursal();
$sucursales = $DAOSucursal->traertodos();// agarro todas las sucursales de la BD, para luego crear los marcadores en el mapa
*/
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
    <link rel="stylesheet" href="css/estilos.css" type="text/css" >

    <!-- Google Maps Key y URL -->
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyA8zxt5WxVz1tas7WyeLebU0d2gyL4DYOs" type="text/javascript"></script>     
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8zxt5WxVz1tas7WyeLebU0d2gyL4DYOs&callback=initMap">
    </script> 

  </head>
  <body>

  <!-- Funcion Google Maps-->
    <script>
    
      function initMap() {
        var uluru = {lat: -38, lng: -57.55};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: uluru,
        });
        //PRIMER MARCADOR SUCURSAL 1
        
        /*
        for (var i = 0, l=<?php $sucursales ?>.length; i < l; i++) //recorrer el array $sucursales y crear un marcador en el mapa por cada iteracion
        {
          
          var nuevo{lat: '-'+n, lng: -11};//hay qe concatenarle el "-"antes de latitud y longitud, ya que en BD se guarda sin el guion
          var marker = new google.maps.Marker({

            position: nuevo,
            map: map,
            title: 'BeerRecharge MDP Sucursal 1'
          });
        } 
        */

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

  <!-- Footer -->
  <footer class="footer bg-dark footer-pos tbody" id="footer-pos" >
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
        <div class="row">
          <div class="col-md-12 text-center align-self-center">
            <small>Copyright © UTN 2017</small>
          </div>
        </div>
      </div>
    </div>
  </footer>  
  <!-- fin Footer -->
<style>
  #footer-pos { position:absolute;  width:100%; height:60px; background:#6cf; }
</style>

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>