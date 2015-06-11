<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Tipo extends Model
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
    public $clave;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Albaran', 'estado', array('alias' => 'Albaran'));
        $this->hasMany('id', 'Articulo', 'tipo', array('alias' => 'Articulo'));
        $this->hasMany('id', 'Entidad', 'tipo', array('alias' => 'Entidad'));
        $this->hasMany('id', 'Factura', 'estado', array('alias' => 'Factura'));
        $this->hasMany('id', 'Informe', 'estado', array('alias' => 'Informe'));
        $this->hasMany('id', 'Informe', 'tipo', array('alias' => 'Informe'));
        $this->hasMany('id', 'Lineamenu', 'orden', array('alias' => 'Lineamenu'));
        $this->hasMany('id', 'Nomina', 'estado', array('alias' => 'Nomina'));
        $this->hasMany('id', 'Pedido', 'estado', array('alias' => 'Pedido'));
        $this->hasMany('id', 'Personaresponsable', 'tipo', array('alias' => 'Personaresponsable'));
        $this->hasMany('id', 'Sala', 'estado', array('alias' => 'Sala'));
        $this->hasMany('id', 'Sala', 'tipo', array('alias' => 'Sala'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'clave' => 'clave', 
            'nombre' => 'nombre', 
            'descripcion' => 'descripcion'
        );
    }

}
