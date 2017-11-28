<?php namespace Controladoras;

	use \Controladoras\ControlCliente as ControlCliente;

	use DAOS\CuentasDAO as CuentasDAO;
	use DAOS\PedidosDAO as PedidosDAO;
	use DAOS\ProductosDAO as ProductosDAO;
	use DAOS\TiposDeCervezasDAO as TiposDeCervezasDAO;
	use DAOS\LineasDePedidoDAO as LineasDePedidoDAO;
	use DAOS\ClientesDAO as ClientesDAO;
	use DAOS\EnviosDAO as EnviosDAO;
	
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

			$this->DAOCuentas= \DAOS\CuentasDAO::getInstance();
			$this->DAOPedido= \DAOS\PedidosDAO::getInstance();
			$this->DAOProducto= \DAOS\ProductosDAO::getInstance();
			$this->DAOTipoCerveza= \DAOS\TiposDeCervezasDAO::getInstance();
			$this->DAOLineaDePedido= \DAOS\LineasDePedidoDAO::getInstance();
			$this->DAOClientes= \DAOS\ClientesDAO::getInstance();
			$this->DAOEnvio= \DAOS\EnviosDAO::getInstance();
			
			
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
	   		try {
	   			$lineas=$this->DAOProducto->traerTodosLineas();
		    } catch (Exception $e) {
		    	echo "<script>alert('Error al en BBDD al traer Lineas de Pedido'));</script>";
		    }

	   		return $lineas;
	   	}
	   	private function pedidosPorCliente($dato)
	   	{	

	   		/*var_dump($this->DAOCuentas);
			var_dump($this->DAOPedido);
			var_dump($this->DAOProducto);
			var_dump($this->DAOTipoCerveza);
			var_dump($this->DAOLineaDePedido);
			var_dump($this->DAOClientes);
			var_dump($this->DAOEnvio);*/

	   		$pedidos=array();
	   		try {
	   			$pedidos=$this->DAOPedido->pedidosPorCliente($dato);
		    } catch (Exception $e) {
		    	echo "<script>alert('Error al en BBDD al traer los pedidos del cliente'));</script>";
		    }

	   		return $pedidos;
	   	}

		public function traerTodosProductos()
	   	{
	   		$producto=array();
	   		try {
	   			$producto=$this->DAOProducto->traerTodos();
		    } catch (Exception $e) {
		    	echo "<script>alert('Error en BBDD al traer Productos'));</script>";
		    }
	   		
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
			session_start();

			$cuenta = $_SESSION['Login'];

			$instanciaClientes=$this->DAOClientes;//le paso la instancia de la controladora
			$idCliente=$cuenta->getMCliente();//tomo el id de cliente asignado a la cuenta logueada
			$cliente=$instanciaClientes->buscarPorID($idCliente);//RECIBE EL OBJETO CLIENTE O NULL SI NO LO ENCUENTRA

			$producto=$this->traerTodosProductos();
			$instanciaProducto=$this->DAOProducto;

			$pedidos = $this->DAOPedido->pedidosPorCliente($_SESSION['Login']->getMCliente());
			
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
			$idCliente=$_POST['idCliente'];
			$sucursal=$_POST['sucursalElejida'];
			
			//*************************************


			session_start();
			$lineaPedido=$_SESSION['Carrito'];//asigno el carrito a variable

			
			try {
				$cliente=$this->DAOClientes->buscarPorID($idCliente);//busco cliente en bd				
		    } catch (Exception $e) {
		    	echo "<script>alert('Error al buscar Cliente en BBDD'));</script>";
		    }

		    try {
				$cuenta=$this->DAOCuentas->buscarCuentaPorIDCliente($idCliente );//busco la cuenta asociada al cliente			
		    } catch (Exception $e) {
		    	echo "<script>alert('Error al buscar Cliente en BBDD'));</script>";
		    }
			
			if($envio=="Domicilio")
			{

								
				$envioDomicilio = new \Modelos\Envio ($cliente->getDomicilio(), $cuenta->getEmail(), $fechaDomicilio, $horaDesde, $horaHasta, $cliente->getTelefono());//creo obj envio	
				try {
					$envioDomicilio=$this->DAOEnvio->insertarDevolverID($envioDomicilio);//guardo el envio en bd
			    } catch (Exception $e) {
			    	echo "<script>alert('Error al insertar Envio en BBDD'));</script>";
			    }

				$pedido = new \Modelos\Pedido ("Solicitado", $fechaDomicilio, $idCliente, null, $envioDomicilio->getId(), null);
				
				try {
					$pedido=$this->DAOPedido->insertarDevolverID($pedido);//guardo el pedido en bd
			    } catch (Exception $e) {
			    	echo "<script>alert('Error al insertar Pedido en BBDD'));</script>";
			    }


				foreach ($lineaPedido as $pos => $valor)
		    	{
		    		$valor->setIdPedido($pedido->getId());//asigno el id del pedido a la linea de pedido
		    		try {
						$this->DAOLineaDePedido->insertar($valor);//guardo la linea de pedido en bd con la referencia a la id del pedido
				    } catch (Exception $e) {
				    	echo "<script>alert('Error al insertar Linea de Pedido en BBDD'));</script>";
				    }
				}
				
			}

			if($envio=="Sucursal")
			{
					
				$envioSucursal= new \Modelos\Envio ($sucursal, $cuenta->getEmail(), $fechaSucursal, null, null, $cliente->getTelefono());//creo obj envio
				
				try {
					$Envio=$this->DAOEnvio->insertarDevolverID($envioSucursal);//guardo el envio en bd
			    } catch (Exception $e) {
			    	echo "<script>alert('Error al insertar envio en BBDD'));</script>";
			    }

				$pedido = new \Modelos\Pedido ("Solicitado", $fechaSucursal, $idCliente, null, $Envio->getId(), $sucursal);

				try {
					$pedido = $this->DAOPedido->insertarDevolverID($pedido);//guardo el pedido en bd
			    } catch (Exception $e) {
			    	echo "<script>alert('Error al insertar Pedido en BBDD'));</script>";
			    }

				foreach ($lineaPedido as $pos => $valor)
		    	{
		    		$valor->setIdPedido($pedido->getId());//asigno el id del pedido a la linea de pedido
		    		
		    		try {
						$this->DAOLineaDePedido->insertar($valor);//guardo la linea de pedido en bd con la referencia a la id del pedido
				    } catch (Exception $e) {
				    	echo "<script>alert('Error al insertar Linea de Pedido en BBDD'));</script>";
				    }
				}
			}//pasar los id
				

			$this->cerrarSesion();//destruyo la session Carrito
			echo '<script language="javascript">alert("Compra realizada");</script>';
			$this->index();//redirijo al home cliente

			$this->cerrarSesion();//destruyo la session Carrito
			echo '<script language="javascript">alert("Compra realizada");</script>';
			$this->index();//redirijo al home cliente
			
		}
		public function actualizarDatosCliente($nombre,$apellido,$domicilio,$telefono,$Idcliente,$ventana)
		{
			try {
				$cliente=$this->DAOCuentas->buscarClientePorID($Idcliente);//busco el cliente y lo retorno
		    } catch (Exception $e) {
		    	echo "<script>alert('Error al buscar Cliente en BBDD'));</script>";
		    }

			$cliente->setNombre($nombre);//asigno nuevos datos
			$cliente->setApellido($apellido);
			$cliente->setDomicilio($domicilio);
			$cliente->setTelefono($telefono);

			try {
				$this->DAOCuentas->actualizarDatos($cliente);//actualizo BD
		    } catch (Exception $e) {
		    	echo "<script>alert('Error al actualizar datos de Cuenta en BBDD'));</script>";
		    }
		    
		    if(strcmp("check",$ventana)==0)
		    {
		    	$this->checkOut();//vuelvo al checkout
		    }
			if(strcmp("home",$ventana)==0)
			{
				$this->index();//vuelvo al home
			}
		}

		public function actualizarPassword($pass,$newPass,$confirmNewPass,$Idcliente)
		{
			try {
				$cuenta=$this->DAOCuentas->buscarCuentaPorIDCliente($Idcliente);
		    } catch (Exception $e) {
		    	echo "<script>alert('Error al buscar Cliente en BBDD'));</script>";
		    }

		    if($pass==$cuenta->getPassword())
		    {
		    	if ($newPass == $confirmNewPass)//verifico que coincidan las pass
		    	{
		    		$cuenta->setPassword($newPass);//asigno nuevos datos
		    	}
		    	else
				{
					echo "<script> if(alert('Las contaseñas no coinciden'));</script>";
				}
		    }
		    else
			{					
				echo "<script> if(alert('La contraseña es incorrecta'));</script>";
																							
			}

			try {
				$this->DAOCuentas->actualizar($cuenta);//actualizo BD
		    } catch (Exception $e) {
		    	echo "<script>alert('Error al actualizar password en BBDD'));</script>";
		    }

				$this->index();//vuelvo al home			
		}

		public function buscarClientePorId($id)
		{	
			
			var_dump($this->DAOCuentas);

			$cliente = null;

			try {
				$cliente=$this->DAOCuentas->buscarClientePorID($id);
		    } catch (Exception $e) {
		    	echo "<script>alert('Error al buscar Cliente en BBDD'));</script>";
		    }
			
			return $cliente;
		}
		public function destruirCarrito(){
			session_start();
			if (isset($_SESSION["Carrito"]) )//entra si existe la session
			{	
    			
    			unset($_SESSION["Carrito"]);     			
    		}
	   		
	   		$this->index();
		}

	}
?>