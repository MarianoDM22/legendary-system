<?php namespace Vistas;


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
     <!-- Mi CSS -->
    <link href="css/estilos.css" type="text/css" rel="stylesheet">

  </head>
  <body>

         <!-- INICIO HEADER  -->
    <nav class="navbar navbar-expand-md bg-primary navbar-dark" >
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
  
  </body>
</html>