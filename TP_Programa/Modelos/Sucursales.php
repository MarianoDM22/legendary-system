<?php namespace Modelos;

class Sucursales
{
    private $id;
	private $domicilio;
	private $latitud;
	private $longitud;
	private $nombre;


	public function __construct($domicilio, $latitud, $longitud, $nombre)
	{
		$this->setDomicilio($domicilio);
		$this->setLatitud($latitud);
		$this->setLongitud($longitud);
		$this->setNombre($nombre);
	}

    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
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

  
    public function getNombre()
    {
        return $this->nombre;
    }

   
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}
?>