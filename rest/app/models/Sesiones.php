<?php

class Sesiones extends \Phalcon\Mvc\Model
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
    public $numerosesion;

    /**
     *
     * @var integer
     */
    public $usuario;

    /**
     *
     * @var string
     */
    public $fechaactual;

    /**
     *
     * @var string
     */
    public $fechacaducidad;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'numerosesion' => 'numerosesion', 
            'usuario' => 'usuario', 
            'fechaactual' => 'fechaactual', 
            'fechacaducidad' => 'fechacaducidad'
        );
    }

}
