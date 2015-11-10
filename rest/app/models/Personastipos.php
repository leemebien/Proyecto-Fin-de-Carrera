<?php

class Personastipos extends \Phalcon\Mvc\Model
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
    public $idtipo;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'idpersona' => 'idpersona', 
            'idtipo' => 'idtipo'
        );
    }

}
