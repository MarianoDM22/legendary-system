<?php 

namespace DAOS;

class RegistrarDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'clientes';
	private $table2 = 'cuentas';




	public function insertar($dato)//le llega un objeto cliente y lo guarda en la base de datos
	{

		$query = 'INSERT INTO '.$this->table.' 
		(email, pass, rol,fk_cliente) 
		VALUES 
		(:email, :pass, :rol,fk_cliente)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$email = $dato->getEmail();
		$pass = $dato->getPassword();
		$rol = $dato->getRol();
		$fk_cliente = $dato->getImagen();

		$command->bindParam(':email', $email);
		$command->bindParam(':pass', $pass);
		$command->bindParam(':rol', $rol);
		$command->bindParam(':fk_cliente', $fk_cliente);


		if ($command->execute() ) {
			echo 'Query correcta';
		}
		else
			echo 'Query incorrecta';		

	}

	public function insertarCuenta($dato)//le llega un objeto cuenta y lo guarda en BD
	{

		$query = 'INSERT INTO '.$this->table2.' 
		(email, pass, rol,fk_cliente) 
		VALUES 
		(:email, :pass, :rol,:fk_cliente)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$email = $dato->getEmail();
		$pass = $dato->getPassword();
		$rol = $dato->getRol();
		$fk_cliente = $dato->getMCliente();

		$command->bindParam(':email', $email);
		$command->bindParam(':pass', $pass);
		$command->bindParam(':rol', $rol);
		$command->bindParam(':fk_cliente', $fk_cliente);


		if ($command->execute() ) {
			echo 'Query correcta';
		}
		else
			echo 'Query incorrecta';		

	}

	public function insertarDevolverID($dato)//le llega un cliente sin ID
	{
		$query = 'INSERT INTO '.$this->table.' 
		( apellido, domicilio,nombre,telefono) 
		VALUES 
		( :apellido, :domicilio,:nombre,:telefono)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		
		$apellido = $dato->getApellido();
		$domicilio = $dato->getDomicilio();
		$nombre = $dato->getNombre();
		$telefono = $dato->getTelefono();

		$command->bindParam(':apellido', $apellido);
		$command->bindParam(':domicilio', $domicilio);
		$command->bindParam(':nombre', $nombre);
		$command->bindParam(':telefono', $telefono);


		if ($command->execute())
			echo 'query correcta CUENTAS';
		else
			echo 'query incorrecta CUENTAS';
		

		$dato->setId($connection->lastInsertId());
			
		return $dato; //devuelve el cliente con ID

	}
	public function buscarPorNombre($dato)
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

	}
	public function borrar($dato)
	{

	}
	public function actualizar($dato)
	{

	}
	public function traerTodos()
	{
		
	}
}
?>