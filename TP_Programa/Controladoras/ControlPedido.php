<?php namespace Controladoras;

class ControlPedido
{
	private $DAOProducto;

		public function __construct()
	{
		//$this->DAOProducto=\DAOS\listaProducto::getInstance();
		$this->DAOProducto=\DAOS\ProductosDAO::getInstance(); //cuando pasemos a BD
		
	}

}
?>