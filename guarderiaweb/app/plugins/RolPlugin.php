<?php

use Phalcon\Events\Event,
	Phalcon\Dispatcher as PhDispatcher,
	Phalcon\Mvc\User\Plugin,
	Phalcon\Mvc\Dispatcher as MvcDispatcher,
	Phalcon\Acl;

class RolPlugin extends Plugin
{
	// Logica para crear una aplicacion con roles de usuarios
	public function getAcl()
	{
		if(!isset($this->persistent->acl)) 
		{
			//Creamos la instancia de ACL para crear los roles
			$acl = new Phalcon\Acl\Adapter\Memory();

			//Por defecto sera negar el acceso a cualquier zona
			$acl->setDefaultAction(Phalcon\Acl::DENY);

			//Registramos los roles que deseamos tener en nuestra aplicacion
			$roles = array('admin' => new Phalcon\Acl\Role('Admin'),
						'registered' => new Phalcon\Acl\Role('Registered'),
						'guest' => new Phalcon\Acl\Role('Guest')
					);

			//Añadimos los roles al acl
			foreach($roles as $role)
			{
				$acl->addRole($role);
			}

			//Zonas accesibles solo para el rol admin
			//$adminAreas = array('admin' => array('index', 'save')
			$adminAreas = array('admin' => array('tipo', 'get')
							);
	 
			//Añadimos las zonas de administrador a los recursos de la aplicación
			foreach($adminAreas as $resource => $actions) 
			{
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}

			//Zonas protegidas sólo para usuarios registrados de la aplicación
			$registeredAreas = array('dashboard' => array('index'),
									'profile' => array('index', 'edit')
								);
				
			//Añadimos las zonas para usuarios registrados a los recursos de la aplicación
			foreach($registeredAreas as $resource => $actions) 
			{
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}

			//Zonas públicas de la aplicación
			$publicAreas = array('index' => array('index', 'register', 'login', 'end')
							);
	 
			//Añadimos las zonas públicas a los recursos de la aplicación
			foreach($publicAreas as $resource => $actions) 
			{
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}

			//Damos acceso a todos los usuarios a las zonas públicas de la aplicación
			foreach($roles as $role) 
			{
				foreach($publicAreas as $resource => $actions) 
				{
					$acl->allow($role->getName(), $resource, '*');
				}
			}
	 
			//damos acceso a la zona de admins solo a rol Admin
			foreach($adminAreas as $resource => $actions) 
			{
				foreach($actions as $action)
				{
					$acl->allow('Admin', $resource, $action);
				}
			}
	 
			//damos acceso a las zonas de registro tanto a los usuarios registrados como al admin
			foreach($registeredAreas as $resource => $actions) 
			{
				//damos acceso a los registrados
				foreach($actions as $action)
				{
					$acl->allow('Registered', $resource, $action);
				}
				//damos acceso al admin
				foreach($actions as $action)
				{
					$acl->allow('Admin', $resource, $action);
				}
			}
	 
			//El acl queda almacenado en sesión
			$this->persistent->acl = $acl;
		}
 
		return $this->persistent->acl;
	}


	//Esta acción se ejecuta antes de ejecutar cualquier acción en la aplicación
	public function beforeDispatcher(Event $event, Dispatcher $dispartcher)
	{
		//Esta sesión sólo la tendrá el admin
		$admin = $this->session->get('admin');

		//Esta sesión sólo la tendrá el usuario registrado
		$registered = $this->session->get('registered');
 
		//Si no es admin ni un usuario registrado es guest
		if(!$admin && !$registered)
		{
			$role = 'Guest';
		}
		else if($admin)
		{
			//Si es admin
			$role = 'Admin';
		}
		else
		{
			//En otro caso es un usuario registrado
			$role = 'Registered';
		}

		//Nombre del controlador al que intentamos acceder
		$controller = $dispatcher->getControllerName();
		
		//Nombre de la acción a la que intentamos acceder
		$action = $dispatcher->getActionName();
 
		//Obtenemos la Lista de Control de Acceso(acl) que hemos creado
		$acl = $this->getAcl();
 
		//Boolean(true | false) si tenemos permisos devuelve true en otro caso false
		$allowed = $acl->isAllowed($role, $controller, $action);
 
		//Si el usuario no tiene acceso a la zona que intenta acceder le mostramos el contenido de la función index del controlador index con un mensaje flash
		if($allowed != Acl::ALLOW) 
		{
			$this->flash->error("Zona restringida, no puedes entrar aquí!");
			$dispatcher->forward( array('controller' => 'index',
										'action' => 'index'
									)
								);
			return false;
		}
	}
}
