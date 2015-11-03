<?php

use Phalcon\Crypt;

class Encriptador extends ClaseAbstracta
{

    /**
     *
     * @var string
     */
    private $key;

    /**
     *
     * @var Crypt
     */
    private $cripto;

    /**
    * Constructor
    */
    public function Encriptador()
    {
        //Creamos el objeto
        $cripto = new Crypt();

        //Establecemos el algoritmo
        $cripto->setCipher('blowfish');

        //Asignar cripto
        $this->putCripto($cripto);

        //Generar y asignar key
        $key = date('d/m/y');   
        $this->putKey($key);
    }

    /**
    * Coger valor key
    */
    public function getKey()
    {
        return $this->key;
    }

    /**
    * Poner valor key
    */
    public function putKey($key)
    {
        $this->key = $key;
    }

    /**
    * Coger valor cripto
    */
    public function getCripto()
    {
        return $this->cripto;
    }

    /**
    * Poner valor cripto
    */
    public function putCripto($cripto)
    {
        $this->cripto = $cripto;
    }
	
	/**
    * Encriptar dato
    */
    public function encriptar($dato)
    {
    	$encript = $this->getCripto()->encryptBase64($dato,$this->getKey());

    	return $encript;
    }

    /**
    * Desencriptar dato
    */
    public function desencriptar($dato)
    {
    	$descript = $this->getCripto()->decryptBase64($dato,$this->getKey());

    	return $descript;
    }

}