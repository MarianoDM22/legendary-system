<?php namespace Controladoras;

class ControlPedido
{
	$DAOPedido=ListaPedido.getInstance();
	//$DAOPedido=BDCPedido.getInstance(); //cuando pasemos a BD

	public function Nuevo
	{
		//crea el objeto
		//llama al DAO para insertarlo
		
		$DAOPedido->Insertar(objetoCreado)
	}

	 public function getTipoDeCerveza()
    {
    	ControlGestionTipoCerveza=new ControlGestionTipoCerveza();

        return ControlGestionTipoCerveza.getTipoDeCerveza();
    }

}
?>