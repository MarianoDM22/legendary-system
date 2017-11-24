<?php namespace Controladoras;

	
	class ControlLogin
	{
		private $DAOCuentas;
		

		public function __construct()
		{
			
			$this->DAOCuentas=\DAOS\CuentasDAO::getInstance(); 
		
			
		}	



		public function index()
		{

			if(isset($_SESSION['Login']))//Si hay session:
			{
				

				if($_SESSION['Login']->getRol()=="adm")//SI ES ADMIN LO LLEVA A SU PAG
				{
					$var= new ControlGestionTipoCerveza;
					$var->index();
				}
				if($_SESSION['Login']->getRol()=="cliente")// SI ES CLIENTE AL HOME DE CLIENTE
				{
					
					$var= new ControlPedido;
					$var->index();
				}
			}

			else
			{
				require_once(ROOT . '/Vistas/home.php');//SI NO HAY SESSION LO LLEVA A HOME
				//header('Location: ../Vistas/home.php');
			}
		}


		public function verificarSesion($emailBuscado, $passLogin)
		{
			session_start();
			
			if(	!isset($_SESSION['Login']) )//entra si la sesion Login NO existe			
			{	
		
				//$emailBuscado=$_POST['email'];//tomo mail ingresado
				//$passLogin=$_POST['passLogin'];//tomo password ingresada
				try {
					$buscado=$this->DAOCuentas->buscarPorNombre($emailBuscado);//busco si existe el email en BD ,devuelve null o el objeto CUENTA
			    } catch (Exception $e) {
			    	echo "<script>alert('Error al buscar datos del Login en BBDD'));</script>";
			    }

				if ( $buscado !=null)//entra si encontro el mail
				{
					if ($passLogin==$buscado->getPassword())//verifica que el pass de la BD sea igual que el ingresado
					{	
						$this->crearSesion($buscado);//llamo a crear session(para modularizar) y le paso la CUENTA encontrada en BD
					}

					else
					{
						echo "<script> if(alert('E-Mail y/o Contraseña icorrectos!'));</script>";
						$this->index();
					}					
				}
				
				else
				{					
						echo "<script> if(alert('El E-Mail ingresado no se encuentra Registrado'));</script>";
						$this->index();										
									
				}
				
			}//fin if general session

			else//entra si la session LOGIN EXISTE... 
			{
				
				echo "<script> if(alert('ERROR! Usuario actualmente logueado'));</script>";
				$this->index();
				
			}//fin else general
			
		}//fin verificar session**********


		public function crearSesion($cuenta)
		{	
										
			$_SESSION['Login']=$cuenta;//guardo el objeto CUENTA logueada en la session			
			echo '<script language="javascript">alert("Bienvenido '.$cuenta->getEmail(). '!");</script>';
			$this->index();

		}//fin crear session**********

		public function cerrarSesion()
		{	
			session_start();
			
			if (isset($_SESSION['Login']) )//entra si existe la session
			{	
    			unset($_SESSION["Login"]);
    			unset($_SESSION["Carrito"]);     			
    			$this->index();
			}

			else
			{
				echo '<script language="javascript">alert("Ningun usuario logueado!");</script>';
				$this->index();
			}			

		}//fin crear session**********


		public function nuevo($nombre, $apellido, $domicilio,  $telefono, $email, $pass1, $pass2) 
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
			
			try {
				$buscado=$this->DAOCuentas->buscarPorNombre($email);//busco si existe el email en BD
		    } catch (Exception $e) {
		    	echo "<script>alert('Error al buscar datos del Login en BBDD'));</script>";
		    }
			if ($buscado == null)
			{//entra si el email buscado en BD no existe

				$cliente = new \Modelos\Cliente($nombre, $apellido, $domicilio, $telefono);//creo el cliente
				try {
					$clienteConID = $this->DAOCuentas->insertarDevolverID($cliente);// le paso un cliente sin id, lo guarda en BD y me devuelve el cliente con ID
			    } catch (Exception $e) {
			    	echo "<script>alert('Error al insertar datos de Login en BBDD'));</script>";
			    }				
				
				if ($pass1 == $pass2)//verifico que coincidan las pass
				{
					$cuentaNueva = new \Modelos\Cuenta($email, $pass1, $rol, $clienteConID->getId() );//creo la cuenta con el ID del cliente
					try {
						$this->DAOCuentas->insertarCuenta($cuentaNueva);//agrego la cuenta completa a la BD
						echo "<script> if(alert('Usuario Registrado !'));</script>";
				    } catch (Exception $e) {
				    	echo "<script>alert('Error al insertar Cuenta en BBDD'));</script>";
				    }
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

	}//fin clase control 
?>