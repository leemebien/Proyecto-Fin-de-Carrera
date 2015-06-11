<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Articulo extends Model
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
    public $cantidad;

    /**
     *
     * @var integer
     */
    public $tipo;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Entidadarticulo', 'articulo', array('alias' => 'Entidadarticulo'));
        $this->hasMany('id', 'Entidadinforme', 'articulo', array('alias' => 'Entidadinforme'));
        $this->hasMany('id', 'Lineaalbaran', 'articulo', array('alias' => 'Lineaalbaran'));
        $this->hasMany('id', 'Lineafactura', 'articulo', array('alias' => 'Lineafactura'));
        $this->hasMany('id', 'Lineanomina', 'articulo', array('alias' => 'Lineanomina'));
        $this->hasMany('id', 'Lineapedido', 'articulo', array('alias' => 'Lineapedido'));
        $this->belongsTo('tipo', 'Tipo', 'id', array('alias' => 'Tipo'));
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
            'cantidad' => 'cantidad', 
            'tipo' => 'tipo'
        );
    }

}
