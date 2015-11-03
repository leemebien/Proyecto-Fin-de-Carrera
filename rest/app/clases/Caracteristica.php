<?php

class Caracteristica extends ClaseAbstracta
{

    /**
    *
    * @var integer
    */
    public $id;

    /**
    *
    * @var lista (Campo-Valor)
    */
    public $lista;

    /**
    * Guardar valores
    */
    public function putCaracteristica($id, $lista)
    {
        $this->id = $id;
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
    * Coger valor lista
    */
    public function getLista()
    {
        return $this->lista;
    }

}