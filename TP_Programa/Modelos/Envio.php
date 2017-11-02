<?php namespace Modelos;

class Envio
{
    private $id;
	private $domicilio;
	private $email;
	private $fecha_programada;
	private $hora_desde;
	private $hora_hasta;
	private $telefono;

	public function __construct($domicilio, $email, $fecha_programada, $hora_desde, $hora_hasta, $telefono)
	{
		$this->setDomicilio($domicilio);
		$this->setEmail($email);
		$this->setFechaProgramada($fecha_programada);
		$this->setHoraDesde($hora_desde);
		$this->setHoraHasta($hora_hasta);
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
	
    public function getDomicilio()
    {
        return $this->domicilio;
    }

 
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }

   
    public function getFechaProgramada()
    {
        return $this->fecha_programada;
    }

  
    public function setFechaProgramada($fecha_programada)
    {
        $this->fecha_programada = $fecha_programada;
    }

   
    public function getHoraDesde()
    {
        return $this->hora_desde;
    }

  
    public function setHoraDesde($hora_desde)
    {
        $this->hora_desde = $hora_desde;
    }

 
    public function getHoraHasta()
    {
        return $this->hora_hasta;
    }

    
    public function setHoraHasta($hora_hasta)
    {
        $this->hora_hasta = $hora_hasta;
    }

    
    public function getTelefono()
    {
        return $this->telefono;
    }

   
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }
}
?>