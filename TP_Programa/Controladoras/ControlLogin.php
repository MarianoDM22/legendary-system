<?php namespace Controladoras;

	
	class ControlLogin
	{
		private $DAOLogin;

		public function __construct()
		{
			//$this->DAOTipoCerveza=\DAOS\listaTipoCerveza::getInstance();
			$this->DAOLogin=\DAOS\LoginDAO::getInstance(); //cuando pasemos a BD
		}	

		function index()
		{
			require_once(ROOT . '/Vistas/home.php');
		}


		function verificarSesion()
		{
			session_start();
			
			if(	!isset($_SESSION['Login']) )//entra si la sesion Login existe			
			{	
		
				$emailBuscado=$_POST['email'];//tomo mail ingresado
				$passLogin=$_POST['passLogin'];//tomo password ingresada

				$buscado=$this->DAOLogin->buscarPorNombre($emailBuscado);//busco si existe el email en BD ,devuelve null o el objeto CUENTA

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
					if( ($passLogin=='1234') && ($emailBuscado=='admin@mdp') )//verifica si los datos ingresados son de ADM y crea la session como rol 'adm'
					{					
						$cuenta=  new \Modelos\Cuenta('admin@mdp', '1234', 'adm','null');//creo objeto cuenta con datos como adm y creo la session como adm
						$this->crearSesion($cuenta);//llamo a crear session y le paso la CUENTA de adm
					}
					else
					{
						echo "<script> if(alert('El E-Mail ingresado no se encuentra Registrado'));</script>";
						$this->index();
					}					
									
				}
				
			}//fin if general session

			else//entra si la session LOGIN EXISTE... 
			{
				
				echo "<script> if(alert('ERROR! Usuario actualmente logueado'));</script>";
				$this->index();
				
			}//fin else general
			
		}//fin verificar session**********


		function crearSesion($cuenta)
		{	
										
			$_SESSION['Login']=$cuenta;//guardo el objeto CUENTA logueada en la session			
			echo '<script language="javascript">alert("Bienvenido '.$cuenta->getEmail(). '!");</script>';
			$this->index();

		}//fin crear session**********

		function cerrarSesion()
		{	
			session_start();
			
			if (isset($_SESSION['Login']) )//entra si existe la session
			{	
    			unset($_SESSION["Login"]);
    			echo '<script language="javascript">alert("LogOut correcto !");</script>';
    			$this->index();
			}

			else
			{
				echo '<script language="javascript">alert("Ningun usuario logueado!");</script>';
				$this->index();
			}			

		}//fin crear session**********



	}//fin classe control LOGIN********************************************
?>