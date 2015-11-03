<?php

class Clase extends ClaseAbstracta
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
    public $fechacurso;

    /**
     *
     * @var []Alumnos
     */
    public $alumnos;

    /**
     *
     * @var Profesora
     */
    public $profesora;

    /**
    * Guardar valores
    */
    public function putClase($id, $nombre, $fechacurso, $alumnos, $profesora)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fechacurso = $fechacurso;
        $this->alumnos = $alumnos;
        $this->profesora = $profesora;
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
    * Coger valor fechacurso
    */
    public function getFechacurso()
    {
        return $this->fechacurso;
    }

    /**
    * Coger valor alumnos
    */
    public function getAlumnos()
    {
        return $this->alumnos;
    }

    /**
    * Coger valor profesora
    */
    public function getProfesora()
    {
        return $this->profesora;
    }

}