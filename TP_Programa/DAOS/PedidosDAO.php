<?php 

namespace DAOS;

/*
 *	CREATE TABLE pedidos(
 *	id_pedido int auto_increment not null,
 *	estado varchar(30),
 *	fecha varchar(10),
 *	fk_cliente int not null,
 *	fk_envio int not null,
 *	fk_sucursal int not null,
 *	constraint pk_pedido primary key(id_pedido),
 *	constraint fk_pedido_cliente foreign key(fk_cliente) references clientes(id_cliente),
 *	constraint fk_pedido_envio foreign key(fk_envio) references envios(id_envio),
 *	constraint fk_pedido_sucursal foreign key(fk_sucursal) references sucursales(id_sucursal)
 *	);
 */

use \Exception as Exception;
use \PDOException as PDOException;

class PedidosDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'pedidos';

	public function insertar($dato){
		try 
    	{
    		
			$query = 'INSERT INTO '.$this->table.' 
			( estado , fecha , fk_cliente , fk_envio , fk_sucursal ) 
			VALUES 
			( :estado , :fecha , :fk_cliente , :fk_envio , :fk_sucursal )';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$estado = $dato->getEstado();
			$fecha = $dato->getFecha();
			$fk_cliente = $dato->getMCliente();
			$fk_envio = $dato->getMEnvio();
			$fk_sucursal = $dato->getMSucursales();
			


			$command->bindParam(':estado', $estado);
			$command->bindParam(':fecha', $fecha);
			$command->bindParam(':fk_cliente', $fk_cliente);
			$command->bindParam(':fk_envio', $fk_envio);
			$command->bindParam(':fk_sucursal' , $fk_sucursal);
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
			( estado , fecha , fk_cliente , fk_envio , fk_sucursal ) 
			VALUES 
			( :estado , :fecha , :fk_cliente , :fk_envio , :fk_sucursal )';

			$pdo = new Connection();
			$connection = $pdo->Connect();
			$command = $connection->prepare($query);

			$estado = $dato->getEstado();
			$fecha = $dato->getFecha();
			$fk_cliente = $dato->getMCliente();
			$fk_envio = $dato->getMEnvio();
			$fk_sucursal = $dato->getMSucursales();

			$command->bindParam(':estado', $estado);
			$command->bindParam(':fecha', $fecha);
			$command->bindParam(':fk_cliente', $fk_cliente);
			$command->bindParam(':fk_envio', $fk_envio);
			$command->bindParam(':fk_sucursal' , $fk_sucursal);
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
				$fk_cliente = ($row['fk_cliente']);
				$fk_envio = ($row['fk_envio']);
				$fk_sucursal = ($row['fk_sucursal']);

				$object = new \Modelos\Pedido($estado, $fecha, $fk_cliente, null , $fk_envio, $fk_sucursal);

				$object->setId($row['id_pedido']);	
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
			$query = 'DELETE FROM '.$this->table.' WHERE id_pedido = :id';

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
				$estado = ($row['estado']);
				$fecha = ($row['fecha']);
				$fk_cliente = ($row['fk_cliente']);
				$fk_envio = ($row['fk_envio']);
				$fk_sucursal = ($row['fk_sucursal']);

				$object = new \Modelos\Pedido($estado, $fecha, $fk_cliente, null , $fk_envio, $fk_sucursal);

				$object->setId($row['id_pedido']);	

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