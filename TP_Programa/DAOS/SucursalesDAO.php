<?php 

namespace DAOS;

/*
 *	CREATE TABLE sucursales(
 *	id_sucursal int auto_increment not null,
 *	domicilio varchar(100),
 *	latitud int,
 *	longitud int,
 *	nombre varchar(30),
 *	primary key(id_sucursal)
 *	);
 */

class SucursalesDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'sucursales';

	public function insertar($dato){
		$query = 'INSERT INTO '.$this->table.' 
		( domicilio , latitud , longitud , nombre ) 
		VALUES 
		( :domicilio , :latitud , :longitud , :nombre )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$domicilio = $dato->getDomicilio();
		$latitud = $dato->getLatitud();
		$longitud = $dato->getLongitud();
		$nombre = $dato->getNombre();

		$command->bindParam(':domicilio', $domicilio);
		$command->bindParam(':latitud', $latitud);
		$command->bindParam(':longitud', $longitud);
		$command->bindParam(':nombre', $nombre);
		$command->execute();
	}
	public function insertarDevolverID($dato){
		$query = 'INSERT INTO '.$this->table.' 
		( domicilio , latitud , longitud , nombre ) 
		VALUES 
		( :domicilio , :latitud , :longitud , :nombre )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$domicilio = $dato->getDomicilio();
		$latitud = $dato->getLatitud();
		$longitud = $dato->getLongitud();
		$nombre = $dato->getNombre();

		$command->bindParam(':domicilio', $domicilio);
		$command->bindParam(':latitud', $latitud);
		$command->bindParam(':longitud', $longitud);
		$command->bindParam(':nombre', $nombre);
		$command->execute();

		$dato->setId($connection->lastInsertId());
			
		return $dato;
	}
	public function buscarPorNombre($dato){
		$object = null;

		$query = 'SELECT * FROM '.$this->table.' WHERE nombre = :nombre';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);			

		$command->bindParam(':nombre', $dato);
		$command->execute();

		while ($row = $command->fetch())
		{

			$domicilio = ($row['domicilio']);
			$latitud = ($row['latitud']);
			$longitud = ($row['longitud']);
			$nombre = ($row['nombre']);

			$object = new \Modelos\Sucursales( $domicilio , $latitud , $longitud , $nombre );

			$object->setId($row['id_sucursal']);	

		}

		return $object;
	}
	public function buscarPorID($dato){
		$object = null;

		$query = 'SELECT * FROM '.$this->table.' WHERE id_sucursal = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);			

		$command->bindParam(':id', $dato);
		$command->execute();

		while ($row = $command->fetch())
		{

			$domicilio = ($row['domicilio']);
			$latitud = ($row['latitud']);
			$longitud = ($row['longitud']);
			$nombre = ($row['nombre']);

			$object = new \Modelos\Sucursales( $domicilio , $latitud , $longitud , $nombre );

			$object->setId($row['id_sucursal']);	

		}

		return $object;
	}
	public function borrar($dato){

	}
	public function actualizar($dato){

	}
	public function traerTodos(){
		
	}
}
?>