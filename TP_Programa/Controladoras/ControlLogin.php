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


		function logIn(){
			if($_POST[]==$usr)
			{
				if($_POST[]==$pass)
				{
					echo "login correcto";
				}
				else
				{
					echo "contraseña incorrecta";
				}
			}
			else
			{
				echo "el usuario no existe";
			}
		}

	}
?>