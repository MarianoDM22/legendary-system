<?php namespace Modelos;

class TiposDeCerveza
{
	private $id;
    private $descripcion;
    private $precio_litro;
    private $imagen;

    
    public function __construct($descripcion, $precio_litro, $imagen)
    {
        $this->setDescripcion($descripcion);
       	$this->setPrecio_litro($precio_litro);
        $this->setImagen($imagen);
    }

	public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescripcion()
	{
		return $this->descripcion;
	}
	
	public function setDescripcion($descripcion)
	{
		$this->descripcion = $descripcion;
	}
	
	public function getPrecio_litro()
	{
		return $this->precio_litro;
	}
	
	public function setPrecio_litro($precio_litro)
	{
		$this->precio_litro = $precio_litro;
	}

	public function getImagen()
	{
		return $this->imagen;
	}
	
	public function setImagen($imagen)
	{
		$this->imagen = $imagen;
	}
}
?>