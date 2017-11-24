<?php namespace Modelos;


class Pedido
{
    private $id;
	private $estado;
	private $fecha;
	private $m_Cliente;
	private $m_LineasDePedido;//array
	private $m_Envio;
	private $m_Sucursales;//si es null es envio a domicilio


	public function __construct($estado, $fecha, $m_Cliente, $m_LineasDePedido, $m_Envio, $m_Sucursales)
	{
		$this->setEstado($estado);
		$this->setFecha($fecha);
		$this->setMCliente($m_Cliente);
		$this->setMLineasDePedido($m_LineasDePedido);
		$this->setMEnvio($m_Envio);
		$this->setMSucursales($m_Sucursales);
	}

    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEstado()
    {
        return $this->estado;
    }

  
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

  
    public function getFecha()
    {
        return $this->fecha;
    }

    
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

   
    public function getMCliente()
    {
        return $this->m_Cliente;
    }

 
    public function setMCliente($m_Cliente)
    {
        $this->m_Cliente = $m_Cliente;
    }

    
    public function getMLineasDePedido()
    {
        return $this->m_LineasDePedido;
    }

    
    public function setMLineasDePedido($m_LineasDePedido)
    {
        $this->m_LineasDePedido = $m_LineasDePedido;
    }

   
    public function getMEnvio()
    {
        return $this->m_Envio;
    }

    
    public function setMEnvio($m_Envio)
    {
        $this->m_Envio = $m_Envio;
    }

 
    public function getMSucursales()
    {
        return $this->m_Sucursales;
    }

   
    public function setMSucursales($m_Sucursales)
    {
        $this->m_Sucursales = $m_Sucursales;
    }

    public function agragarLineaDePedido()
    {
        
    }

    public function removerLineaDePedido()
    {
    }
}
?>