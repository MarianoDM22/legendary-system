<?php namespace Controladoras;

	
	class ControlHomeCliente
	{
		private $DAOLogin;
		private $DAOProducto;
		private $DAOTipoCerveza;
		
		function __construct() 
		{
			$this->DAOLogin=\DAOS\LoginDAO::getInstance(); //cuando pasemos a BD
			$this->DAOProducto=\DAOS\ProductosDAO::getInstance();
			$this->DAOTipoCerveza=\DAOS\TiposDeCervezasDAO::getInstance();
		}

		function index() {
			require_once(ROOT . '/Vistas/Cliente/homeCliente.php');
		}

		
	}
?>