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
use \Exception as Exception;
use \PDOException as PDOException;

class ProductosDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'productos';


	public function insertar($dato){
		try 
    	{
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
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
	}
	public function insertarDevolverID($dato){
		try 
    	{
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
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
	}
	public function buscarPorNombre($dato){
		try 
    	{
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
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
	}
	public function buscarPorID($dato)
	{
		try 
    	{
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
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
	}
	public function borrar($dato){
		try 
    	{
		$query = 'DELETE FROM '.$this->table.' WHERE id_producto = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$command->bindParam(':id', $dato);
		$command->execute();
    		
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
	}
	public function actualizar($dato){
		try 
    	{
		$query= 'UPDATE '.$this->table.'
				SET descripcion = :descripcion, 
					capacidad = :capacidad,
					factor = :factor,
					precio = :precio,
					imagen = :imagen,
					fk_tipodecerveza = :fk_tipodecerveza
				WHERE id_producto = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$id = $dato->getId();
		$descripcion = $dato->getDescripcion();
		$capacidad = $dato->getCapacidad();
		$factor = $dato->getFactor();
		$precio = $dato->getPrecio();
		$imagen = $dato->getImagen();
		$fk_tipodecerveza = $dato->getMTiposDeCerveza();


		$command->bindParam(':capacidad', $capacidad);
		$command->bindParam(':descripcion', $descripcion);
		$command->bindParam(':factor', $factor);
		$command->bindParam(':precio', $precio);
		$command->bindParam(':imagen', $imagen);
		$command->bindParam(':id', $id);
		$command->bindParam(':fk_tipodecerveza', $fk_tipodecerveza);

		$command->execute();
    		
    	}
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
	}
	public function traerTodos(){
		try 
    	{
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
    	catch (PDOException $ex) {
			throw $ex;
    	}
    	catch (Exception $e) {
			throw $e;
    	}
	}

}
?>