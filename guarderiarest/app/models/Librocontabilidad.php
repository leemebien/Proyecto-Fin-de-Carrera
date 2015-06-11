<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Librocontabilidad extends Model
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
    public $fecha;

    /**
     *
     * @var integer
     */
    public $debe;

    /**
     *
     * @var integer
     */
    public $haber;

    /**
     *
     * @var integer
     */
    public $saldo;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Linealibrocontabilidad', 'libro', array('alias' => 'Linealibrocontabilidad'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'fecha' => 'fecha', 
            'debe' => 'debe', 
            'haber' => 'haber', 
            'saldo' => 'saldo'
        );
    }

}
