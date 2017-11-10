<?php namespace Controladoras;



use Modelos\TiposDeCerveza as TiposDeCerveza;



class ControlGestionTipoCerveza
{
	private $DAOTipoCerveza;

	public function __construct()
	{
		//$this->DAOTipoCerveza=\DAOS\listaTipoCerveza::getInstance();
		$this->DAOTipoCerveza=\DAOS\TiposDeCervezasDAO::getInstance(); //cuando pasemos a BD
	}
	

	public function nuevo($desc, $precio, $imagen)
	{
		
		$imageDirectory = 'images/';

		if(!file_exists($imageDirectory))
		mkdir($imageDirectory);

		//$desc =$_POST['descripcion'];
		//$precio=$_POST ['precio'];
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
	    					$value = new TiposDeCerveza($desc, $precio, $imagen);
	    					
	    					//llama al DAO para insertarlo
	    					
	    				
	 
	    					$buscado=$this->DAOTipoCerveza->buscarPorNombre($desc);
	    				

	    					if ($buscado==null)
	    					{	
	    						
	    						$this->DAOTipoCerveza->insertar($value);
	    						//echo "<script> if(alert('Nuevo Tipo de Cerveza ingresado!'));</script>";

	    					}
	    					else
	    					{
								echo "<script> if(alert('Cerveza existente!'));</script>";

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

	 public function getTipoDeCerveza()
    {
        return $this->$TiposDeCervezaDAO;
    }

    public function index()
   	{
   		$cervezas = $this->traertodos();
   		require_once(ROOT . 'Vistas/Administrador/GestionTipoCerveza.php');
   	}

   	public function borrar($id)
   	{
   		$this->DAOTipoCerveza->borrar($id);
   		$this->index();
   	}

   	public function traertodos()
   	{

   		$cervezas= array();
   		$cervezas =$this->DAOTipoCerveza->traerTodos();

		return $cervezas;  
   	}

   	public function modificar($desc, $precio, $imagen)
   	{
   		$imageDirectory = 'images/';

		if(!file_exists($imageDirectory))
		mkdir($imageDirectory);

		//$desc =$_POST['descripcion'];
		//$precio=$_POST ['precio'];
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
	    					$object = $this->DAOTipoCerveza->buscarPorID($_POST['id']);
					   		$object->setDescripcion($desc);
					   		$object->setPrecio_litro($precio);
					   		$object->setImagen($imagen);

					   		//LLAMA A ACTUALIZAR
							$buscado=$this->DAOTipoCerveza->buscarPorID($_POST['id']);
	    				

	    					if ($buscado!=null)
	    					{	
	    						$this->DAOTipoCerveza->actualizar($object);
	    						//echo "<script> if(alert('Tipo de Cerveza modificado!'));</script>";
	    					}
	    					else
	    					{
								echo "<script> if(alert('Cerveza existente!'));</script>";
								
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