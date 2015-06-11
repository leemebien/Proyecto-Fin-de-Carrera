<?php
 
class ErrorController extends ControllerBase
{
	//en caso de que dispatcher detecte la excepción not foud lanzará esta acción
    public function show404Action()
    {
        $this->response->setHeader(404, 'Not Found');
        $this->view->pick('errores/404');
    }

	//en caso de que dispatcher detecte la excepción not foud lanzará esta acción
    public function show500Action()
    {
        $this->response->setHeader(500, 'Not Found');
        $this->view->pick('errores/500');
    }
}