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
		$cliente = null;
		try {
			$cliente=$this->DAOCliente->buscarPorID($id);
		} catch (PDOException $pdoEx) {
			echo "<script>alert('Error en BBDD al buscar el cliente.'));</script>";
		}
		
		
		return $cliente;

	}








}//fin clase
?>