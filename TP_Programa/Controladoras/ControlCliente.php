<?php namespace Controladoras;



class ControlCliente
{
	private $DAOCliente;		

	public function __construct()
	{
			$this->DAOCliente=\DAOS\ClientesDAO::getInstance();
			
	}


	public function buscarClientePorId($id)
	{
		
		$cliente=$this->DAOCliente->buscarPorID($id);
		return $cliente;

	}








}//fin clase
?>