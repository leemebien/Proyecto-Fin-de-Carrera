<?php


use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Mvc\User\Plugin;
use Phalcon\Acl\Adapter\Memory as AclList;


class SecurityPlugin extends Plugin
{
	/**
	 * Returns an existing or new access control list
	 *
	 * @returns AclList
	 */
	public function getAcl()
	{
	}

	/**
	 * This action is executed before execute any action in the application
	 *
	 * @param Event $event
	 * @param Dispatcher $dispatcher
	 */
	public function beforeDispatcher(Event $event, Dispatcher $dispatcher)
    {
    	$auth = $this->session->get('auth');
    	if(!$auth)
    	{
    		$role = 'Guests';
		}else
		{
			$role = 'Users';
		}

		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();

		$acl = $this->getAcl();

		$allowed = $acl->isAllowed($role, $controller, $action);
		if ($allowed != Acl::ALLOW)
		{
			$dispatcher->forward(array(
				'controller' => 'errors',
				'action'     => 'show401'
			));
            
            $this->session->destroy();
			return false;
		}
    }
}