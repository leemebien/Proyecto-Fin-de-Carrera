<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Entidadnomina extends Model
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
    public $nomina;

    /**
     *
     * @var integer
     */
    public $creador;

    /**
     *
     * @var integer
     */
    public $destinatario;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('creador', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('destinatario', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('nomina', 'Nomina', 'id', array('alias' => 'Nomina'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'nomina' => 'nomina', 
            'creador' => 'creador', 
            'destinatario' => 'destinatario'
        );
    }

}
