<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Lineanomina extends Model
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
    public $articulo;

    /**
     *
     * @var integer
     */
    public $cantidad;

    /**
     *
     * @var integer
     */
    public $precio;

    /**
     *
     * @var integer
     */
    public $nomina;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('articulo', 'Articulo', 'id', array('alias' => 'Articulo'));
        $this->belongsTo('nomina', 'Nomina', 'id', array('alias' => 'Nomina'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'articulo' => 'articulo', 
            'cantidad' => 'cantidad', 
            'precio' => 'precio', 
            'nomina' => 'nomina'
        );
    }

}
