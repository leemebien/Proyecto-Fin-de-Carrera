<?php

class Datoenvio extends ClaseAbstracta
{

	/**
	 *
	 * @var Sesion
	 */
    private $sesion;

    /**
     *
     * @var objeto
     */
    private $dato;

    /**
    * Constructor
    */
    public function Datoenvio()
    {
    }

    /**
    * Obtener datos para enviar
    */
    public function enviarDatos($sesion, $dato)
    {
        $this->putSesion($sesion);
        $this->putDato($dato);

        //Seralizamos el objeto
        $serial = new Serializador();
        $info = $serial->serializar($this);

        //Encriptamos la informacion
        $encrip = new Encriptador();
        $envio = $encrip->encriptar($info);

        return $envio;
    }

    /**
    * Obtener datos para enviar
    */
    public function obtenerDatos($envio)
    {
    	//Desencriptamos la informacion
    	$descrip = new Encriptador();
        $info = $descrip->desencriptar($envio);

    	//Des-serializamos el objeto
    	$serial = new Serializador();
		$objeto = $serial->desserializar($info);

		//Guarda los componentes de la informacion
        $this->putSesion($objeto->getSesion());
        $this->putDato($objeto->getDato());
    }

    /**
    * Coger valor sesion
    */
    public function getSesion()
    {
        return $this->sesion;
    }

    /**
    * Poner valor sesion
    */
    public function putSesion($sesion)
    {
        $this->sesion = $sesion;
    }

    /**
    * Coger valor dato
    */
    public function getDato()
    {
        return $this->dato;
    }

    /**
    * Poner valor dato
    */
    public function putDato($dato)
    {
        $this->dato = $dato;
    }

}