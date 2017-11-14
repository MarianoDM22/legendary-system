<?php namespace Controladoras;



	class ControlPedido
	{
		private $DAOCuentas;
		private $DAOPedido;
		private $DAOProducto;
		private $DAOTipoCerveza;

		public function __construct()
		{
			$this->DAOCuentas=\DAOS\CuentasDAO::getInstance();
			$this->DAOPedido=\DAOS\PedidosDAO::getInstance(); 
			$this->DAOProducto=\DAOS\ProductosDAO::getInstance();
			$this->DAOTipoCerveza=\DAOS\TiposDeCervezasDAO::getInstance();
			
		}


		public function index() 
		{
			$producto=$this->traerTodosProductos();
			
			require_once(ROOT . '/Vistas/Cliente/homeCliente.php');
		}

		public function traerTodosProductos()
	   	{
	   		$producto= array();
	   		$producto=$this->DAOProducto->traerTodos();
	   		
	   		return $producto;
	   	}

		public function borrar($id)
	   	{
	   		$this->DAOPedido->borrar($id);
	   	}

	   	public function agregarAlCarrito($importe, $cantidad, $id)
	   	{
	   		session_start();

	   		if(	!isset($_SESSION['Carrito']) )
	   		{
	   			$lineaNueva= new \Modelos\LineasDePedido($importe, $cantidad, $id);	

	   			$this->crearSesion($lineaNueva);
	   			echo '<script language="javascript">alert("Producto agregado!");</script>';
	   		}
	   		else
	   		{
	   			//$buscarLinea=$this->DAOPedido->buscarPorNombre($producto);

	   			
	   		}

	   		require_once(ROOT . '/Vistas/Cliente/homeCliente.php');
	   	}

	   	public function crearSesion($linea)
		{	
										
			$_SESSION['Carrito']=$linea;//guardo el objeto en la session			

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

	   	public function checkOut()
	   	{
	   		require_once(ROOT . '/Vistas/Cliente/checkoutCliente.php');
	   	}

	}
?>