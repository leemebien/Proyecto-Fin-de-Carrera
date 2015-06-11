<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Entidadfactura extends Model
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
    public $factura;

    /**
     *
     * @var integer
     */
    public $creador;

    /**
     *
     * @var integer
     */
    public $destinatario;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('creador', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('destinatario', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('factura', 'Factura', 'id', array('alias' => 'Factura'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'factura' => 'factura', 
            'creador' => 'creador', 
            'destinatario' => 'destinatario'
        );
    }

}
