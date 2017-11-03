<?php namespace DAOS;


use Exception;

session_start();

class ListaProducto extends SingletonAbstractDAO implements IDAO //todos los Dao van a tener que extender singleton e implementar la IDAO
{
	//definicion de la lista
	private $Producto;

	public function __construct()
	{
		$this->Producto = Array();
		if(!isset($_SESSION['Producto'])){
			$_SESSION['Producto'] = $this->Producto;
		}
	}

	//implementacion del Metodo
	 public function insertar($dato)
	 {
	 	//primero llamar devolver ultimo id
	 	$id=$this->devolverUltimoId();
	 	$dato->setId($id);
	 	
	 	try
		{	
			$this->buscarProducto($dato->getDescripcion());
			array_push($_SESSION['Producto'], $dato);
		}
		 catch (Exception $e)
		{   
			echo "Producto ya cargado";
    	}

	 }

	 public function buscar($dato)
	 {

	 }

	 public function borrar($dato)
	 {

	 }

	 public function actualizar($dato)
	 {
	 	
	 }

	

	 private function buscarProducto( $nombre )
	{
		if( !empty($_SESSION['Producto']) )
		{
			foreach ( $_SESSION['Producto'] as $key => $valor) 
			{
				if( strcmp($nombre, $valor->getDescripcion()) ==0 )
				{
					throw new \Exception("Producto ya cargado");
				}
			}
		}
	}

	 //function devolver ultimo id

	private function devolverUltimoId()
	{
		$rta = 0;

		if(!empty($_SESSION['Producto']))
		{
			$rta=end($_SESSION['Producto'])->getId();
		}

		return $rta + 1;
	}
}
?>