<?php namespace Controladoras;



use Modelos\Sucursal as Sucursal;
use Exception as Exception;



class ControlGestionSucursal
{
	private $DAOSucursal;


	public function __construct()
	{
		
		$this->DAOSucursal=\DAOS\SucursalesDAO::getInstance(); 
		
	}
	

	public function nuevo($nombre, $domicilio, $latitud, $longitud)
	{
	    $value = new Sucursal($nombre, $domicilio, $latitud, $longitud);


	    //llama al DAO para insertarlo
	   	$buscado=$this->DAOSucursal->buscarPorNombre($nombre);
	    				

	    if ($buscado==null)
	    	{	
	    		try {
	    			$this->DAOSucursal->insertar($value);	
			    } catch (Exception $e) {
			    	echo "<script>alert('Error al intentar insertar Sucursal en BBDD'));</script>";
			    }	
	    		//echo "<script> if(alert('Nuevo Sucursal ingresado!'));</script>";
	    	}
	    else
	    	{
	    	echo "<script> if(alert('Sucursal existente!'));</script>";					
	    	}
							
		$this->index();	
	}

	 public function getSucursal()
    {
        return $this->$sucursal;
    }

    public function index()
   	{
   		$sucursal=$this->traerTodos();
   		
   		
   		require_once(ROOT . 'Vistas/Administrador/GestionSucursales.php');
   	}

   	public function borrar($id)
   	{
   		try {
   			$this->DAOSucursal->borrar($id);
	    } catch (Exception $e) {
	    	echo "<script>alert('Error en BBDD al intentar borrar Sucursal'));</script>";
	    }
   		$this->index();
   	}

   	public function traerTodos()
   	{
   		$sucursal= null;
   		try
   		{
   			$sucursal=$this->DAOSucursal->traerTodos();
   		}
   		catch(PDOException $ex)
   		{
   			echo "<script> if(alert('Error en BD'));</script>";
   		}
   		catch(Exception $ex)
   		{
   			echo "<script> if(alert('Ocurrio un error!'));</script>";
   		}   		

   		return $sucursal;
   	}


   	public function modificar($nombre, $domicilio, $latitud, $longitud)
   	{

	    $object=$this->DAOSucursal->buscarPorID($_POST['id']);
	    		
	    $object->setNombre($nombre);			
	    $object->setDomicilio($domicilio);
		$object->setLatitud($latitud);
		$object->setLongitud($longitud);
			
		//LLAMA A ACTUALIZAR
		try {
			$buscado=$this->DAOSucursal->buscarPorID($_POST['id']);    				
	    } catch (Exception $e) {
	    	echo "<script>alert('Error buscando Sucursal en BBDD'));</script>";
	    }

	    if ($buscado!=null)
	    	{	
	    		try {
	    			$this->DAOSucursal->actualizar($object);
			    } catch (Exception $e) {
			    	echo "<script>alert('Error al intentar actualizar sucursal en BBDD!'));</script>";
			    }
	    		//echo "<script> if(alert('Sucursal modificado!'));</script>";
	    	}
	    else
	    	{
				echo "<script> if(alert('Sucursal existente!'));</script>";
								
	    	}
							
							
			$this->index();						
   	}

}
?>