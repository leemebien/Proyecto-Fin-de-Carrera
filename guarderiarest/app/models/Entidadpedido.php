<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Entidadpedido extends Model
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
    public $pedido;

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
        $this->belongsTo('pedido', 'Pedido', 'id', array('alias' => 'Pedido'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'pedido' => 'pedido', 
            'creador' => 'creador', 
            'destinatario' => 'destinatario'
        );
    }

}
