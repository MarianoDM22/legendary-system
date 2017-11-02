<?php namespace Modelos;


class Producto
{
    private $id;
    private $descripcion;
    private $m_TiposDeCerveza;
    private $capacidad;
    private $factor;
    private $precio;
    private $imagen;


    public function __construct($descripcion,  $m_TiposDeCerveza, $capacidad, $factor, $imagen , $precio)
    {
        $this->setDescripcion($descripcion);
        $this->setMTiposDeCerveza($m_TiposDeCerveza);
        $this->setCapacidad($capacidad);
        $this->setFactor($factor);
        $this->setImagen($imagen);
        $this->setPrecio($precio);
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

     public function getMTiposDeCerveza()
    {
        return $this->m_TiposDeCerveza;
    }

   
    public function setMTiposDeCerveza($m_TiposDeCerveza)
    {
        $this->m_TiposDeCerveza = $m_TiposDeCerveza;
    }

    public function getCapacidad()
    {
        return $this->capacidad;
    }

 
    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;
    }

    
    public function getFactor()
    {
        return $this->factor;
    }

   
    public function setFactor($factor)
    {
        $this->factor = $factor;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

   
    public function setPrecio($precio)
    {
        $this->precio = $precio;
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