<?php namespace Controladoras;



use Modelos\Producto as Producto;
use Exception as Exception;



class ControlGestionProducto
{
	private $DAOProducto;
	private $DAOTipoCerveza;

	public function __construct()
	{
		//$this->DAOProducto=\DAOS\listaProducto::getInstance();
		$this->DAOProducto=\DAOS\ProductosDAO::getInstance(); //cuando pasemos a BD
		$this->DAOTipoCerveza=\DAOS\TiposDeCervezasDAO::getInstance();
	}
	

	public function nuevo($desc, $tipo_cerveza, $capacidad, $factor, $imagen)
	{
		
		$imageDirectory = 'images/';

		if(!file_exists($imageDirectory))
		mkdir($imageDirectory);

		//$desc=$_POST['descripcion'];
		//$tipo_cerveza=$_POST ['TipoCerveza'];
		//$capacidad=$_POST['capacidad'];
		//$factor=$_POST['factor'];		
		//$imagen=$_FILES['fileToUpload'];

		if((isset($_FILES['fileToUpload'])) && ($_FILES['fileToUpload']['name'] != ''))
		{
			

			$extensionesPermitidas= array('png', 'jpg', 'gif');
			$tamanioMaximo= 5000000;
			$nombreArchivo= basename($_FILES['fileToUpload']['name']);

			$file = $imageDirectory . $nombreArchivo;	//la direccion del archivo		

			//Obtenemos la extensión del archivo. No sirve para comprobar el verdadero tipo del archivo
			$fileExtension = pathinfo($file, PATHINFO_EXTENSION);

			if(in_array($fileExtension, $extensionesPermitidas))
			{

					if($_FILES['fileToUpload']['size'] < $tamanioMaximo)
					{ //Menor a 5 MB
					
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file))
						{	//guarda el archivo subido en el directorio 'images/' tomando true si lo subio, y false si no lo hizo
							$imagen = str_replace("../", "", $file); 
							//crea el objeto
	    					$value = new Producto($desc, $tipo_cerveza, $capacidad, $factor, $imagen);

	    					$value->setPrecio($this->calcularPrecio($value));//le seteo el precio antes de insertarlo


	    					//llama al DAO para insertarlo
	    					$buscado=$this->DAOProducto->buscarPorNombre($desc);
	    				

	    					if ($buscado==null)
	    					{	
	    						
	    						$this->DAOProducto->insertar($value);
	    						//echo "<script> if(alert('Nuevo Producto ingresado!'));</script>";
	    					}
	    					else
	    					{
	    						echo "<script> if(alert('Producto existente!'));</script>";
	    						
	    					}
							
							
							$this->index();
							
							

						}
						else
							echo "<script> if(alert('No se pudo subir el archivo!'));</script>";
					}
					else
						echo "<script> if(alert('El archivo es demasiado grande!'));</script>";
			}
			else
				echo "<script> if(alert('No es imagen!'));</script>";
		}
		else
		{
			
			$this->index();
			
		}					
		
	}

	 public function getProducto()
    {
        return $this->$producto;
    }

    public function index()
   	{
   		$producto=$this->traerTodos();
   		$cervezas=$this->traerTodosCervezas();
   		if ($producto != null)
   		{
   			$this->calcularTodosPrecio($producto);
   		}		
   		
   		
   		require_once(ROOT . 'Vistas/Administrador/GestionProducto.php');
   	}

   	public function borrar($id)
   	{
   		$this->DAOProducto->borrar($id);
   		$this->index();
   	}

   	public function traerTodos()
   	{
   		$producto= array();
   		$producto=$this->DAOProducto->traerTodos();

   		return $producto;
   	}

   	public function traerTodosCervezas()
   	{
   		$cervezas= array();
   		$cervezas=$this->DAOTipoCerveza->traerTodos();
 
   		return $cervezas;
   	}


   	public function modificar($desc, $tipo_cerveza, $capacidad, $factor, $imagen)
   	{

   		$imageDirectory = 'images/';

		if(!file_exists($imageDirectory))
		mkdir($imageDirectory);

		//$desc=$_POST['descripcion'];
		//$tipo_cerveza=$_POST ['TipoCerveza'];
		//$capacidad=$_POST['capacidad'];
		//$factor=$_POST['factor'];
		//$imagen=$_FILES['fileToUpload'];

		if((isset($_FILES['fileToUpload'])) && ($_FILES['fileToUpload']['name'] != ''))
		{
			

			$extensionesPermitidas= array('png', 'jpg', 'gif');
			$tamanioMaximo= 5000000;
			$nombreArchivo= basename($_FILES['fileToUpload']['name']);

			$file = $imageDirectory . $nombreArchivo;	//la direccion del archivo		

			//Obtenemos la extensión del archivo. No sirve para comprobar el verdadero tipo del archivo
			$fileExtension = pathinfo($file, PATHINFO_EXTENSION);

			if(in_array($fileExtension, $extensionesPermitidas))
			{

					if($_FILES['fileToUpload']['size'] < $tamanioMaximo)
					{ //Menor a 5 MB
					
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file))
						{	//guarda el archivo subido en el directorio 'images/' tomando true si lo subio, y false si no lo hizo
							$imagen = str_replace("../", "", $file); 
							//crea el objeto
	    					$object = $this->DAOProducto->buscarPorID($_POST['id']);
	    					
	    					$object->setDescripcion($desc);
					   		$object->setMTiposDeCerveza($tipo_cerveza);
					   		$object->setCapacidad($capacidad);
					   		$object->setFactor($factor);
					   		$object->setPrecio($this->calcularPrecio($object));//le seteo el precio 
					   		$object->setImagen($imagen);

					   		//LLAMA A ACTUALIZAR
							$buscado=$this->DAOProducto->buscarPorID($_POST['id']);    				

	    					if ($buscado!=null)
	    					{	
	    						$this->DAOProducto->actualizar($object);
	    						//echo "<script> if(alert('Producto modificado!'));</script>";
	    					}
	    					else
	    					{
								echo "<script> if(alert('Producto existente!'));</script>";
								
	    					}
							
							
							$this->index();

						}
						else
							echo "<script> if(alert('No se pudo subir el archivo!'));</script>";
					}
					else
						echo "<script> if(alert('El archivo es demasiado grande!'));</script>";
			}
			else
				echo "<script> if(alert('No es imagen!'));</script>";
		}

		else
		{
			
			$this->index();
			
			
		}					
		
   	}

   	public function calcularTodosPrecio($producto)
   	{
   		foreach ($producto as $key) 
   		{
   			$key->setPrecio($this->calcularPrecio($key));
   		}	
   	}

   	public function calcularPrecio($obj)// calcula un solo precio
   	{
   		$precio= 0;
  		
   			$x= $this->DAOTipoCerveza->buscarPorID($obj->getMTiposDeCerveza())->getPrecio_litro();
   			$precio=(  ($obj->getCapacidad() ) * $x * ($obj->getFactor())  );

	   		//$obj->setPrecio($precio);

	   	return $precio;
   	}
}
?>