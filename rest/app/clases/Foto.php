<?php

class Foto extends ClaseAbstracta
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
    private $nombre;

    /**
     *
     * @var longblob
     */
    public $fotobinaria;

    /**
     *
     * @var string
     */
    public $tipo;

    /**
    * Guardar valores
    */
    public function putFoto($id, $nombre, $fotobinaria, $tipo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fotobinaria = $fotobinaria;
        $this->tipo = $tipo;
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
    * Coger valor nombre
    */
    public function getFotobinaria()
    {
        return $this->nombre;
    }

    /**
    * Coner valor fotobinaria
    */
    public function putFotobinaria($fotobinaria)
    {
        $this->fotobinaria = $fotobinaria;
    }

    /**
    * Coger valor tipo
    */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
    * Coner valor tipo
    */
    public function putTipo($tipo)
    {
        $this->tipo = $tipo;
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