<?php

class Fotos extends \Phalcon\Mvc\Model
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
     * @var longblob
     */
    public $fotobinaria;

    /**
     *
     * @var string
     */
    public $tipo;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'nombre' => 'nombre', 
            'fotobinaria' => 'fotobinaria', 
            'tipo' => 'tipo'
        );
    }

}
