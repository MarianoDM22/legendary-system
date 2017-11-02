<?php namespace Controladoras;

	
	class ControlHome
	{
		
		function __construct() {}

		function index() {
			require_once(ROOT . '/Vistas/home.php');
		}

		
	}
?>