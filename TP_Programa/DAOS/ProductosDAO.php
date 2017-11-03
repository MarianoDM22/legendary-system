<?php  

namespace DAOS;

/*
 *	CREATE TABLE productos(
 *	id_producto int auto_increment not null,
 *	descripcion varchar(30),
 *	fk_tipodecerveza int not null,
 *	capacidad int,
 *	factor int,
 *	precio int,
 *	imagen longblob,
 *	primary key(id_producto),
 *	foreign key(fk_tipodecerveza) references tiposdecervezas(id_tipodecerveza)
 *	);
 */

class ProductosDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'productos';


	public function insertar($dato){
		$query = 'INSERT INTO '.$this->table.' 
		( descripcion , fk_tipodecerveza , capacidad , factor , precio , imagen ) 
		VALUES 
		( :descripcion , :fk_tipodecerveza , :capacidad , :factor , :precio , :imagen )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$descripcion = $dato->getDescripcion();
		$fk_tipodecerveza = $dato->getMTiposDeCerveza();
		$capacidad = $dato->getCapacidad();
		$factor = $dato->getFactor();
		$precio = $dato->getPrecio();
		$imagen = $dato->getImagen();

		$command->bindParam(':descripcion', $descripcion);
		$command->bindParam(':fk_tipodecerveza', $fk_tipodecerveza);
		$command->bindParam(':capacidad', $capacidad);
		$command->bindParam(':factor', $factor);
		$command->bindParam(':precio' , $precio);
		$command->bindParam(':imagen', $imagen);
		$command->execute();
	}
	public function insertarDevolverID($dato){
		$query = 'INSERT INTO '.$this->table.' 
		( descripcion , fk_tipodecerveza , capacidad , factor , precio , imagen ) 
		VALUES 
		( :descripcion , :fk_tipodecerveza , :capacidad , :factor , :precio , :imagen )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$descripcion = $dato->getDescripcion();
		$fk_tipodecerveza = $dato->getMTiposDeCerveza();
		$capacidad = $dato->getCapacidad();
		$factor = $dato->getFactor();
		$precio = $dato->getPrecio();
		$imagen = $dato->getImagen();

		$command->bindParam(':descripcion', $descripcion);
		$command->bindParam(':fk_tipodecerveza', $fk_tipodecerveza);
		$command->bindParam(':capacidad', $capacidad);
		$command->bindParam(':factor', $factor);
		$command->bindParam(':precio' , $precio);
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

			$descripcion = ($row['descripcion']);
			$fk_tipodecerveza = ($row['fk_tipodecerveza']);
			$capacidad = ($row['capacidad']);
			$factor = ($row['factor']);
			$precio = ($row['precio']);
			$imagen = ($row['imagen']);

			$object = new \Modelos\Producto($descripcion,$fk_tipodecerveza,$capacidad,$factor,$imagen,$precio);

			$object->setId($row['id_producto']);	

		}

		return $object;
	}
	public function buscarPorID($dato){
		$object = null;

		$query = 'SELECT * FROM '.$this->table.' WHERE id_producto = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);			

		$command->bindParam(':id', $dato);
		$command->execute();

		while ($row = $command->fetch())
		{
			$descripcion = ($row['descripcion']);
			$fk_tipodecerveza = ($row['fk_tipodecerveza']);
			$capacidad = ($row['capacidad']);
			$factor = ($row['factor']);
			$precio = ($row['precio']);
			$imagen = ($row['imagen']);

			$object = new \Modelos\Producto($descripcion,$fk_tipodecerveza,$capacidad,$factor,$imagen,$precio);

			$object->setId($row['id_producto']);	
		}

		return $object;
	}
	public function borrar($dato){
		$query = 'DELETE FROM '.$this->table.' WHERE id_producto = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$command->bindParam(':id', $dato);
		$command->execute();
	}
	public function actualizar($dato){
		$query= 'UPDATE '.$this->table.'
				SET descripcion = :descripcion, 
					capacidad = :capacidad,
					factor = :factor,
					imagen = :imagen,
					fk_tipodecerveza = :fk_tipodecerveza
				WHERE id_producto = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$command->bindParam(':capacidad', $dato->getCapacidad());
		$command->bindParam(':descripcion', $dato->getDescripcion());
		$command->bindParam(':factor', $dato->getFactor());
		$command->bindParam(':imagen', $dato->getImagen());
		$command->bindParam(':id', $dato->getId());
		$command->bindParam(':fk_tipodecerveza', $dato->getMTiposDeCerveza());

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
			$descripcion = ($row['descripcion']);
			$fk_tipodecerveza = ($row['fk_tipodecerveza']);
			$capacidad = ($row['capacidad']);
			$factor = ($row['factor']);
			$precio = ($row['precio']);
			$imagen = ($row['imagen']);

			$object = new \Modelos\Producto($descripcion,$fk_tipodecerveza,$capacidad,$factor,$imagen,$precio);

			$object->setId($row['id_producto']);	

			array_push($objects, $object);

		}

		return $objects;	
	}
	/*
	public function calcularPrecio(){
			
		$precio = array();

		$query = 'SELECT * FROM '.$this->table;

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);
		$command->execute();

		while ($row = $command->fetch())
		{
			$precio=($producto->getCapacidad() * $tipoCerveza->getPrecio_litro()) * $producto->getFactor();
	   		$precio->setPrecio($precio);

	

			$precio->setPrecio($row['precio']);	

		}

		return $precio;	
		
	}
	*/
}
?>