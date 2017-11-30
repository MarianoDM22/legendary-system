<?php namespace Controladoras;



use Modelos\Sucursal as Sucursal;
use Exception as Exception;
use PDOException as PDOException;



class ControlGestionOrden
{
	private $DAOOrden;
  private $DAOEnvio;
  private $DAOLineaDeProductos;
  private $DAOProductos;
  private $DAOTiposDeCerveza;
  private $DAOCuenta;
  private $DAOSucursales;
  


	public function __construct()
	{
		
		$this->DAOOrden=\DAOS\PedidosDAO::getInstance();
    $this->DAOEnvio=\DAOS\EnviosDAO::getInstance();
    $this->DAOLineaDeProductos=\DAOS\LineasDePedidoDAO::getInstance();
    $this->DAOProductos=\DAOS\ProductosDAO::getInstance();
    $this->DAOTiposDeCerveza=\DAOS\TiposDeCervezasDAO::getInstance();
    $this->DAOCuenta=\DAOS\CuentasDAO::getInstance();
    $this->DAOSucursales=\DAOS\SucursalesDAO::getInstance();

		
	}
	


	 public function getOrden()
    {
      try {
        return $this->$orden;
      } catch (Exception $e) {
        echo "<script>alert('Error al traer orden!'));</script>";
      }
    }

    public function index($estado)
   	{
      if($estado!="Buscar")
      {
        try
        {
          
          $InstanciaTiposCervezas=$this->DAOTiposDeCerveza;
          $productos=$this->DAOProductos->traerTodos();
          $envios=$this->DAOEnvio->traerTodos();//trae todos los envios de la BD
          $orden=$this->DAOOrden->traerTodosPorEstado($estado);//trae todos los pedidos de la BD
          $instanciaCuentas=$this->DAOCuenta;

          foreach ($orden as $key => $value) 
          {         
              
              $lineasDePedido=$this->DAOLineaDeProductos->lineasPorPedido($value->getId() );
              $value->setMLineasDePedido($lineasDePedido);                       
            
          }
         
        } 
        catch (Exception $e)
        {
          echo "<script>alert('Exception ! Error al traer todos!'));</script>";
        }
        catch (PDOException $e)
        {
          echo "<script>alert('Exception ! Error al traer todos de BD!'));</script>";
        }
        
        
        require_once(ROOT . 'Vistas/Administrador/GestionOrden.php');
      }

      else
      {
        require_once(ROOT . 'Vistas/Administrador/Buscador.php');        
      }

   	}
    
   	public function borrar($id)
   	{
      try 
      {
   		 $this->DAOOrden->borrar($id);
      } 
      catch (Exception $e) 
      {
        echo "<script>alert('Error al intentar borrar!'));</script>";
      }

   		$this->index();
   	}

   	public function traerTodos()
   	{
   		$orden= null;
   		try

   		{
   			$orden=$this->DAOOrden->traerTodos();
   		}
   		catch(PDOException $ex)
   		{
   			echo "<script> if(alert('Error en BD'));</script>";
   		}
   		catch(Exception $ex)
   		{
   			echo "<script> if(alert('Ocurrio un error!'));</script>";
   		}   		

   		return $orden;
   	}
   
    public function detalleOrden($idPedido)
    {
       try
      {

        $orden=$this->DAOOrden->buscarPorID($idPedido);//busco el pedido por su ID 
        $cliente=$this->DAOCuenta->buscarClientePorID($orden->getMCliente());//busco el cliente asociado al pedido
        $cuenta=$this->DAOCuenta->buscarCuentaPorIDCliente($cliente->getId());//busco la cuenta asociada al cliente
        $instanciaProducto=$this->DAOProductos;//le paso la instancia de la controladora producto

        $lineasDePedido=$this->DAOLineaDeProductos->lineasPorPedido($orden->getId() );//le paso id de pedido y devuelve todas las lineas de productos
        $orden->setMLineasDePedido($lineasDePedido);//asigno las lineas al pedido
       
        $envio=$this->DAOEnvio->buscarPorID($orden->getMEnvio());
        $instanciaSucursal=$this->DAOSucursales;

      }
      catch (Exception $e)
      {
        echo "<script>alert('Exception ! Error al traer todos!'));</script>";
      }
      catch (PDOException $e)
      {
        echo "<script>alert('Exception ! Error al traer todos de BD!'));</script>";
      }
 
      require_once(ROOT . 'Vistas/Administrador/DetalleOrden.php');
    }

    public function cambiarEstadoPedido($nuevoEstado,$idPedido)
    {
      $this->DAOOrden->actualizarEstado($idPedido,$nuevoEstado);
      echo "<script>alert('Estado cambiado'));</script>";

      $this->index($nuevoEstado);

      
    }

    public function finalizarCompra($idPedido)
    {
      
      $this->DAOOrden->borrar($idPedido);

      echo "<script> if(alert('Pedido Eliminado!'));</script>";
      $this->index("Solicitado");

    }

    public function buscador($email)
    {
       try
      {
        $instanciaCuentas=$this->DAOCuenta;
        $cliente=$instanciaCuentas->buscarPorNombre($email); //utilizo el email enviado para buscarlo
       

        $InstanciaTiposCervezas=$this->DAOTiposDeCerveza;
        $productos=$this->DAOProductos->traerTodos();
        $envios=$this->DAOEnvio->traerTodos();//trae todos los envios de la BD

        try
        {
          $orden=$this->DAOOrden->pedidosPorCliente($cliente->getId()-1);//trae todos los pedidos del cliente de la BD
        }
        catch (Exception $e)
        {
          echo "<script>alert('Exception ! El Email no se encuentra en la base de datos!'));</script>";
        }
        catch (PDOException $e)
        {
          echo "<script>alert('Exception ! El Email no se encuentra en la base de datos!'));</script>";
        }

        foreach ($orden as $key => $value) 
        {         
            
            $lineasDePedido=$this->DAOLineaDeProductos->lineasPorPedido($value->getId() );
            $value->setMLineasDePedido($lineasDePedido);                       
          
        }
       
      } 
      catch (Exception $e)
      {
        echo "<script>alert('Exception ! Error al traer todos!'));</script>";
      }
      catch (PDOException $e)
      {
        echo "<script>alert('Exception ! Error al traer todos de BD!'));</script>";
      }

      require_once(ROOT . 'Vistas/Administrador/Buscador.php');
    }

}
?>