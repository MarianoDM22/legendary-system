<?php namespace Controladoras;



	class ControlPedido
	{
		private $DAOPedido;

			public function __construct()
		{
			
			$this->DAOPedido=\DAOS\PedidosDAO::getInstance(); 
			
		}


		public function index() 
		{
			
			
			require_once(ROOT . '/Vistas/Cliente/checkoutCliente.php');
		}


		public function borrar()
	   	{
	   		$this->DAOPedido->borrar($_POST['id']);
	   	}

	   	public function agregarAlCarrito()
	   	{
	   		session_start();

	   		$cantidad=$_POST['qty'];//tomo la cantidad ingresada


	   		if(	!isset($_SESSION['Carrito']) )
	   		{
	   			$lineaNueva= new \Modelos\LineasDePedido($qty, );	

	   			$this->crearSesion($lineaNueva);
	   		}
	   		else
	   		{
	   			$lineaEncontrada=$this->DAOPedido->buscarPorNombre($producto);

	   			
	   		}
	   	}

	   	public function crearSesion($linea)
		{	
										
			$_SESSION['Carrito']=$linea;//guardo el objeto logueada en la session			
			echo '<script language="javascript">alert("Producto agregado!");</script>';

		}
	}
?>