<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function initialize()
    {
        //Inicializamos los CSS
        $this->assets->addCss("css/bootstrap/bootstrap.min.css");
        $this->assets->addCss("css/business-casual.css");
        $this->assets->addCss("css/jqueryui/jquery-ui.css");
        //$this->assets->addCss("css/jqueryui/theme.css");

        //Inicializamos los JS 
        //$this->assets->addJs("js/jquery/jquery.js");
        $this->assets->addJs("js/jquery/jquery-1.10.2.js");
        $this->assets->addJs("js/jqueryui/jquery-ui.js");
        $this->assets->addJs("js/bootstrap/bootstrap.min.js"); 
    }

    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0],
    			'action' => $uriParts[1],
                'params' => $params
    		)
    	);
    }
}
