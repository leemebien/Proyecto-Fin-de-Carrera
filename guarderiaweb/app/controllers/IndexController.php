<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
    	//Inicializamos los CSS
        $this->assets->addCss("css/bootstrap/bootstrap.min.css");
        $this->assets->addCss("css/bootstrap/bootstrap-theme.min.css");
        $this->assets->addCss("css/jqueryui/jquery-ui.min.css");
        $this->assets->addCss("css/jqueryui/jquery-ui.structure.min.css");
        $this->assets->addCss("css/jqueryui/jquery-ui.theme.min.css");
    	$this->assets->addCss("css/business-casual.css");
        //<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
        $this->assets->addCss("//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css");

    	//Inicializamos los JS 
        //$this->assets->addJs("js/jquery/jquery.js");
        //$this->assets->addJs("js/jquery/jquery-2.1.3.min.js");
        $this->assets->addJs("js/jquery/jquery-2.1.4.js");
        //$this->assets->addJs("js/jquery/jquery-1.11.3.min.js");
        //$this->assets->addJs("js/jquery/jquery-1.11.3.js");
        //$this->assets->addJs("js/jquery/jquery-1.10.2.js");
    	$this->assets->addJs("js/angular/angular.min.js");
        $this->assets->addJs("js/angular/angular-animate.min.js");
    	$this->assets->addJs("js/angular-route/angular-route.min.js"); 
        $this->assets->addJs("js/bootstrap/bootstrap.min.js"); 
        //$this->assets->addJs("js/uibootstrap/ui-bootstrap-tpls-0.13.0.min.js"); 
        $this->assets->addJs("js/jqueryui/jquery-ui.min.js"); 
    	$this->assets->addJs("js/app.js");

        //Inicializamos los FONTS
        /*
        glyphicons-halflings-regular.eot
        glyphicons-halflings-regular.svg
        glyphicons-halflings-regular.ttf
        glyphicons-halflings-regular.woff
        glyphicons-halflings-regular.woff2
        */

    }
 
    public function adminAction()
    {
        //Creamos la sesión para el administrador
        $this->session->set("admin",true);
        //Creamos una sesión flash
        $this->flash->success("La sesión de usuario administrador se ha creado correctamente");
        return $this->dispatcher->forward(array("action" => "index"
                                                )
                                        );
    }
 
    public function registeredAction()
    {
        //Creamos la sesión para el usuario registrado
        $this->session->set("registered",true);
        //Creamos una sesión flash
        $this->flash->success("La sesión de usuario registrado se ha creado correctamente");
        return $this->dispatcher->forward(array("action" => "index"
                                                )
                                        );
    }
 
    public function loginAction()
    {
        echo "index loginAction";
    }
 
    public function registerAction()
    {
        echo "index registerAction";
    }
 
    //Eliminamos las sesiones
    public function endAction()
    {
        $this->session->destroy();
        //Creamos una sesión flash
        $this->flash->success("La sesión se ha eliminado correctamente");
        return $this->dispatcher->forward(array("action" => "index"
                                                )
                                        );
    }

}

