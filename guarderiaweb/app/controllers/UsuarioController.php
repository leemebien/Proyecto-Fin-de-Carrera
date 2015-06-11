<?php

class UsuarioController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
    	
    }

    //Esta funcion nos permite iniciar sesion con el usuario que le pasamos
    private function _registerSession($user)
    {
    	$this->session->set('auth', array('id' => $user->id,
    										'nombre' => $user->nombre
    									)
    						);
    }

    public function loginAction()
    {
    	//vemos si nos lo pasan por post
    	if($this->request->isPost())
    	{
    		//creamos una instancia del usuario
    		//$usuario = new Usuario();

    		//obtenemos los campos del login que nos pasan
    		$nombre = $this->request->getPost('email', array('striptags', 'email', 'trim'));
    		$password = $this->request->getPost('password', array('striptags', 'alphanum', 'trim'));

    		//ahora buscamos si existe el usuario
    		$usuario = Usuario::findFirst(array("nombre = :nombre: AND password = :password: ",
    											'bind' => array('nombre' => $nombre,
    															'password' => $password)
    										)
    									);

    		//si el usuario no existe con las credenciales entonces mostramos los errores
    		if(!$usuario)
    		{
    			/*foreach($usuario->getMessages() as $message)
    			{
    				$this->flash->error($message);
    			}*/
    			$this->flash->error('Error en login');
    			//ahora volvemos la accion al index con el error del formulario
    			return $this->dispatcher->forward('index/index');
    		}
    		else
    		{
    			//si lo encontramos entonces lo registramos y mostramos el nombre de usuario
    			$this->_registerSession($usuario);
    			$this->flash->success('Welcome ' . $usuario->nombre);
    			return $this->dispatcher->forward('index/index');    			
    		}
    	}
    	else
    	{
    		//Si no es una peticion post entonces volvemos a la home
    		$this->dispatcher->forward("#\home");
    	}
    }
}

