<?php

class Personasfotos extends \Phalcon\Mvc\Model
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
    public $idfoto;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'idpersona' => 'idpersona', 
            'idfoto' => 'idfoto'
        );
    }

}
