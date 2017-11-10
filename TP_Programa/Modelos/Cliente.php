<?php namespace Modelos;


class Cliente
{
    private $id;
    private $nombre;
	private $apellido;
	private $domicilio;
	
	private $telefono;
	private $m_Cuenta;
	private $m_Pedido=array();


	public function __construct($nombre, $apellido, $domicilio, $telefono)
	{
        $this->setNombre($nombre);
		$this->setApellido($apellido);
		$this->setDomicilio($domicilio);
		$this->setTelefono($telefono);
	}

    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

   
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

   
    public function getDomicilio()
    {
        return $this->domicilio;
    }

   
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }

   
    public function getNombre()
    {
        return $this->nombre;
    }

    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

        public function getTelefono()
    {
        return $this->telefono;
    }

  
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

   
    public function getMCuenta()
    {
        return $this->m_Cuenta;
    }

   
    public function setMCuenta($m_Cuenta)
    {
        $this->m_Cuenta = $m_Cuenta;
    }

   
    public function getMPedido()
    {
        return $this->m_Pedido;
    }


    public function setMPedido($m_Pedido)
    {
        if(!is_null($m_Pedido)){
            $this->m_Pedido = $m_Pedido;
        }
    }
}
?>