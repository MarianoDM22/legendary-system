<?php 

namespace DAOS;

/*
 *	CREATE TABLE tiposdecervezas(
 *	id_tipodecerveza int auto_increment not null,
 *	descripcion varchar(30),
 *	precio_litro int,
 *	imagen longblob,
 *	primary key(id_tipodecerveza)
 *	);
 */

class TiposDeCervezasDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'tiposdecervezas';


	public function insertar($dato){
		$query = 'INSERT INTO '.$this->table.' 
		(descripcion, precio_litro, imagen) 
		VALUES 
		(:descripcion, :precio_litro, :imagen)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$descripcion = $dato->getDescripcion();
		$precio_litro = $dato->getPrecio_litro();
		$imagen = $dato->getImagen();	

		$command->bindParam(':descripcion', $descripcion);
		$command->bindParam(':precio_litro', $precio_litro);
		$command->bindParam(':imagen', $imagen);
		$command->execute();
	}
	public function insertarDevolverID($dato){
		$query = 'INSERT INTO '.$this->table.' 
		(descripcion, precio_litro, imagen) 
		VALUES 
		(:descripcion, :precio_litro, :imagen)';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$descripcion = $dato->getDescripcion();
		$precio_litro = $dato->getPrecio_litro();
		$imagen = $dato->getImagen();

		$command->bindParam(':descripcion', $descripcion);
		$command->bindParam(':precio_litro', $precio_litro);
		$command->bindParam(':imagen', $imagen);
		$command->execute();

		$dato->setId($connection->lastInsertId());
			
		return $dato;
	}
	public function buscarPorNombre($dato){
		$object = null;

		$query = 'SELECT * FROM '.$this->table.' WHERE descripcion = :descripcion';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);			

		$command->bindParam(':descripcion', $dato);
		$command->execute();

		while ($row = $command->fetch())
		{
			$des=($row['descripcion']);
			$pre=($row['precio_litro']);
			$img=($row['imagen']);

			$object = new \Modelos\TiposDeCerveza($des, $pre, $img);

			$object->setId($row['id_tipodecerveza']);		
		}

		return $object;
	}
	public function buscarPorID($dato){
		$object = null;

		$query = 'SELECT * FROM '.$this->table.' WHERE id_tipodecerveza = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);			

		$command->bindParam(':id', $dato);
		$command->execute();

		while ($row = $command->fetch())
		{
			$des=($row['descripcion']);
			$pre=($row['precio_litro']);
			$img=($row['imagen']);

			$object = new \Modelos\TiposDeCerveza($des, $pre, $img);

			$object->setId($row['id_tipodecerveza']);		
		}

		return $object;
	}
	public function borrar($dato){
		$query = 'DELETE FROM '.$this->table.' WHERE id_tipodecerveza = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$command->bindParam(':id', $dato);
		$command->execute();
	}
	public function actualizar($dato){
		$query= 'UPDATE '.$this->table.'
				SET descripcion = :descripcion, 
					precio_litro = :precio_litro,
					imagen = :imagen
				WHERE id_tipodecerveza = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$id = $dato->getId();
		$descripcion = $dato->getDescripcion();
		$precio_litro = $dato->getPrecio_litro();
		$imagen = $dato->getImagen();


		$command->bindParam(':descripcion', $descripcion);
		$command->bindParam(':precio_litro', $precio_litro);
		$command->bindParam(':imagen', $imagen);
		$command->bindParam(':id', $id);

		$command->execute();
	}
	public function traerTodos(){
		$objects = array();

		$query = 'SELECT * FROM '.$this->table;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		while ($row = $command->fetch())
		{
			
			

			$des=($row['descripcion']);
			$pre=($row['precio_litro']);
			$img=($row['imagen']);

			$object = new \Modelos\TiposDeCerveza($des, $pre, $img);

			$object->setId($row['id_tipodecerveza']);

			array_push($objects, $object);


		}

		return $objects;
	}
}
?>