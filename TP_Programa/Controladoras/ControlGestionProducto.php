<?php namespace Controladoras;



use Modelos\Producto as Producto;



class ControlGestionProducto
{
	private $DAOProducto;

	public function __construct()
	{
		//$this->DAOProducto=\DAOS\listaProducto::getInstance();
		$this->DAOProducto=\DAOS\ProductosDAO::getInstance(); //cuando pasemos a BD
	}
	

	public function nuevo( )
	{
		
		$imageDirectory = 'images/';

		if(!file_exists($imageDirectory))
		mkdir($imageDirectory);

		$desc=$_POST['descripcion'];
		$tipo_cerveza=$_POST ['TipoCerveza'];
		$capacidad=$_POST['capacidad'];
		$factor=$_POST['factor'];		
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
        return $this->$ProductoDAO;
    }

    public function index()
   	{
   	
   		$producto=$this->traerTodos();
   		
   		require_once(ROOT . 'Vistas/Administrador/GestionProducto.php');
   	}

   	public function borrar()
   	{
   		$this->DAOProducto->borrar($_POST['id']);
   		$this->index();
   	}

   	public function traerTodos()
   	{
   		new \DAOS\TiposDeCervezasDAO();
   		$producto= array();
   		$producto =$this->DAOProducto->traerTodos();

   		return $producto;
   	}

   	public function modificar()
   	{
   		$imageDirectory = 'images/';

		if(!file_exists($imageDirectory))
		mkdir($imageDirectory);

		$desc=$_POST['descripcion'];
		$tipo_cerveza=$_POST ['TipoCerveza'];
		$capacidad=$_POST['capacidad'];
		$factor=$_POST['factor'];
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
					   		//$object->setPrecio($factor);
					   		$object->setImagen($imagen);

					   		//LLAMA A ACTUALIZAR
							$buscado=$this->DAOProducto->buscarPorNombre($desc);
	    				

	    					if ($buscado==null)
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
}
?>