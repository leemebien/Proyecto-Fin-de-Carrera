<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Entidadinforme extends Model
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
    public $informe;

    /**
     *
     * @var integer
     */
    public $usuariocreador;

    /**
     *
     * @var integer
     */
    public $usuarioultimamodificacion;

    /**
     *
     * @var integer
     */
    public $articulo;

    /**
     *
     * @var integer
     */
    public $sala;

    /**
     *
     * @var integer
     */
    public $entidad;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('articulo', 'Articulo', 'id', array('alias' => 'Articulo'));
        $this->belongsTo('entidad', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('usuariocreador', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('usuarioultimamodificacion', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('informe', 'Informe', 'id', array('alias' => 'Informe'));
        $this->belongsTo('sala', 'Sala', 'id', array('alias' => 'Sala'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'informe' => 'informe', 
            'usuariocreador' => 'usuariocreador', 
            'usuarioultimamodificacion' => 'usuarioultimamodificacion', 
            'articulo' => 'articulo', 
            'sala' => 'sala', 
            'entidad' => 'entidad'
        );
    }

}
