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
	    					
	    		$this->DAOSucursal->insertar($value);	
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
   		$this->DAOSucursal->borrar($id);
   		$this->index();
   	}

   	public function traerTodos()
   	{
   		$sucursal= array();
   		$sucursal=$this->DAOSucursal->traerTodos();

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
		$buscado=$this->DAOSucursal->buscarPorID($_POST['id']);    				

	    if ($buscado!=null)
	    	{	
	    		$this->DAOSucursal->actualizar($object);
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