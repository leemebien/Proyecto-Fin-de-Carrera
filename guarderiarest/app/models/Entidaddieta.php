<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Entidaddieta extends Model
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
    public $dieta;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('dieta', 'Dieta', 'id', array('alias' => 'Dieta'));
        $this->belongsTo('alumno', 'Entidad', 'id', array('alias' => 'Entidad'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'alumno' => 'alumno', 
            'dieta' => 'dieta'
        );
    }

}
