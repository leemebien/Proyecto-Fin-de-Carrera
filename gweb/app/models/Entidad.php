<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class Entidad extends \Phalcon\Mvc\Model
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
    public $tipo;

    /**
     *
     * @var string
     */
    public $dni;

    /**
     *
     * @var string
     */
    public $nombre;

    /**
     *
     * @var string
     */
    public $apellido1;

    /**
     *
     * @var string
     */
    public $apellido2;

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
    public $movil;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $sexo;

    /**
     *
     * @var string
     */
    public $fechanacimiento;

    /**
     *
     * @var string
     */
    public $cuenta;

    /**
     *
     * @var integer
     */
    public $salario;

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Empresa', 'contacto', array('alias' => 'Empresa'));
        $this->hasMany('id', 'Entidadalbaran', 'creador', array('alias' => 'Entidadalbaran'));
        $this->hasMany('id', 'Entidadalbaran', 'destinatario', array('alias' => 'Entidadalbaran'));
        $this->hasMany('id', 'Entidadarticulo', 'entidad', array('alias' => 'Entidadarticulo'));
        $this->hasMany('id', 'Entidadcursosala', 'entidad', array('alias' => 'Entidadcursosala'));
        $this->hasMany('id', 'Entidaddieta', 'alumno', array('alias' => 'Entidaddieta'));
        $this->hasMany('id', 'Entidadfactura', 'creador', array('alias' => 'Entidadfactura'));
        $this->hasMany('id', 'Entidadfactura', 'destinatario', array('alias' => 'Entidadfactura'));
        $this->hasMany('id', 'Entidadinforme', 'entidad', array('alias' => 'Entidadinforme'));
        $this->hasMany('id', 'Entidadinforme', 'usuariocreador', array('alias' => 'Entidadinforme'));
        $this->hasMany('id', 'Entidadinforme', 'usuarioultimamodificacion', array('alias' => 'Entidadinforme'));
        $this->hasMany('id', 'Entidadnomina', 'creador', array('alias' => 'Entidadnomina'));
        $this->hasMany('id', 'Entidadnomina', 'destinatario', array('alias' => 'Entidadnomina'));
        $this->hasMany('id', 'Entidadpedido', 'creador', array('alias' => 'Entidadpedido'));
        $this->hasMany('id', 'Entidadpedido', 'destinatario', array('alias' => 'Entidadpedido'));
        $this->hasMany('id', 'Personaresponsable', 'alumno', array('alias' => 'Personaresponsable'));
        $this->hasMany('id', 'Personaresponsable', 'responsable', array('alias' => 'Personaresponsable'));
        $this->hasMany('id', 'Usuario', 'entidad', array('alias' => 'Usuario'));
        $this->belongsTo('tipo', 'Tipo', 'id', array('alias' => 'Tipo'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'tipo' => 'tipo', 
            'dni' => 'dni', 
            'nombre' => 'nombre', 
            'apellido1' => 'apellido1', 
            'apellido2' => 'apellido2', 
            'direccion' => 'direccion', 
            'telefono' => 'telefono', 
            'movil' => 'movil', 
            'email' => 'email', 
            'sexo' => 'sexo', 
            'fechanacimiento' => 'fechanacimiento', 
            'cuenta' => 'cuenta', 
            'salario' => 'salario'
        );
    }

}
