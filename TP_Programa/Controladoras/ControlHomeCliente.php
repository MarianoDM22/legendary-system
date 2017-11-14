<?php namespace Controladoras;

	
	class ControlHomeCliente
	{
		private $DAOLogin;
		private $DAOProducto;
		private $DAOTipoCerveza;
		
		public function __construct() 
		{
			$this->DAOLogin=\DAOS\LoginDAO::getInstance(); //cuando pasemos a BD
			$this->DAOProducto=\DAOS\ProductosDAO::getInstance();
			$this->DAOTipoCerveza=\DAOS\TiposDeCervezasDAO::getInstance();
		}

		public function index() 
		{
			$producto=$this->traerTodos();
			
			require_once(ROOT . '/Vistas/Cliente/homeCliente.php');
			//header('Location: ../Vistas/Cliente/homeCliente.php');
		}

	  	public function traerTodos()
	   	{
	   		$producto=array();
	   		$producto=$this->DAOProducto->traerTodos();
	   		
	   		return $producto;
	   	}
	}
?>