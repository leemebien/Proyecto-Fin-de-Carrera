<?php

class ErrorsController extends ControllerBase
{
    public function indexAction()
    {
        $this->tag->setTitle('Oops!');
        parent::initialize();
    }

    public function show404Action()
    {
        //$this->response->setHeader(404, 'Not Found');
        //$this->view->pick('errors/404');
    }

    public function show401Action()
    {

    }

    public function show500Action()
    {
        //$this->response->setHeader(500, 'Not Found');
        //$this->view->pick('errors/500');
    }
}

