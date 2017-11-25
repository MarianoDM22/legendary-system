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
  


	public function __construct()
	{
		
		$this->DAOOrden=\DAOS\PedidosDAO::getInstance();
    $this->DAOEnvio=\DAOS\EnviosDAO::getInstance();
    $this->DAOLineaDeProductos=\DAOS\LineasDePedidoDAO::getInstance();
    $this->DAOProductos=\DAOS\ProductosDAO::getInstance();
    $this->DAOTiposDeCerveza=\DAOS\TiposDeCervezasDAO::getInstance();

		
	}
	


	 public function getOrden()
    {
      try {
        return $this->$orden;
      } catch (Exception $e) {
        echo "<script>alert('Error al traer orden!'));</script>";
      }
    }

    public function index()
   	{
      try
      {
        //$lineasDePedido=$this->DAOLineaDeProductos->
        $InstanciaTiposCervezas=$this->DAOTiposDeCerveza;
        $productos=$this->DAOProductos->traerTodos();
        $envios=$this->DAOEnvio->traerTodos();//trae todos los envios de la BD
   		 $orden=$this->DAOOrden->traerTodos();//trae todos los pedidos de la BD
       
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

   	public function borrar($id)
   	{
      try {
   		 $this->DAOOrden->borrar($id);
      } catch (Exception $e) {
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




}
?>