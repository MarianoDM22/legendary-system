<?php 

namespace DAOS;
/*
 *	CREATE TABLE lineasdepedido(
 *	id_lineadepedido int auto_increment not null,
 *	cantidad int,
 *	importe int,
 *	fk_producto int not null,
 *	primary key(id_lineadepedido),
 *	foreign key(fk_producto) references productos(id_producto)
 *	);
 */ 
class LineasDePedidoDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'lineasdepedido';

	public function insertar($dato){
		$query = 'INSERT INTO '.$this->table.' 
		( cantidad , importe , fk_producto ) 
		VALUES 
		( :cantidad , :importe , :fk_producto )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$cantidad = $dato->getCantidad();
		$importe = $dato->getImporte();
		$fk_producto = $dato->getMProducto();

		$command->bindParam(':cantidad', $cantidad);
		$command->bindParam(':importe', $importe);
		$command->bindParam(':fk_producto', $fk_producto);
		$command->execute();
	}
	public function insertarDevolverID($dato){
		$query = 'INSERT INTO '.$this->table.' 
		( cantidad , importe , fk_producto ) 
		VALUES 
		( :cantidad , :importe , :fk_producto )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$cantidad = $dato->getCantidad();
		$importe = $dato->getImporte();
		$fk_producto = $dato->getMProducto();

		$command->bindParam(':cantidad', $cantidad);
		$command->bindParam(':importe', $importe);
		$command->bindParam(':fk_producto', $fk_producto);
		$command->execute();

		$dato->setId($connection->lastInsertId());
			
		return $dato;
	}
	public function buscarPorNombre($dato){
		
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

			$object = new \Modelos\LineasDePedido($cantidad,$importe,$fk_producto);

			$object->setId($row['id_lineadepedido']);	
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
	public function traerTodos(){
		
	}
}
?>