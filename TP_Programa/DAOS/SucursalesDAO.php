<?php 

namespace DAOS;

/*
 *	CREATE TABLE sucursales(
 *	id_sucursal int auto_increment not null,
 	nombre varchar(30),
 *	domicilio varchar(100),
 *	latitud int,
 *	longitud int,
 *	primary key(id_sucursal)
 *	);
 */
use \Exception as Exception;
use \PDOException as PDOException;

class SucursalesDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'sucursales';

	public function insertar($dato){
		try 
    	{
			$query = 'INSERT INTO '.$this->table.' 
			( nombre, domicilio , latitud , longitud ) 
			VALUES 
			( :nombre, :domicilio , :latitud , :longitud )';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$nombre = $dato->getNombre();
			$domicilio = $dato->getDomicilio();
			$latitud = $dato->getLatitud();
			$longitud = $dato->getLongitud();

			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':domicilio', $domicilio);
			$command->bindParam(':latitud', $latitud);
			$command->bindParam(':longitud', $longitud);
			
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
			(  nombre, domicilio , latitud , longitud ) 
			VALUES 
			( :nombre,  :domicilio , :latitud , :longitud )';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$nombre = $dato->getNombre();
			$domicilio = $dato->getDomicilio();
			$latitud = $dato->getLatitud();
			$longitud = $dato->getLongitud();

			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':domicilio', $domicilio);
			$command->bindParam(':latitud', $latitud);
			$command->bindParam(':longitud', $longitud);
			
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

			$query = 'SELECT * FROM '.$this->table.' WHERE nombre = :nombre';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			$command->bindParam(':nombre', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				$nombre = ($row['nombre']);
				$domicilio = ($row['domicilio']);
				$latitud = ($row['latitud']);
				$longitud = ($row['longitud']);

				$object = new \Modelos\Sucursal(  $nombre, $domicilio, $latitud, $longitud );

				$object->setId($row['id_sucursal']);	

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
	public function buscarPorID($dato){
		try 
    	{
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_sucursal = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				$nombre = ($row['nombre']);
				$domicilio = ($row['domicilio']);
				$latitud = ($row['latitud']);
				$longitud = ($row['longitud']);

				$object = new \Modelos\Sucursal(  $nombre, $domicilio , $latitud , $longitud);

				$object->setId($row['id_sucursal']);	

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
			$query = 'DELETE FROM '.$this->table.' WHERE id_sucursal = :id';

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
					SET nombre = :nombre,
						domicilio = :domicilio, 
						latitud = :latitud,
						longitud = :longitud
						
					WHERE id_sucursal = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$id = $dato->getId();
			$nombre = $dato->getNombre();
			$domicilio = $dato->getDomicilio();
			$latitud = $dato->getLatitud();
			$longitud = $dato->getLongitud();

			$command->bindParam(':nombre', $nombre);
			$command->bindParam(':domicilio', $domicilio);
			$command->bindParam(':latitud', $latitud);
			$command->bindParam(':longitud', $longitud);
			$command->bindParam(':id', $id);

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
			$objects = null;

			$query = 'SELECT * FROM '.$this->table;

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);
			$command->execute();

			while ($row = $command->fetch())
			{
				$nombre = ($row['nombre']);
				$domicilio = ($row['domicilio']);
				$latitud = ($row['latitud']);
				$longitud = ($row['longitud']);
				
				$object = new \Modelos\Sucursal( $nombre, $domicilio , $latitud , $longitud);

				$object->setId($row['id_sucursal']);

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