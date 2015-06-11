<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Linealibrocontabilidad extends Model
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
    public $conceptop;

    /**
     *
     * @var integer
     */
    public $conceptof;

    /**
     *
     * @var integer
     */
    public $concepton;

    /**
     *
     * @var string
     */
    public $descripcion;

    /**
     *
     * @var integer
     */
    public $debe;

    /**
     *
     * @var integer
     */
    public $haber;

    /**
     *
     * @var integer
     */
    public $libro;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('conceptof', 'Factura', 'id', array('alias' => 'Factura'));
        $this->belongsTo('libro', 'Librocontabilidad', 'id', array('alias' => 'Librocontabilidad'));
        $this->belongsTo('concepton', 'Nomina', 'id', array('alias' => 'Nomina'));
        $this->belongsTo('conceptop', 'Pedido', 'id', array('alias' => 'Pedido'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'fecha' => 'fecha', 
            'conceptop' => 'conceptop', 
            'conceptof' => 'conceptof', 
            'concepton' => 'concepton', 
            'descripcion' => 'descripcion', 
            'debe' => 'debe', 
            'haber' => 'haber', 
            'libro' => 'libro'
        );
    }

}
