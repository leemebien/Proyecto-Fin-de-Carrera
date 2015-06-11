<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Entidadarticulo extends Model
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
    public $entidad;

    /**
     *
     * @var integer
     */
    public $articulo;

    /**
     *
     * @var integer
     */
    public $precio;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('articulo', 'Articulo', 'id', array('alias' => 'Articulo'));
        $this->belongsTo('entidad', 'Entidad', 'id', array('alias' => 'Entidad'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'entidad' => 'entidad', 
            'articulo' => 'articulo', 
            'precio' => 'precio'
        );
    }

}
