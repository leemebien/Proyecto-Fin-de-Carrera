<?php

class Alumno extends ClaseAbstracta
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
    public $fechanacimiento;

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
     * @var PadreResponsable
     */
    public $padre;

    /**
     *
     * @var PadreResponsable
     */
    public $madre;

    /**
     *
     * @var []PadreResponsable
     */
    public $responsables;

    /**
     *
     * @var []Observ<cion
     */
    public $observaciones;

    /**
     *
     * @var Evaluacion
     */
    public $evaluacion;

    /**
     *
     * @var Caracteristica
     */
    public $caracteristica;

    /**
     *
     * @var []Menu
     */
    public $menu;

    /**
     *
     * @var Medicina
     */
    public $medicina;

    /**
    * Guardar valores
    */
    public function putAlumno($id, $nombre, $apellido1, $apellido2, $fechanacimiento, $dni, $foto, $padre, $madre, $responsables, $observaciones, $evaluacion, $caracteristica, $menu, $medicina)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->fechanacimiento = $fechanacimiento;
        $this->dni = $dni;
        $this->foto = $foto;
        $this->padre = $padre;
        $this->madre = $madre;
        $this->responsables = $responsables;
        $this->observaciones = $observaciones;
        $this->evaluacion = $evaluacion;
        $this->caracteristica = $caracteristica;
        $this->menu = $menu;
        $this->medicina = $medicina;
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
    * Coger valor fechanacimiento
    */
    public function getFechanacimiento()
    {
        return $this->fechanacimiento;
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
    * Coger valor padre
    */
    public function getPadre()
    {
        return $this->padre;
    }

    /**
    * Coger valor madre
    */
    public function getMadre()
    {
        return $this->madre;
    }

    /**
    * Coger valor responsables
    */
    public function getResponsables()
    {
        return $this->responsables;
    }

    /**
    * Coger valor observaciones
    */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
    * Coger valor evaluacion
    */
    public function getEvaluacion()
    {
        return $this->evaluacion;
    }

    /**
    * Coger valor caracteristica
    */
    public function getCaracteristica()
    {
        return $this->caracteristica;
    }

    /**
    * Coger valor menu
    */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
    * Coger valor medicina
    */
    public function getMedicina()
    {
        return $this->medicina;
    }

}