<?php namespace Controladoras;



	class ControlPedido
	{
		private $DAOPedido;
		private $DAOProducto;

			public function __construct()
		{
			
			$this->DAOPedido=\DAOS\PedidosDAO::getInstance(); 
			$this->DAOProducto=\DAOS\ProductosDAO::getInstance();
			
		}


		public function index() 
		{
			
			
			require_once(ROOT . '/Vistas/Cliente/homeCliente.php');
		}


		public function borrar($id)
	   	{
	   		$this->DAOPedido->borrar($id);
	   	}

	   	public function agregarAlCarrito($importe, $cantidad, $id)
	   	{
	   		session_start();

	   		//$cantidad=$_POST['qty'];//tomo la cantidad ingresada
	   		//$importe=$_POST['precio'];
	 
	   		if(	!isset($_SESSION['Carrito']) )
	   		{
	   			$lineaNueva= new \Modelos\LineasDePedido($importe, $cantidad, $id);	

	   			$this->crearSesion($lineaNueva);
	   			echo '<script language="javascript">alert("Producto agregado!");</script>';
	   		}
	   		else
	   		{
	   			//$lineaEncontrada=$this->DAOPedido->buscarPorNombre($producto);

	   			
	   		}

	   		require_once(ROOT . '/Vistas/Cliente/homeCliente.php');
	   	}

	   	public function crearSesion($linea)
		{	
										
			$_SESSION['Carrito']=$lineaCarrito;//guardo el objeto en la session			

		}

		public function getPrecioTotal()
		{

		}

		public function traerTodos()
	   	{
	   		$lineas= array();
	   		$lineas=$this->DAOProducto->traerTodosLineas();

	   		return $lineas;
	   	}
	}
?>