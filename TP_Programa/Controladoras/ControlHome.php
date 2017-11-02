<?php namespace Controladoras;

	
	class ControlHome
	{
		
		function __construct() {}

		function index() {
/*
			$DaoCiudades = new DAOS\DaoCiudades();

			$ciudad = new Ciudad();

			$ciudad->setNombre('Mar del Plata');

			$ciudades = $DaoCiudades->agregar($ciudad);

			$pepe = 'pepe';
*/
			require_once(ROOT . '/Vistas/home.php');
		}

		
	}
?>