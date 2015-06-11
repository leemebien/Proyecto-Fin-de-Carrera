<?php

use Phalcon\Events\Event,
	Phalcon\Dispatcher as PhDispatcher,
	Phalcon\Mvc\User\Plugin,
	Phalcon\Mvc\Dispatcher\Exception as DispatcherException,
	Phalcon\Mvc\Dispatcher as MvcDispatcher;

class NotFoundPlugin extends Plugin
{
	//lanzamos antes de que se lance cualquier tipo de excepción
	public function beforeException(Event $event, MvcDispatcher $dispatcher, Exception $exception)
	{
		if($exception instanceof DispatcherException)
		{
			switch ($exception->getCode())
			{
				//en caso de que el servicio llamado no sea encontrado o la acción no se encuentre
                case PhDispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                case PhDispatcher::EXCEPTION_ACTION_NOT_FOUND:
                //con dispatcher->forward le decimos que muestre el contenido de la acción show404 del controlador error, a crearlo
                	$dispatcher->forward(array('controller' => 'error',
                							'action' => 'show404')
                						);
                	return false;
            }
		}

		$dispatcher->forward(array('controller' => 'error',
									'action' => 'show500')
                			);
		return false;
	}
}