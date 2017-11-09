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