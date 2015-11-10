<?php

class Personas extends \Phalcon\Mvc\Model
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
    public $dni;

    /**
     *
     * @var string
     */
    public $nombre;

    /**
     *
     * @var string
     */
    public $apellido1;

    /**
     *
     * @var string
     */
    public $apellido2;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'dni' => 'dni', 
            'nombre' => 'nombre', 
            'apellido1' => 'apellido1', 
            'apellido2' => 'apellido2'
        );
    }

}
