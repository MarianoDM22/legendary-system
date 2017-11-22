<?php 

namespace DAOS;

/*
 *	CREATE TABLE envios(
 *	id_envio int auto_increment not null,
 *	domicilio varchar(100),
 *	email varchar(100),
 *	fecha_programada varchar(10),
 *	hora_desde varchar(5),
 *	hora_hasta varchar(5),
 *	telefono varchar(30),
 *	primary key(id_envio)
 *	);
 */

use \Exception as Exception;
use \PDOException as PDOException;

class EnviosDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'envios';

	public function insertar($dato){
		try 
    	{
		$query = 'INSERT INTO '.$this->table.' 
		( domicilio , email , fecha_programada , hora_desde , hora_hasta , telefono ) 
		VALUES 
		( :domicilio , :email , :fecha_programada , :hora_desde , :hora_hasta , :telefono )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$domicilio = $dato->getDomicilio();
		$email = $dato->getEmail();
		$fecha_programada = $dato->getFechaProgramada();
		$hora_desde = $dato->getHoraDesde();
		$hora_hasta = $dato->getHoraHasta();
		$telefono = $dato->getTelefono();

		$command->bindParam(':domicilio', $domicilio);
		$command->bindParam(':email', $email);
		$command->bindParam(':fecha_programada', $fecha_programada);
		$command->bindParam(':hora_desde', $hora_desde);
		$command->bindParam(':hora_hasta', $hora_hasta);
		$command->bindParam(':telefono', $telefono);
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
		( domicilio , email , fecha_programada , hora_desde , hora_hasta , telefono ) 
		VALUES 
		( :domicilio , :email , :fecha_programada , :hora_desde , :hora_hasta , :telefono )';

		$pdo = new Connection();
		$connection = $pdo->Connect();
		$command = $connection->prepare($query);

		$domicilio = $dato->getDomicilio();
		$email = $dato->getEmail();
		$fecha_programada = $dato->getFechaProgramada();
		$hora_desde = $dato->getHoraDesde();
		$hora_hasta = $dato->getHoraHasta();
		$telefono = $dato->getTelefono();

		$command->bindParam(':domicilio', $domicilio);
		$command->bindParam(':email', $email);
		$command->bindParam(':fecha_programada', $fecha_programada);
		$command->bindParam(':hora_desde', $hora_desde);
		$command->bindParam(':hora_hasta', $hora_hasta);
		$command->bindParam(':telefono', $telefono);
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

	}
	public function borrar($dato){

	}
	public function actualizar($dato){

	}
	public function traerTodos(){
		
	}
}
?>