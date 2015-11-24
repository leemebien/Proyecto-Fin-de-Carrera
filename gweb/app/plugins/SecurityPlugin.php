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
		if(!isset($this->persistent->acl))
		{
			//Creamos la lista de accesos
			$acl = new AclList();

			//Por defecto la lista deniega el acceso
			$acl->setDefaultAction(Acl::DENY);

			//Creamos los diferentes roles
			$roles = array('users' => new Role('Users'),
							'guest' => new Role('Guest'));
			//Los añadirmos a la lista
			foreach ($roles as $role)
			{
				$acl->addRole($role);
			}

			//Indicamos las areas privadas
			$privateResources = array('trabajo' => array('index', 'ajaxUsuario', 'ajaxRol', 'ajaxTipo', 'ajaxFoto'),
										'trabajopadre' => array('index'),
										'trabajoprofe' => array('index'),
										'trabajoadmin' => array('index'),//, 'ajaxUsuario'),
										'trabajoSU' => array('index'),
										'usuario' => array('mantenimiento'),
										'rol' => array('mantenimiento'),
										'tipo' => array('mantenimiento'),
										'foto' => array('mantenimiento'),
										'entidad' => array('index', 'operacionalumno'));

			//Añadimos las alreas
			foreach ($privateResources as $resource => $actions)
			{
				$acl->addResource(new Resource($resource), $actions);
			}

			//Indicamos las areas publicas
			$publicResources = array('index' => array('index'),
									'about' => array('index'),
									'blog' => array('index'),
									'contact' => array('index'),
									'usuario' => array('index', 'register', 'login', 'end'),
									'errors' => array('show401', 'show404', 'show500'));

			//Añadimos las alreas
			foreach ($publicResources as $resource => $actions)
			{
				$acl->addResource(new Resource($resource), $actions);
			}
			
			//Damos acceso a las areas publicas
			foreach ($roles as $role)
			{
				foreach ($publicResources as $resource => $actions)
				{
					foreach ($actions as $action)
					{
						$acl->allow($role->getName(), $resource, $action);
					}
				}
			}

			//Damos acceso a las areas privadas
			foreach ($privateResources as $resource => $actions)
			{
				foreach ($actions as $action)
				{
					$acl->allow('Users', $resource, $action);
				}
			}

			//Asignamos la lista de accesos a objeto persistente
			$this->persistent->acl = $acl;
		}

		return $this->persistent->acl;
	}

	/**
	 * This action is executed before execute any action in the application
	 *
	 * @param Event $event
	 * @param Dispatcher $dispatcher
	 */
	public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {
    	$auth = $this->session->get('auth');
    	if(!$auth)
    	{
    		$role = 'Guest';
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