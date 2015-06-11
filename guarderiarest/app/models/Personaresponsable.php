<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Personaresponsable extends Model
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
    public $alumno;

    /**
     *
     * @var integer
     */
    public $responsable;

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
        $this->belongsTo('alumno', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('responsable', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('tipo', 'Tipo', 'id', array('alias' => 'Tipo'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'alumno' => 'alumno', 
            'responsable' => 'responsable', 
            'tipo' => 'tipo'
        );
    }

}
