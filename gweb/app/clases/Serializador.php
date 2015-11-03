<?php

class Serializador extends ClaseAbstracta
{

    /**
    * Serializar
    */
    public function serializar($dato)
    {
    	//serializar dato
    	$serial = serialize($dato);

    	return $serial;
    }

    /**
    * Des-serializar
    */
    public function desserializar($dato)
    {
    	//Des-serializar dato
    	$desserial = unserialize($dato);

    	return $desserial;
    }

}