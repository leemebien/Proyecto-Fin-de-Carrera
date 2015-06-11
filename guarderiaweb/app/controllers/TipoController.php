<?php

class TipoController extends \Phalcon\Mvc\Controller
{

	// Variables
	private $_tipos = array();

	//Funciones

    public function indexAction()
    {

    }

    //Recupera todos los tipos de la tabla tipo
    public function getAction(){
    	//Primero desabilitamos la vista del controlador
    	$this->view->disable();
    	//Comprobamos si hemos encontrado la informacion
    	if($this->request->isGet() == true){
/*
    		//Asi lo hacemos para un acceso a una db normal
            //los recuperamos todos
    		$tipos = Tipo::find();
    		//los recorremos todos para mostrarlos
    		foreach ($tipos as $tipo){
    			$this->_tipos[] = $tipo;
    		}
    		//generamos la respuesta con el contenido en un JSON
    		$this->response->setJsonContent(array("tipos" => $this->_tipos));
*/
            //Asi lo hacemos para un acceso a una Api REST
    		$url = 'http://localhost/guarderiarest/api/tipos/';
    		$json = file_get_contents($url);
    		$this->_tipos = json_decode($json,true);
    		$this->response->setJsonContent(array("tipos" => $this->_tipos));


    		$this->response->setStatusCode(200, "OK");
    		$this->response->send();
    	}
    	else{
    		//Si no la encontramos entonces respondemos que no la hemos encontrado
    		$this->response->setStatusCode(404, "Not Found");
    	}
    }

}

