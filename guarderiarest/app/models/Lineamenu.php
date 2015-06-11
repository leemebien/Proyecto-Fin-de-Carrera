<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Lineamenu extends Model
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
    public $nombre;

    /**
     *
     * @var string
     */
    public $descripcion;

    /**
     *
     * @var integer
     */
    public $menu;

    /**
     *
     * @var integer
     */
    public $plato;

    /**
     *
     * @var integer
     */
    public $orden;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('menu', 'Menu', 'id', array('alias' => 'Menu'));
        $this->belongsTo('plato', 'Plato', 'id', array('alias' => 'Plato'));
        $this->belongsTo('orden', 'Tipo', 'id', array('alias' => 'Tipo'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'nombre' => 'nombre', 
            'descripcion' => 'descripcion', 
            'menu' => 'menu', 
            'plato' => 'plato', 
            'orden' => 'orden'
        );
    }

}
