<?php namespace Controladoras;

	
	class ControlContacto
	{
		private $DAOContacto;
		

		public function __construct()
		{
			
			$this->DAOContacto=\DAOS\ContactoDAO::getInstance(); 			
		}	



		

	}//fin clase control contacto
?>