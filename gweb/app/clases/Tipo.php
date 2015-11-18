<?php

class Tipo extends ClaseAbstracta
{

    /**
     *
     * @var integer
     */
    private $id;

    /**
     *
     * @var string
     */
    private $nombre;

    /**
    * Guardar valores
    */
    public function putTipo($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    /**
    * Coger valor id
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Coner valor id
    */
    public function putId($id)
    {
        $this->id = $id;
    }

    /**
    * Coger valor nombre
    */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
    * Coner valor nombre
    */
    public function putNombre($nombre)
    {
        $this->nombre = $nombre;
    }

}