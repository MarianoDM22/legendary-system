<?php namespace Controladoras;

	
	class ControlLogin
	{
		
		function __construct() {}

		function index() {
			require_once(ROOT . '/Vistas/Login.php');
		}

		function prueba() {
			echo 'funciona';
		}
	}
?>