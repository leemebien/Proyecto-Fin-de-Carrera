<?php

class EmpresaController extends \Phalcon\Mvc\Controller
{

    // Variables
	private $_empresas = array();

	//Funciones

    public function indexAction()
    {

    }

    //Recupera todos los datos de la tabla empresa
    public function getAction(){
    	//Primero desabilitamos la vista del controlador
    	$this->view->disable();
    	//Comprobamos si hemos encontrado la informacion
    	if($this->request->isGet() == true){

    		//Asi lo hacemos para un acceso a una db normal
            //los recuperamos todos
    		$empresas = Empresa::find();
    		//los recorremos todos para mostrarlos
    		foreach ($empresas as $empresa){
    			$this->_empresas[] = $empresa;
    		}
    		//generamos la respuesta con el contenido en un JSON
    		$this->response->setJsonContent(array("empresas" => $this->_empresas));
/*
            //Asi lo hacemos para un acceso a una Api REST
    		$url = 'http://localhost/guarderiarest/api/empresas/';
    		$json = file_get_contents($url);
    		$this->_empresas = json_decode($json,true);
    		$this->response->setJsonContent(array("empresas" => $this->_empresas));
*/

    		$this->response->setStatusCode(200, "OK");
    		$this->response->send();
    	}
    	else{
    		//Si no la encontramos entonces respondemos que no la hemos encontrado
    		$this->response->setStatusCode(404, "Not Found");
    	}
    }

}

