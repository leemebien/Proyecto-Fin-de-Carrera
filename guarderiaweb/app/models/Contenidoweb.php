<?php

class Contenidoweb extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $empresa;

    /**
     *
     * @var integer
     */
    public $centro;

    /**
     *
     * @var integer
     */
    public $tipo;

    /**
     *
     * @var integer
     */
    public $orden;

    /**
     *
     * @var string
     */
    public $mensaje;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('empresa', 'Empresa', 'id', array('alias' => 'Empresa'));
        $this->belongsTo('tipo', 'Tipo', 'id', array('alias' => 'Tipo'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'empresa' => 'empresa', 
            'centro' => 'centro', 
            'tipo' => 'tipo', 
            'orden' => 'orden', 
            'mensaje' => 'mensaje'
        );
    }

}
