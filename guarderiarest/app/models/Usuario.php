<?php
 
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;
 


class Usuario extends Model
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
    public $password;

    /**
     *
     * @var integer
     */
    public $entidad;

    /**
     *
     * @var integer
     */
    public $rol;

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
        $this->belongsTo('entidad', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('rol', 'Rol', 'id', array('alias' => 'Rol'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'nombre' => 'nombre', 
            'password' => 'password', 
            'entidad' => 'entidad', 
            'rol' => 'rol', 
            'estado' => 'estado'
        );
    }

}
