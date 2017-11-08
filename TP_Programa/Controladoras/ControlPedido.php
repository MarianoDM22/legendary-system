<?php namespace Controladoras;



	class ControlPedido
	{
		private $DAOPedido;

			public function __construct()
		{
			
			$this->DAOPedido=\DAOS\PedidosDAO::getInstance(); 
			
		}


		public function index() 
		{
			
			
			require_once(ROOT . '/Vistas/Cliente/checkoutCliente.php');
		}


		public function borrar()
	   	{
	   		$this->DAOPedido->borrar($_POST['id']);
	   	}
	}
?>