<?php

class Rolesusuarios extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idusuario;

    /**
     *
     * @var integer
     */
    public $idrol;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'idusuario' => 'idusuario', 
            'idrol' => 'idrol'
        );
    }

}
