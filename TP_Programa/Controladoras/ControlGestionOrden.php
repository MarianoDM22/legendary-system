<?php namespace Controladoras;



use Modelos\Sucursal as Sucursal;
use Exception as Exception;



class ControlGestionOrden
{
	private $DAOOrden;


	public function __construct()
	{
		
		$this->DAOOrden=\DAOS\PedidosDAO::getInstance(); 
		
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
      try {
   		 $orden=$this->traerTodos();
      } catch (Exception $e) {
        echo "<script>alert('Error al traer todos!'));</script>";
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