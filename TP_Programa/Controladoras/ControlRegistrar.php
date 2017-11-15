<?php namespace Controladoras;

	
	
	class ControlRegistrar
	{
		
	private $DAORegistrar;

	public function __construct()
	{
		//$this->DAOTipoCerveza=\DAOS\listaTipoCerveza::getInstance();
		$this->DAORegistrar=\DAOS\RegistrarDAO::getInstance(); //cuando pasemos a BD
	}

		function index() 
		{
			require_once(ROOT . '/Vistas/home.php');
		}




		function nuevo($nombre, $apellido, $domicilio,  $telefono, $email, $pass1, $pass2) 
		{

			//recibo valores y los asigno a variables
			//$nombre =$_POST['nombre'];
			//$apellido =$_POST['apellido'];
			//$domicilio=$_POST ['domicilio'];
			//$telefono=$_POST ['telefono'];
			//$email=$_POST ['email'];
			//$pass1 =$_POST['pass1'];
			//$pass2=$_POST ['pass2'];
			
			$rol='cliente';


			$buscado=$this->DAORegistrar->buscarPorNombre($email);//busco si existe el email en BD
			if ($buscado == null)
			{//entra si el email buscado en BD no existe

				$cliente = new \Modelos\Cliente($nombre, $apellido, $domicilio, $telefono);//creo el cliente				
				$clienteConID = $this->DAORegistrar->insertarDevolverID($cliente);// le paso un cliente sin id, lo guarda en BD y me devuelve el cliente con ID

				if ($pass1 == $pass2)//verifico que coincidan las pass
				{
					$cuentaNueva = new \Modelos\Cuenta($email, $pass1, $rol, $clienteConID->getId() );//creo la cuenta con el ID del cliente
					$this->DAORegistrar->insertarCuenta($cuentaNueva);//agrego la cuenta completa a la BD
					echo "<script> if(alert('Usuario Registrado !'));</script>";
				}
				else
				{
					echo "<script> if(alert('Las contaseñas no coinciden'));</script>";
				}
				
			}
			
			else
			{
					echo "<script> if(alert('El Email ya se encuentra Registrado..'));</script>";
			}

			$this->index();//llamo a la vista
		}//fin nuevo*****
	}
?>