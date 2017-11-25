<?php 

namespace DAOS;

/*
 * 	CREATE TABLE lineasdepedido(
 * 	id_lineadepedido int auto_increment not null,
 * 	cantidad int,
 * 	importe int,
 * 	fk_producto int not null,
 * 	fk_pedido int,
 * 	constraint pk_lineadepedido primary key(id_lineadepedido),
 * 	constraint fk_lineadepedido_pedido foreign key(fk_pedido) references pedidos(id_pedido),
 * 	constraint fk_lineadepedido_producto foreign key(fk_producto) references productos(id_producto)
 * 	);
 */
use \Exception as Exception;
use \PDOException as PDOException;

class LineasDePedidoDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'lineasdepedido';

	public function insertar($dato){
		try 
    	{
    		
			$query = 'INSERT INTO '.$this->table.' 
			( cantidad , importe , fk_producto , fk_pedido) 
			VALUES 
			( :cantidad , :importe , :fk_producto , :fk_pedido )';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$cantidad = $dato->getCantidad();
			$importe = $dato->getImporte();
			$fk_producto = $dato->getMProducto();
			$fk_pedido = $dato->getIdPedido();

			$command->bindParam(':cantidad', $cantidad);
			$command->bindParam(':importe', $importe);
			$command->bindParam(':fk_producto', $fk_producto);
			$command->bindParam(':fk_pedido', $fk_pedido);

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
			( cantidad , importe , fk_producto , fk_pedido) 
			VALUES 
			( :cantidad , :importe , :fk_producto , fk_pedido )';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$cantidad = $dato->getCantidad();
			$importe = $dato->getImporte();
			$fk_producto = $dato->getMProducto();
			$fk_pedido = $dato->getIdPedido();

			$command->bindParam(':cantidad', $cantidad);
			$command->bindParam(':importe', $importe);
			$command->bindParam(':fk_producto', $fk_producto);
			$command->bindParam(':fk_pedido', $fk_pedido);
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
	public function buscarPorID($dato){
		try 
    	{
			$object = null;

			$query = 'SELECT * FROM '.$this->table.' WHERE id_lineadepedido = :id';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);			

			$command->bindParam(':id', $dato);
			$command->execute();

			while ($row = $command->fetch())
			{
				$cantidad = ($row['cantidad']);
				$importe = ($row['importe']);
				$fk_producto = ($row['fk_producto']);

				$object = new \Modelos\LineasDePedido($cantidad,  $importe, $m_Producto);

				$object->setId($row['id_lineadepedido']);	
				$object->setId($row['setIdPedido']);
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

			$query = 'DELETE FROM '.$this->table.' WHERE id_lineadepedido = :id';

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

	}
	public function lineasPorPedido($idPedido){
		try 
    	{
			$objects = array();

			$query = 'SELECT * FROM '.$this->table. ' WHERE fk_pedido = :idPedido';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);
			$command->bindParam(':idPedido', $idPedido);
			$command->execute();

			while ($row = $command->fetch())
			{
				$cantidad = ($row['cantidad']);
				$importe = ($row['importe']);
				$fk_producto = ($row['fk_producto']);

				$object = new \Modelos\LineasDePedido($cantidad,  $importe, $fk_producto);

				$object->setId($row['id_lineadepedido']);	
				$object->setIdPedido($row['fk_pedido']);

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
				$cantidad = ($row['cantidad']);
				$importe = ($row['importe']);
				$fk_producto = ($row['fk_producto']);

				$object = new \Modelos\LineasDePedido($cantidad,  $importe, $m_Producto);

				$object->setId($row['id_lineadepedido']);	
				$object->setId($row['setIdPedido']);

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