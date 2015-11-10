<?php

class Personasusuarios extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idpersona;

    /**
     *
     * @var integer
     */
    public $idusuario;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'idpersona' => 'idpersona', 
            'idusuario' => 'idusuario'
        );
    }

}
