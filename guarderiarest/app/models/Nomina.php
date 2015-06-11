<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Nomina extends Model
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
        $this->hasMany('id', 'Entidadnomina', 'nomina', array('alias' => 'Entidadnomina'));
        $this->hasMany('id', 'Linealibrocontabilidad', 'concepton', array('alias' => 'Linealibrocontabilidad'));
        $this->hasMany('id', 'Lineanomina', 'nomina', array('alias' => 'Lineanomina'));
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
