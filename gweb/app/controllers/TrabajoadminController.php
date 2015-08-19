<?php

class TrabajoadminController extends ControllerBase
{
	
    public function indexAction()
    {
    	
    }


    public function ajaxGet()
    {
    	//si es una petición get
		if($this->request->isPost() == true) 
		{
		    //si es una petición ajax
		    if($this->request->isAjax() == true) 
		    {		    
        		$idEntidad = $this->request->getGet("id", "id");

        		$this->response->setStatusCode(200, "OK");
				$this->response->send();
          	}
		}
		else
		{
			$this->response->setStatusCode(404, "Not Found");
		}
    }
}