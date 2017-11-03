<?php 

namespace DAOS;

class LoginDAO extends SingletonAbstractDAO implements IDAO
{
	//private $table = 'clientes';
	private $table2 = 'cuentas';




	public function insertar($dato)
	{

		//nada porqe el login se mantiene solo en session

	}



	public function insertarDevolverID($dato)//le llega un cliente sin ID
	{
		//nada porqe el login se mantiene solo en session

	}


	public function buscarPorNombre($dato)//recibe un email y lo busca en BD , devuelve null si no lo encuentra, o el objeto cuenta si lo encuentra
	{
		$object = null;

		$query = 'SELECT * FROM '.$this->table2.' WHERE email = :email';//busco en table2 qe corresponde a CUENTAS

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);			

		$command->bindParam(':email', $dato);

		$command->execute();

		while ($row = $command->fetch())
		{
			$email=($row['email']);
			$pass=($row['pass']);
			$rol=($row['rol']);
			$id_cliente=($row['fk_cliente']);

			$object = new \Modelos\Cuenta($email, $pass, $rol,$id_cliente);//tomo los datos de la cuenta buscada y creo un objeto
			$object->setId($row['id_cuenta']);		
		}

		return $object;//retorno el objeto o null si no lo encontro

	}
	public function buscarPorID($dato)
	{
		//nada porqe el login se mantiene solo en session

	}
	public function borrar($dato)
	{
		//nada porqe el login se mantiene solo en session
	}
	public function actualizar($dato)
	{
		//nada porqe el login se mantiene solo en session
	}
	public function traerTodos()
	{
		
	}
	
}
?>