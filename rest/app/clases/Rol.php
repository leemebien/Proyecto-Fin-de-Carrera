<?php

class Rol extends ClaseAbstracta
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
    * Guardar valores
    */
    public function putRol($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
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
    * Obtenemos listado
    */
    public function getListado()
    {
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
    }

}