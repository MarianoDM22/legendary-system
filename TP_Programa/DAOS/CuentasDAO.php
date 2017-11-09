<?php 

namespace DAOS;

/*
 *	CREATE TABLE cuentas(
 *	id_cuenta int auto_increment not null,
 *	email varchar(100),
 *	pass varchar(100),
 *	rol varchar(10),
 *	fk_cliente int,
 *	primary key(id_cuenta),
 *	foreign key(fk_cliente) references clientes(id_cliente),
 *	constraint unq_cuenta_email unique (email)
 *	);
 */

class CuentasDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'cuentas';

	public function insertar($dato){
		$query = 'INSERT INTO '.$this->table.' 
		( email , pass , rol , fk_cliente ) 
		VALUES 
		( :email , :pass , :rol , :fk_cliente )';

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
		$command->execute();
	}
	public function insertarDevolverID($dato){
		$query = 'INSERT INTO '.$this->table.' 
		( email , pass , rol , fk_cliente ) 
		VALUES 
		( :email , :pass , :rol , :fk_cliente )';

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
		$command->execute();

		$dato->setId($connection->lastInsertId());
			
		return $dato;
	}
	public function buscarPorNombre($dato){
		$object = null;

		$query = 'SELECT * FROM '.$this->table.' WHERE email = :email';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);			

		$command->bindParam(':email', $dato);
		$command->execute();

		while ($row = $command->fetch())
		{
			$email = ($row['email']);
			$pass = ($row['pass']);
			$rol = ($row['rol']);
			$fk_cliente = ($row['fk_cliente']);

			$object = new \Modelos\Producto($email,$pass,$rol,$fk_cliente);

			$object->setId($row['id_cuenta']);	
		}

		return $object;
	}
	public function buscarPorID($dato){
		$object = null;

		$query = 'SELECT * FROM '.$this->table.' WHERE id_cuenta = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);			

		$command->bindParam(':id', $dato);
		$command->execute();

		while ($row = $command->fetch())
		{
			$email = ($row['email']);
			$pass = ($row['pass']);
			$rol = ($row['rol']);
			$fk_cliente = ($row['fk_cliente']);

			$object = new \Modelos\Producto($email,$pass,$rol,$fk_cliente);

			$object->setId($row['id_cuenta']);	
		}

		return $object;
	}
	public function borrar($dato){
		$query = 'DELETE FROM '.$this->table.' WHERE id_cuenta = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$command->bindParam(':id', $dato);
		$command->execute();
	}
	public function actualizar($dato){
		$query= 'UPDATE '.$this->table.'
				SET email = :email, 
					pass = :pass,
					rol = :rol,
					fk_cliente = :fk_cliente
				WHERE id_cuenta = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$id = $dato->getId();
		$email = $dato->getEmail();
		$pass = $dato->getPassword();
		$rol = $dato->getRol();
		$fk_cliente = $dato->getMCliente();


		$command->bindParam(':email', $email);
		$command->bindParam(':pass', $pass);
		$command->bindParam(':rol', $rol);
		$command->bindParam(':fk_cliente', $fk_cliente);
		$command->bindParam(':id', $id);

		$command->execute();
	}
	public function traerTodos(){
		
	}
}
?>