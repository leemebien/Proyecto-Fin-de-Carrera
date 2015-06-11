<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Informe extends Model
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
    public $concepto;

    /**
     *
     * @var string
     */
    public $fechacreacion;

    /**
     *
     * @var string
     */
    public $fechaultimamodificacion;

    /**
     *
     * @var integer
     */
    public $tipo;

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
        $this->hasMany('id', 'Entidadinforme', 'informe', array('alias' => 'Entidadinforme'));
        $this->hasMany('id', 'Lineainforme', 'informe', array('alias' => 'Lineainforme'));
        $this->belongsTo('estado', 'Tipo', 'id', array('alias' => 'Tipo'));
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
            'concepto' => 'concepto', 
            'fechacreacion' => 'fechacreacion', 
            'fechaultimamodificacion' => 'fechaultimamodificacion', 
            'tipo' => 'tipo', 
            'estado' => 'estado'
        );
    }

}
