<?php namespace DAOS;

require_once 'SingletonAbstractDAO.php';
require_once 'IDAO.php';

use Exception;

session_start();

class ListaTipoCerveza extends SingletonAbstractDAO implements IDAO //todos los Dao van a tener que extender singleton e implementar la IDAO
{
	//definicion de la lista
	private $TipoCerveza;

	public function __construct()
	{
		$this->TipoCerveza = Array();
		if(!isset($_SESSION['TipoCerveza'])){
			$_SESSION['TipoCerveza'] = $this->TipoCerveza;
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
			$this->buscarCerveza($dato->getDescripcion());
			array_push($_SESSION['TipoCerveza'], $dato);
		}
		 catch (Exception $e)
		{   
			echo "Cerveza ya cargada";
    	}

	 }

	 public function buscar($dato)
	 {
	 	$flag=null;

	 	if( !empty($_SESSION['TipoCerveza']) )
		{
			foreach ( $_SESSION['TipoCerveza'] as $key => $value) 
			{
				if( strcmp($dato, $value->getId())==0 )
				{
					$flag=$value;
				}
			}
		}
		return $flag;
	 }

	 public function borrar($dato)
	 {
	 	$cerveza=null;

		$cerveza=$this->buscar($dato);
		array_pop($_SESSION['TipoCerveza'], $cerveza);
		
	 }

	 public function actualizar($dato)
	 {
	 	$cerveza=null;

		$cerveza=$this->buscar($dato);
		if($cerveza!=null)
			{
				
			}	
	 }

	

	 private function buscarCerveza( $nombre )
	{
		if( !empty($_SESSION['TipoCerveza']) )
		{
			foreach ( $_SESSION['TipoCerveza'] as $key => $value) 
			{
				if( strcmp($nombre, $value->getDescripcion()) ==0 )
				{
					throw new \Exception("Cerveza ya cargada");
				}
			}
		}
	}

	 //function devolver ultimo id

	private function devolverUltimoId()
	{
		$rta = 0;

		if(!empty($_SESSION['TipoCerveza']))
		{
			$rta=end($_SESSION['TipoCerveza'])->getId();
		}

		return $rta + 1;
	}
}
?>