<?php

class UsuarioController extends ControllerBase
{
	private function _registerUsuario($user)
	{
		$this->session->set('auth',
							array('id' => $user->id,
									'name' => $user->nombre,
                                    'rol' => $user->rol));
	}

    public function indexAction()
    {

    }

    public function registerAction()
    {
    	$usuario = new Usuario();

    	$success = $usuario->save($this->request->getPost(),
    								array('nombre',
    										'password',
    										'estado'));

    	if($success)
    	{
    		echo "Gracias por registrarse";
    	}
    	else
    	{
    		echo "Perdon, se generó el siguiente problema: ";
    		foreach ($usuario->getMessages() as $message) 
    		{
    			echo $message->getMessage(), "<br/>";
    		}
    	}

    	$this->view->disable();
    }

    public function loginAction()
    {
    	if($this->request->isPost())
    	{
    		$nombre = $this->request->getPost('nombre');
    		$password = $this->request->getPost('password');

    		$usuario = Usuario::findFirst(array("nombre = :nombre: AND password = :password: AND estado = 1",
    											'bind' => array('nombre' => $nombre,
    															'password' => $password)));

    		if($usuario != false)
    		{
    			$this->_registerUsuario($usuario);
    			$this->flash->success('Bienvenido ' . $usuario->nombre);
    			return $this->forward('index/index');
    		}

    		$this->flash->error('Error en nombre/password');    		
    	}

    	return $this->forward('index/index');

    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('index/index');
    }

}

