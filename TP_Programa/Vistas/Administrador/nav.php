<?php namespace Administrador;


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
  	<nav class="navbar navbar-expand-lg navbar-dark flex-column flex-md-row bd-navbar bg-primary">
      <a class="navbar-brand" href="#"><img src="" width="30" height="30" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Ordenes
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#"> Solicitado</a>
              <a class="dropdown-item" href="#">Procesando</a>
              <a class="dropdown-item" href="#">Enviado</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Finalizado</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ROOT_VIEW ?>/GestionTipoCerveza/index">Gestion Cervezas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= ROOT_VIEW ?>/GestionProducto/index">Gestion Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sucursales</a>
          </li>
        </ul>
      </div>

        <div>
          <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
             <li class="nav-item justify-content-end">
              <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                <a class="nav-link" href="<?= ROOT_VIEW ?>/Login/cerrarSesion">LogOut</a>
            </li>
          </ul>
        </div> 
      
    </nav>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cerrar Seción?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Selecione "Logout" si está listo para finalizar su seción.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="<?= ROOT_VIEW ?>/Home/index">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Logout Modal-->




      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>