<?php namespace Controladoras;

	
	class ControlContacto
	{
		private $DAOContacto;
		

		public function __construct()
		{

		}
		public function enviar($headers, $subject, $message){
			$from = "From: $headers";
			mail("marco.julian.torre@gmail.com",$subject,$message,$from);
			echo "<script>alert('Mensaje enviado!'));</script>";
			require_once(ROOT . 'Vistas/home.php');
		}



		

	}//fin clase control contacto
?>