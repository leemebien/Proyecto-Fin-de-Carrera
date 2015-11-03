<?php

class Observacion extends ClaseAbstracta
{

	/**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $fecha;

    /**
     *
     * @var string
     */
    public $texto;

    /**
    * Guardar valores
    */
    public function putObservacion($id, $fecha, $texto)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->texto = $texto;
    }

    /**
    * Coger valor id
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Coger valor fecha
    */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
    * Coger valor texto
    */
    public function getTexto()
    {
        return $this->texto;
    }

}