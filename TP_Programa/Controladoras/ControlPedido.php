<?php namespace Controladoras;

	use \Controladoras\ControlCliente as ControlCliente;

	class ControlPedido
	{
		private $DAOCuentas;
		private $DAOPedido;
		private $DAOProducto;
		private $DAOTipoCerveza;
		private $DAOLineaDePedido;
		private $DAOClientes;
		private $DAOEnvio;
		
		

		private $linea;

		public function __construct()
		{
			
			$this->DAOCuentas=\DAOS\CuentasDAO::getInstance();
			$this->DAOPedido=\DAOS\PedidosDAO::getInstance(); 
			$this->DAOProducto=\DAOS\ProductosDAO::getInstance();
			$this->DAOTipoCerveza=\DAOS\TiposDeCervezasDAO::getInstance();
			$this->DAOLineaDePedido=\DAOS\LineasDePedidoDAO::getInstance();
			$this->DAOClientes=\DAOS\ClientesDAO::getInstance();
			$this->DAOEnvio=\DAOS\EnviosDAO::getInstance();
			//$this->DAOSucursales=\DAOS\SucursalesDAO::getInstance();
			
			
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

		private function cerrarSesion()
		{	
			session_start();
			
			if (isset($_SESSION["Carrito"]) )//entra si existe la session
			{	
    			
    			unset($_SESSION["Carrito"]);     			
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
	   		$instanciaClientes=$this->DAOClientes;//le paso la instancia de la controladora
	   		$productos=$this->traerTodosProductos();
	   		$instanciaProducto=$this->DAOProducto;
	   		
	   		require_once(ROOT . '/Vistas/Cliente/checkoutCliente.php');
	   	}

	   	public function index() 
		{
			$producto=$this->traerTodosProductos();
			$instanciaProducto=$this->DAOProducto;
			
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
		public function finalizarCompra()
		{
			
			
			//esto es provisorio, ya que al ser variable la seleccion de envio, cambia el orden en el qe se envian los valores por parametro 	
			$envio=$_POST['radioButton']; 
			$fechaDomicilio=$_POST['fechaDomicilio'];
			$horaDesde=$_POST['horaDesde'];
			$horaHasta=$_POST['horaHasta'];
			$fechaSucursal=$_POST['fechaSucursal'];
			$idCliente=$_POST['id'];
			$sucursal=$_POST['sucursalElejida'];
			//*************************************


			session_start();
			$lineaPedido=$_SESSION['Carrito'];//asigno el carrito a variable

			

			$cliente=$this->DAOClientes->buscarPorID($idCliente);//busco cliente en bd				
			$cuenta=$this->DAOCuentas->buscarCuentaPorIDCliente($idCliente );//busco la cuenta asociada al cliente			
			
			if($envio=="Domicilio")
			{

								
				$envioDomicilio = new \Modelos\Envio ($cliente->getDomicilio(), $cuenta->getEmail(), $fechaDomicilio, $horaDesde, $horaHasta, $cliente->getTelefono());//creo obj envio	

				$envioDomicilio=$this->DAOEnvio->insertarDevolverID($envioDomicilio);//guardo el envio en bd

				$pedido = new \Modelos\Pedido ("Solicitado", $fechaDomicilio, $idCliente, null, $envioDomicilio->getId(), null);
				$pedido=$this->DAOPedido->insertarDevolverID($pedido);//guardo el pedido en bd

				foreach ($lineaPedido as $pos => $valor)
		    	{
		    		$valor->setIdPedido($pedido->getId());//asigno el id del pedido a la linea de pedido
		    		
					$this->DAOLineaDePedido->insertar($valor);//guardo la linea de pedido en bd con la referencia a la id del pedido
				}
				
			}

			if($envio=="Sucursal")
			{
					
				$envioSucursal= new \Modelos\Envio ($sucursal, $cuenta->getEmail(), $fechaSucursal, null, null, $cliente->getTelefono());//creo obj envio

				$Envio=$this->DAOEnvio->insertarDevolverID($envioSucursal);//guardo el envio en bd

				$pedido = new \Modelos\Pedido ("Solicitado", $fechaSucursal, $idCliente, null, $Envio->getId(), $sucursal);
				$pedido = $this->DAOPedido->insertarDevolverID($pedido);//guardo el pedido en bd

				foreach ($lineaPedido as $pos => $valor)
		    	{
		    		$valor->setIdPedido($pedido->getId());//asigno el id del pedido a la linea de pedido
		    		
					$this->DAOLineaDePedido->insertar($valor);//guardo la linea de pedido en bd con la referencia a la id del pedido
				}
			}//pasar los id

			

			

			
			
			//crear objetos linea pedido y envio, y guardarlos en bd antes de crear el obj pedido
			


		    	//envio seleccionado es domicilio
		    	//crear objeto envio
				//crear objeto pedido con los datos que llegan
				//ESTADO DEL PEDIDO se asigna a SOLICITADO
				//guardar pedido en bd con el estado qe corresponda

			
				//retira en sucursal
				//guardar pedido en bd con el estado qe corresponda
				

			$this->cerrarSesion();//destruyo la session Carrito
			echo '<script language="javascript">alert("Compra realizada");</script>';
			$this->index();//redirijo al home cliente

			$this->cerrarSesion();//destruyo la session Carrito
			echo '<script language="javascript">alert("Compra realizada");</script>';
			$this->index();//redirijo al home cliente
			
		}
		public function actualizarDatosEnvio($nombre,$apellido,$domicilio,$telefono,$Idcliente)
		{
			
			$cliente=$this->DAOCuentas->buscarClientePorID($Idcliente);//busco el cliente y lo retorno

			$cliente->setNombre($nombre);//asigno nuevos datos
			$cliente->setApellido($apellido);
			$cliente->setDomicilio($domicilio);
			$cliente->setTelefono($telefono);

			$this->DAOCuentas->actualizarDatos($cliente);//actualizo BD

			$this->checkOut();//vuelvo al checkout

		}

		public function buscarClientePorId($id)
		{	
			var_dump($id);
			var_dump($this->DAOCuentas);

			$cliente=$this->DAOCuentas->buscarClientePorID($id);
			
			return $cliente;
		}

	}
?>