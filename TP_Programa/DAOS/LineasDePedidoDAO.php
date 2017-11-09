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

	}
	public function borrar($dato){

	}
	public function actualizar($dato){

	}
	public function traerTodos(){
		
	}
}
?>