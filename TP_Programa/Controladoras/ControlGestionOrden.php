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
        return $this->$orden;
    }

    public function index()
   	{
   		$orden=$this->traerTodos();
   		
   		
   		require_once(ROOT . 'Vistas/Administrador/GestionOrden.php');
   	}

   	public function borrar($id)
   	{
   		$this->DAOOrden->borrar($id);

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