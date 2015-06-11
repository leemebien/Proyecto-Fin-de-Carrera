<?php

class Empresa extends \Phalcon\Mvc\Model
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
    public $centro;

    /**
     *
     * @var string
     */
    public $nombre;

    /**
     *
     * @var string
     */
    public $direccion;

    /**
     *
     * @var integer
     */
    public $telefono;

    /**
     *
     * @var integer
     */
    public $contacto;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Contenidoweb', 'empresa', array('alias' => 'Contenidoweb'));
        $this->belongsTo('contacto', 'Entidad', 'id', array('alias' => 'Entidad'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'centro' => 'centro', 
            'nombre' => 'nombre', 
            'direccion' => 'direccion', 
            'telefono' => 'telefono', 
            'contacto' => 'contacto'
        );
    }

}
