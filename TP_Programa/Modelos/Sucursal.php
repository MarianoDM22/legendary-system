<?php namespace Modelos;

class Sucursal
{
    private $id;
    private $nombre;
	private $domicilio;
	private $latitud;
	private $longitud;
	


	public function __construct($nombre, $domicilio, $latitud, $longitud)
	{
        $this->setNombre($nombre);
		$this->setDomicilio($domicilio);
		$this->setLatitud($latitud);
		$this->setLongitud($longitud);	
	}

    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }
  
  
    public function getNombre()
    {
        return $this->nombre;
    }

   
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }	


    public function getDomicilio()
    {
        return $this->domicilio;
    }


    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }

  
    public function getLatitud()
    {
        return $this->latitud;
    }

   
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }

   
    public function getLongitud()
    {
        return $this->longitud;
    }

    
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }

}
?>