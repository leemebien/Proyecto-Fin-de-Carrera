<?php

class Medicina extends ClaseAbstracta
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
    public $nombre;

    /**
     *
     * @var string
     */
    public $fecha;

    /**
     *
     * @var medicina (Campo-Valor)
     */
    public $lista;

    /**
     *
     * @var texto
     */
    public $texto;

    /**
    * Guardar valores
    */
    public function putMedicina($id, $nombre, $fecha, $lista, $texto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->lista = $lista;
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
    * Coger valor nombre
    */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
    * Coger valor fecha
    */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
    * Coger valor lista
    */
    public function getLista()
    {
        return $this->lista;
    }

    /**
    * Coger valor texto
    */
    public function getTexto()
    {
        return $this->texto;
    }

}