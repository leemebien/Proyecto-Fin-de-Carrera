<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Entidadcursosala extends Model
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
    public $curso;

    /**
     *
     * @var integer
     */
    public $sala;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('curso', 'Curso', 'id', array('alias' => 'Curso'));
        $this->belongsTo('entidad', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('sala', 'Sala', 'id', array('alias' => 'Sala'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'entidad' => 'entidad', 
            'curso' => 'curso', 
            'sala' => 'sala'
        );
    }

}
