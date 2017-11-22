<?php 

namespace DAOS;

/*
 * 	CREATE TABLE lineasdepedido(
 * 	id_lineadepedido int auto_increment not null,
 * 	cantidad int,
 * 	importe int,
 * 	fk_producto int not null,
 * 	fk_pedido int not null,
 * 	constraint pk_lineadepedido primary key(id_lineadepedido),
 * 	constraint fk_lineadepedido_pedido foreign key(fk_pedido) references pedidos(id_pedido),
 * 	constraint fk_lineadepedido_producto foreign key(fk_producto) references productos(id_producto)
 * 	);
 */

class LineasDePedidoDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'lineasdepedido';

	public function insertar($dato){
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
	}
	public function insertarDevolverID($dato){
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
	public function buscarPorID($dato){
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
	public function borrar($dato){
		$query = 'DELETE FROM '.$this->table.' WHERE id_lineadepedido = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$command->bindParam(':id', $dato);
		$command->execute();
	}
	public function actualizar($dato){

	}
	public function lineasPorPedido($idPedido){
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

			$object = new \Modelos\LineasDePedido($cantidad,  $importe, $m_Producto);

			$object->setId($row['id_lineadepedido']);	
			$object->setId($row['setIdPedido']);

			array_push($objects, $object);

		}

		return $objects;
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
}
?>