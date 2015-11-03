<?php

class Menu extends ClaseAbstracta
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
     * @var platos (Campo-Valor)
     */
    public $lista;

    /**
    * Guardar valores
    */
    public function putMenu($id, $nombre, $fecha, $lista)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->lista = $lista;
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

}