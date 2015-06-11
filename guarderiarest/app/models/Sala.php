<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Sala extends Model
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
    public $aforo;

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
     *
     * @var integer
     */
    public $centro;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Entidadcursosala', 'sala', array('alias' => 'Entidadcursosala'));
        $this->hasMany('id', 'Entidadinforme', 'sala', array('alias' => 'Entidadinforme'));
        $this->belongsTo('centro', 'Centro', 'id', array('alias' => 'Centro'));
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
            'descripcion' => 'descripcion', 
            'aforo' => 'aforo', 
            'tipo' => 'tipo', 
            'estado' => 'estado', 
            'centro' => 'centro'
        );
    }

}
