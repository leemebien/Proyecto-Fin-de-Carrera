<?php

class Profesora extends ClaseAbstracta
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
    public $dni;

    /**
     *
     * @var string
     */
    public $foto;

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
    public $direccion;

    /**
     *
     * @var []Clase
     */
    public $clases;

    /**
    * Guardar valores
    */
    public function putProfesora($id, $nombre, $apellido1, $apellido2, $dni, $foto, $telefono, $movil, $email, $direccion, $clases)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->dni = $dni;
        $this->foto = $foto;
        $this->telefono = $telefono;
        $this->movil = $movil;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->clases = $clases;
    }

    /**
    * Coger valor id
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Coger valor nombre
    */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
    * Coger valor apellido1
    */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
    * Coger valor apellido2
    */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
    * Coger valor dni
    */
    public function getDni()
    {
        return $this->dni;
    }

    /**
    * Coger valor foto
    */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
    * Coger valor telefono
    */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
    * Coger valor movil
    */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
    * Coger valor email
    */
    public function getEmail()
    {
        return $this->email;
    }

    /**
    * Coger valor direccion
    */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
    * Coger valor clases
    */
    public function getClases()
    {
        return $this->clases;
    }

}