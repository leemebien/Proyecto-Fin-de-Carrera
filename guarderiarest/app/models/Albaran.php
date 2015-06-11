<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Albaran extends Model
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
    public $fecha;

    /**
     *
     * @var integer
     */
    public $saldo;

    /**
     *
     * @var integer
     */
    public $estado;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Entidadalbaran', 'albaran', array('alias' => 'Entidadalbaran'));
        $this->hasMany('id', 'Lineaalbaran', 'albaran', array('alias' => 'Lineaalbaran'));
        $this->hasMany('id', 'Pedidofacturaalbaran', 'albaran', array('alias' => 'Pedidofacturaalbaran'));
        $this->belongsTo('estado', 'Tipo', 'id', array('alias' => 'Tipo'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'fecha' => 'fecha', 
            'saldo' => 'saldo', 
            'estado' => 'estado'
        );
    }

}
