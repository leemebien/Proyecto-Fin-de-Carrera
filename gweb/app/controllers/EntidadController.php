<?php

class EntidadController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function operacionalumnoAction()
    {
    	if($this->request->isPost())
    	{
    	
	    	// Añadir Alumno
	    	if($_POST[addalumno])
	    	{
	    		// Inicializaamos la variable
	    		$entidad = new Entidad();

	    		// Guardamos los valores en variable
	    		$entidad->id = $this->request->getPost('id', array('striptags', 'alphanum', 'trim'));
            	$entidad->tipo = $this->request->getPost('tipo', array('striptags', 'alphanum', 'trim'));
            	$entidad->dni = $this->request->getPost('dni', array('striptags', 'alphanum', 'trim'));
            	$entidad->nombre = $this->request->getPost('nombre', array('striptags', 'alphanum', 'trim'));
            	$entidad->apellido1 = $this->request->getPost('apellido1', array('striptags', 'alphanum', 'trim'));
            	$entidad->apellido2 = $this->request->getPost('apellido2', array('striptags', 'alphanum', 'trim'));
            	$entidad->direccion = $this->request->getPost('direccion', array('striptags', 'alphanum', 'trim'));
            	$entidad->telefono = $this->request->getPost('telefono', array('striptags', 'alphanum', 'trim'));
            	$entidad->movil = $this->request->getPost('movil', array('striptags', 'alphanum', 'trim'));
            	$entidad->email = $this->request->getPost('email', array('striptags', 'email', 'trim'));
            	$entidad->sexo = $this-request->getPost('sexo', array('striptags', 'alphanum', 'trim'));
            	$entidad->fechanacimiento = $this->request->getPost('fechanacimiento', array('striptags', 'datetime', 'trim'));
            	$entidad->cuenta = $this->request->getPost('cuenta', array('striptags', 'alphanum', 'trim'));
            	$entidad->salario = $this->request->getPost('salario', array('striptags', 'alphanum', 'trim'));

            	// Guardamos en Base de datos
            	if($entidad->save())
            	{
            		// Limpiamos los campos
            	}
            	else
            	{
            		// Mostramos mensage de error
            	}
	    		echo "<p>addalumno</p>";
	    	}

	    	// Modificar Alumno
	    	if($_POST[modalumno])
	    	{
	    		echo "modalumno";
	    	}

	    	// Borrar Alumno
	    	if($_POST[boralumno])
	    	{
	    		echo "boralumno";
	    	}

    	}

    	return $this->forward('trabajoadmin/index');
    }

}

