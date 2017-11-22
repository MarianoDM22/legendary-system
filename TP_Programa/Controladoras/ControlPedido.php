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


	   	public function agregarAlCarrito($cantidad, $importe, $id,$descripcion)
	   	{	

	   		session_start();

	   		$cantidad=(int) $cantidad;
	   		if(	!isset($_SESSION['Carrito']) )//si es el primer producto agregado, creo la sesion y lo agrego
	   		{
	   			
	   			$linea= new \Modelos\LineasDePedido($cantidad, $importe, $id);	
	   			
	   			$this->crearSesion();
	   			$this->insertar($linea);

	   			
	   			echo '<script language="javascript">alert("Producto agregado!");</script>';
	   		}
	   		else
	   		{
	   			
	   			
	   			

	   			$lineaBuscada=$this->buscarLinea($id);//si ya hay un carrito activo, busco si ese producto ya existe
	   			   			
	   			

	   			if( $lineaBuscada< 0 )//si no existe, agrrego la linea
	   			{
	   				
	   				$linea= new \Modelos\LineasDePedido($cantidad, $importe, $id);	

		   			$this->insertar($linea);
		   			echo '<script language="javascript">alert("Producto agregado!");</script>';
	   			}
	   			else//si ya existe le sumo la cantidad
	   			{
	   				
	   				$this->incrementarArtPedido($lineaBuscada, $cantidad);
	   				echo '<script language="javascript">alert("Producto actualizado!");</script>';
	   			}
	
	   		}

	   		$this->index();
	   	}

	   	private function crearSesion()
		{	
			

			if(!isset($_SESSION['Carrito']))
			{
				$_SESSION['Carrito'] = array();
			}			

		}

		private function cerrarSesion($linea)
		{	
			$this->linea = Array();

			if(!isset($_SESSION['Carrito']))
			{
				$_SESSION['Carrito'] = $this->linea;
			}			

		}

		private function buscarLinea($idProducto)
		{

          $retorno=-1;

            foreach ( $_SESSION['Carrito'] as $key => $value) 
			{

					if( strcmp($value->getMProducto() , $idProducto) ==0 )
					{	
						$retorno=$key;//asigno la pos del arreglo carrito 
					}
			}
			return $retorno;		
			
		}

		private function buscarLineaID($id)
		{
			$lineaBuscada=null;
		
		 	if( !empty($_SESSION['Carrito']) )
			{	
				
				foreach ( $_SESSION['Carrito'] as $key => $value) 
				{	
					
					
					if( strcmp($value->getId(), $id)==0 )
					{
						
						$lineaBuscada=$key;
					}
				}
			}
			
			
			return $lineaBuscada;
		}

		private function devolverUltimoId()
		{
			if(!empty($_SESSION['Carrito']))
			{	
				
				$rta=end($_SESSION['Carrito'])->getId();
				$rta + 1;
			}
			else
			{
				$rta=null;
			}

			return $rta;
		}

		private function insertar($linea)
		{
		 	$id=$this->devolverUltimoId();
		 	
		 	if ($id ==null)
		 	{
		 		$linea->setId(1
		 		);
		 	}
		 	else
		 	{
		 		$linea->setId($id+1);
		 	}
		 	
		 	
			array_push($_SESSION['Carrito'], $linea);
			
		}

		private function incrementarArtPedido($lineaBuscada, $cantidad)
		{
			$cantidadActualizada=0;

			$cantidadActualizada= ( ($_SESSION['Carrito'][$lineaBuscada]->getCantidad() ) + $cantidad);

			$_SESSION['Carrito'][$lineaBuscada]->setCantidad($cantidadActualizada);

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
	   		$producto=array();
	   		$producto=$this->DAOProducto->traerTodos();
	   		
	   		return $producto;
	   	}

		public function borrar($id)
	   	{
	   		
	   		session_start();

	   		$lineaAborrar=null;
			$lineaAborrar=$this->buscarLineaID($id);//busco la linea			
			unset($_SESSION['Carrito'][$lineaAborrar]);//borro la linea del array de lineas de pedido
			echo '<script language="javascript">alert("Producto eliminado!");</script>';
						
			$this->index();
			
	   	}

	   	public function checkOut()
	   	{
	   		
	   		$productos=$this->traerTodosProductos();
	   		
	   		require_once(ROOT . '/Vistas/Cliente/checkoutCliente.php');
	   	}

	   	public function index() 
		{
			$producto=$this->traerTodosProductos();
			
			require_once(ROOT . '/Vistas/Cliente/homeCliente.php');
		}
		public function sumarLineasPedido($carrito)
		{
			$total=null;
			foreach ($carrito as $pos => $valor)
		    {
				$total= $total + $valor->getCantidad() * $valor->getImporte();//multiplico la cantidad por el importe de cada linea de pedido y la acumulo
			}
			return $total;
		}
	}
?>