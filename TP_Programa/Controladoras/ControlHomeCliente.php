<?php namespace Controladoras;

	
	class ControlHomeCliente
	{
		
		function __construct() {}

		function index() {
			require_once(ROOT . '/Vistas/Cliente/homeCliente.php');
		}

		
	}
?>