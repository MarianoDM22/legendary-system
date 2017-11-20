
<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tu carrito:</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">

           <?php
             if(isset($_SESSION['Carrito'])) 
             {
               $lineaCarrito = $_SESSION['Carrito']; ?>

              <!-- todas las lineas del pedido-->
              <table class="table table-bordered">
                <thead class="thead-inverse">
                  <tr>            
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Cantidad</th> 
                    <th>Sub Total</th>
                    <th>Opciones</th>
                  </tr>
                </thead>
                <tbody>
               
                  <?php 
                      foreach ($lineaCarrito as $key => $value) 
                      { ?>
                    
                      <tr>
                        <td>
                          <img src="<?= "../" . $value->getImagen(); ?>" width="40">
                          <?= $value->getDescripcion(); ?>    
                        </td>
                        
                        <td>$<?= $value->getPrecio(); ?></td>
                        <td> 
                          <select class="custom-select" name="qty">
                            <option> 1 </option>
                            <option> 2 </option>
                            <option> 3 </option>
                            <option> 4 </option>
                          </select>
                        </td>
                        <td>$<?= $value->getPrecioSubTotal($value); ?> </td>
                        <td>
                          <form action="<?= ROOT_VIEW ?>/ /borrar" method="POST">
                            <input type="hidden" name="id" value="<?= $value->getId(); ?>">
                            <button type="submit" class="btn btn-primary">Eliminar</button>
                          </form>
                        </td>
                      </tr>  
                      
                  <?php } ?>     
                </tbody>  
              </table>                    
          </div>
          <div class="modal-footer">
            <div class="container">
              <div class="row">
                <div class="col-md-8 text-right">
                  <h6>Total: $ $<?= $value->getPrecioTotal(); ?></h6>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-right">
                  <div class="center-block">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Update</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="<?= ROOT_VIEW ?>/Pedido/checkOut">CheckOut</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?><!-- Fin sessionl-->

          
          <?php
          if( !isset($_SESSION['Carrito']) ){?>
            <p>No hay productos en su carrito!</p>
          <?php } ?>