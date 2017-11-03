<?php 

namespace DAOS;

/*
 *	CREATE TABLE clientes(
 *	id_cliente int auto_increment not null,
 *	apellido varchar(30),
 *	domicilio varchar(30),
 *	nombre varchar(30),
 *	telefono varchar(30),
 *	primary key(id_cliente)
 *	);
 */

class ClientesDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'clientes';

	public function insertar($dato){
		$query = 'INSERT INTO '.$this->table.' 
		( apellido , domicilio , nombre , telefono ) 
		VALUES 
		( :apellido , :domicilio , :nombre , :telefono )';

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
		$command->execute();
	}
	public function insertarDevolverID($dato){
		$query = 'INSERT INTO '.$this->table.' 
		( apellido , domicilio , nombre , telefono ) 
		VALUES 
		( :apellido , :domicilio , :nombre , :telefono )';

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