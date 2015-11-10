<?php

class Persona extends ClaseAbstracta
{

    /**
     *
     * @var integer
     */
    private $id;

    /**
     *
     * @var string
     */
    public $dni;

    /**
     *
     * @var string
     */
    private $nombre;

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
    * Guardar valores
    */
    public function putFoto($id, $dni, $nombre, $apellido1, $apellido2)
    {
        $this->id = $id;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
    }

    /**
    * Coger valor id
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Coner valor id
    */
    public function putId($id)
    {
        $this->id = $id;
    }

    /**
    * Coger valor dni
    */
    public function getDni()
    {
        return $this->dni;
    }

    /**
    * Coner valor dni
    */
    public function putDni($dni)
    {
        $this->dni = $dni;
    }

    /**
    * Coger valor nombre
    */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
    * Coner valor nombre
    */
    public function putNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
    * Coger valor apellido1
    */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
    * Coner valor apellido1
    */
    public function putApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;
    }

    /**
    * Coger valor apellido2
    */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
    * Coner valor apellido2
    */
    public function putApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;
    }


    /**
    * Obtenemos listado
    */
    public function getListado()
    {/*
        $arrayRoles = Roles::find();
//return $arrayRoles[2]->nombre;
        $i = 0;

        foreach ($arrayRoles as $rol) 
        {
        	$r = new Rol();
        	$r->putRol($rol->id, $rol->nombre);
            $resultado[$i] = $r;
            $i++;
        }

        //return $arrayRoles;
        return $resultado;
    */}

}