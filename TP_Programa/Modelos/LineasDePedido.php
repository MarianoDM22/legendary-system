<?php namespace Modelos;

class LineasDePedido
{
    private $id;
	private $cantidad;
	private $importe;
	private $m_Producto;
    private $idPedido;

    public function __construct($cantidad,  $importe, $m_Producto)
    {
        $this->setCantidad($cantidad);
        $this->setImporte($importe);
        $this->setMProducto($m_Producto);
        $this->setId(null);
        
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }
    public function getImporte()
    {
        return $this->importe;
    }
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }
    public function getMProducto()
    {
        return $this->m_Producto;
    }
    public function setMProducto($m_Producto)
    {
        $this->m_Producto = $m_Producto;

        return $this;
    }
    public function getIdPedido()
    {
        return $this->idPedido;
    }
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

        return $this;
    }
}
?>