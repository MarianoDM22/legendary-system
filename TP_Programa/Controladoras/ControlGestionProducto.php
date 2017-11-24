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
							  try {
	    						$this->DAOProducto->insertar($value);
						      } catch (Exception $e) {
						        echo "<script>alert('Error al insertar Producto en BBDD!'));</script>";
						      }
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
    	try {
        	return $this->$producto;
      	} catch (Exception $e) {
        	echo "<script>alert('Error al traer producto de la BBDD!'));</script>";
      	}
    }

    public function index()
   	{
   		try {
   		$producto=$this->traerTodos();
   		$cervezas=$this->traerTodosCervezas();
   		
   		$instanciaCerveza=$this->DAOTipoCerveza;
   		
   		if ($producto != null)
   		{
   			$this->calcularTodosPrecio($producto);
   		}		
	    } catch (Exception $e) {
	    	echo "<script>alert('Error en BBDD!'));</script>";
	    }
   		
   		
   		require_once(ROOT . 'Vistas/Administrador/GestionProducto.php');
   	}

   	public function borrar($id)
   	{
   		try {
   		$this->DAOProducto->borrar($id);
   		$this->index();
	    } catch (Exception $e) {
	    	echo "<script>alert('Error al borrar en BBDD'));</script>";
	    }
   	}

   	public function traerTodos()
   	{
   		$producto = null;
   		try {
	   		$producto= array();
	   		$producto=$this->DAOProducto->traerTodos();
	    } catch (Exception $e) {
	    	echo "<script>alert(''));</script>";
	    }

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
	    						try {
	    							$this->DAOProducto->actualizar($object);
							    } catch (Exception $e) {
							    	echo "<script>alert('Error al actualizar producto en BBDD!'));</script>";
							    }
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
  		
  		try {
   			$x= $this->DAOTipoCerveza->buscarPorID($obj->getMTiposDeCerveza())->getPrecio_litro();
   			$precio=(  ($obj->getCapacidad() ) * $x * ($obj->getFactor())  );
	    } catch (Exception $e) {
	    	echo "<script>alert('Error al calcular precio'));</script>";
	    }

	   		//$obj->setPrecio($precio);

	   	return $precio;
   	}

   	public function buscarPorID($id)
   	{
   		$prod = null;
   		try {
   			$prod=$this->DAOProducto->buscarPorID($id);
	    } catch (Exception $e) {
	    	echo "<script>alert('Error al buscar producto en BBDD!'));</script>";
	    }

   		return $prod;
   	}
}
?>