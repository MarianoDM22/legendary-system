<?php namespace Modelos;


class Cuenta
{
    private $id;
	private $email;
	private $password;
	private $rol;
	private $m_Cliente;


	public function __construct($email, $password, $rol, $m_Cliente)
	{
		$this->setEmail($email);
		$this->setPassword($password);
		$this->setRol($rol);
		$this->setMCliente($m_Cliente);
	}
    
    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

 
    public function setEmail($email)
    {
        $this->email = $email;
    }

   
    public function getPassword()
    {
        return $this->password;
    }

 
    public function setPassword($password)
    {
        $this->password = $password;
    }

    
    public function getRol()
    {
        return $this->rol;
    }

    
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    
    public function getMCliente()
    {
        return $this->m_Cliente;
    }

    
    public function setMCliente($m_Cliente)
    {
        $this->m_Cliente = $m_Cliente;
    }
}
?>