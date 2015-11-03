 <?php

class Evaluacion extends ClaseAbstracta
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
	* @var Caracteristica
	*/
	public $caracteristica;

	/**
	*
	* @var string
	*/
	public $texto;

    /**
    * Guardar valores
    */
    public function putEvaluacion($id, $fecha, $caracteristica, $texto)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->caracteristica = $caracteristica;
        $this->texto = $texto;
    }

    /**
    * Coger valor id
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Coger valor fecha
    */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
    * Coger valor caracteristica
    */
    public function getCaracteristica()
    {
        return $this->caracteristica;
    }

    /**
    * Coger valor texto
    */
    public function getTexto()
    {
        return $this->texto;
    }

}