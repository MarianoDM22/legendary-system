<?php 

namespace DAOS;
/*
*CREATE TABLE pedidos(
*id_pedido int auto_increment not null,
*estado varchar(30),
*fecha varchar(10),
*fk_cliente int not null,
*fk_lineadepedido int not null,
*fk_envio int not null,
*fk_sucursal int not null,
*primary key(id_pedido),
*foreign key(fk_cliente) references clientes(id_cliente),
*foreign key(fk_lineadepedido) references lineasdepedido(id_lineadepedido),
*foreign key(fk_envio) references envios(id_envio),
*foreign key(fk_sucursal) references sucursales(id_sucursal)
*);
*/

class PedidosDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'pedidos';

	public function insertar($dato){

	}
	public function insertarDevolverID($dato){

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
	public function traerTodosPorIDdeCliente($dato){
		$objects = array();

		$query = 'SELECT * FROM '.$this->table.' WHERE id_pedido = :id';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$command->bindParam(':id', $dato);

		$command->execute();

		while ($row = $command->fetch())
		{

			$estado = ($row['estado']);
			$fecha = ($row['fecha']);
			$m_Cliente = ($row['fk_cliente']);
			$m_LineasDePedido = ($row['fk_lineadepedido']);
			$m_Envio = ($row['fk_envio']);
			$m_Sucursales = ($row['fk_sucursal']);

			$object = new \Modelos\Pedidos();

			$object->setId($row['id_pedido']);	

			array_push($objects, $object);

		}

		return $objects;
	}
}
?>