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

	}
	public function buscarPorID($dato){

	}
	public function borrar($dato){

	}
	public function actualizar($dato){

	}
	public function traerTodos(){
		
	}
}
?>