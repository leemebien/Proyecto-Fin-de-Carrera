<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Pedidofacturaalbaran extends Model
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
    public $pedido;

    /**
     *
     * @var integer
     */
    public $factura;

    /**
     *
     * @var integer
     */
    public $albaran;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('albaran', 'Albaran', 'id', array('alias' => 'Albaran'));
        $this->belongsTo('factura', 'Factura', 'id', array('alias' => 'Factura'));
        $this->belongsTo('pedido', 'Pedido', 'id', array('alias' => 'Pedido'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'fecha' => 'fecha', 
            'pedido' => 'pedido', 
            'factura' => 'factura', 
            'albaran' => 'albaran'
        );
    }

}
