<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Lineainforme extends Model
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
    public $descripcion;

    /**
     *
     * @var integer
     */
    public $informe;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('informe', 'Informe', 'id', array('alias' => 'Informe'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'descripcion' => 'descripcion', 
            'informe' => 'informe'
        );
    }

}
