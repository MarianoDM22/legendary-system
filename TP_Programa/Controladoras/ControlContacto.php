<?php namespace Controladoras;

	
	class ControlContacto
	{
		private $DAOContacto;
		

		public function __construct()
		{

		}
		public function enviar($email, $name, $subject, $message){
			$txt .= "From: ".$email;
			$txt .= "\nName: ".$name;
			$txt .= "\nMessage: ".$message;
			mail("cerveceria.socialmediamanager@gmail.com",$subject,$txt);
			echo "<script>alert('Mensaje enviado!'));</script>";
			require_once(ROOT . 'Vistas/home.php');
		}



		

	}//fin clase control contacto
?>