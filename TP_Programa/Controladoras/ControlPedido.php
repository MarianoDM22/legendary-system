<?php namespace Controladoras;



	class ControlPedido
	{
		private $DAOCuentas;
		private $DAOPedido;
		private $DAOProducto;
		private $DAOTipoCerveza;

		private $linea;

		public function __construct()
		{
			$this->DAOCuentas=\DAOS\CuentasDAO::getInstance();
			$this->DAOPedido=\DAOS\PedidosDAO::getInstance(); 
			$this->DAOProducto=\DAOS\ProductosDAO::getInstance();
			$this->DAOTipoCerveza=\DAOS\TiposDeCervezasDAO::getInstance();
			
		}


	   	public function agregarAlCarrito($importe, $cantidad, $id)
	   	{
	   		session_start();

	   		if(	!isset($_SESSION['Carrito']) )//si es el primer producto agregado, creo la sesion y lo agrego
	   		{
	   			$linea= new \Modelos\LineasDePedido($importe, $cantidad, $id);	

	   			$this->crearSesion($linea);

	   			$this->insertar($linea);
	   			echo '<script language="javascript">alert("Producto agregado!");</script>';
	   		}
	   		else
	   		{
	   			$lineaBuscada=$this->buscarLinea($id);//si ya hay un carrito activo, busco si ese producto ya existe

	   			if($lineaBuscada==null)//si no existe, agrrego la linea
	   			{
	   				$linea= new \Modelos\LineasDePedido($importe, $cantidad, $id);	

		   			$this->insertar($linea);
		   			echo '<script language="javascript">alert("Producto agregado!");</script>';
	   			}
	   			else//si ya existe le sumo la cantidad
	   			{
	   				$this->incrementarArtPedido($lineaBuscada, $cantidad);
	   				echo '<script language="javascript">alert("Producto actualizado!");</script>';
	   			}
	
	   		}

	   		require_once(ROOT . '/Vistas/Cliente/homeCliente.php');
	   	}

	   	private function crearSesion($linea)
		{	
			$this->linea = Array();

			if(!isset($_SESSION['Carrito']))
			{
				$_SESSION['Carrito'] = $this->linea;
			}			

		}

		private function buscarLinea($id)
		{
			$lineaBuscada=null;

		 	if( !empty($_SESSION['Carrito']) )
			{
				foreach ( $_SESSION['Carrito'] as $key => $value) 
				{
					if( strcmp($id, $value->getId())==0 )
					{
						$lineaBuscada=$value;
					}
				}
			}

			return $lineaBuscada;
		}

		private function devolverUltimoId()
		{
			$rta=0;

			if(!empty($_SESSION['Carrito']))
			{
				$rta=end($_SESSION['Carrito'])->getId();
			}

			return $rta + 1;
		}

		private function insertar($linea)
		{
		 	$id=$this->devolverUltimoId();
		 	$linea->setId($id);
		 	
			array_push($_SESSION['Carrito'], $linea);
		}

		private function incrementarArtPedido($lineaBuscada, $cantidad)
		{
			$cantidadActualizada=0;

			$cantidadActualizada= ( ($lineaBuscada->getCantidad()) + $cantidad);

			$lineaBuscada->setCantidad($cantidadActualizada);
		}

		private function getPrecioSubTotal($linea)
		{
			$subTotal=0;

			$subTotal=( ($linea->getCantidad()) * ($linea->getImporte()) );

			return $subTotal;
		}

		private function getPrecioTotal()
		{
			$total=0;

			if(isset($_SESSION['Carrito']))
			{

			
			}

			return $total;
		}

		private function traerTodos()
	   	{
	   		$lineas=array();
	   		$lineas=$this->DAOProducto->traerTodosLineas();

	   		return $lineas;
	   	}

		public function traerTodosProductos()
	   	{
	   		$producto= array();
	   		$producto=$this->DAOProducto->traerTodos();
	   		
	   		return $producto;
	   	}

		public function borrar($id)
	   	{
	   		$lineaAborrar=null;

			$lineaAborrar=$this->buscar($id);
			array_pop($_SESSION['TipoCerveza'], $lineaAborrar);
	   	}

	   	public function checkOut()
	   	{
	   		require_once(ROOT . '/Vistas/Cliente/checkoutCliente.php');
	   	}

	   	public function index() 
		{
			$producto=$this->traerTodosProductos();
			
			require_once(ROOT . '/Vistas/Cliente/homeCliente.php');
		}
	}
?>