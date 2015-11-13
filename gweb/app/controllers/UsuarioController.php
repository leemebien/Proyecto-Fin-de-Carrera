<?php

class UsuarioController extends ControllerBase
{
	private function _registerUsuario($user, $sesion)
	{
/*        $this->session->set('auth',
                            array('id' => $user->id,
                                    'name' => $user->nombre,
                                    'rol' => $user->rol));
*/
        $this->session->set('auth',
                            array(//'id' => $user->id,
                                    'name' => $user->getEmail(),
                                    'rol' => $user->getRol(),
                                    'user' => $user,
                                    'sesion' => $sesion));
	}

    public function indexAction()
    {
/*        $auth = $this->session->get('auth');
        if($auth)
        {
            $usuario = $auth['user'];
            $sesion = $auth['sesion'];

            $datoenvio = new Datoenvio();
            $dato = $datoenvio->enviarDatos($sesion, $usuario);

            $data = array('dato' => $dato
                            ,'status' => 'TO_MOVE'
                            ,'message' => 'Moverse a Usuario.');

            $json = json_encode($data);

            //Obtenemos la url
            $url = 'http://localhost/rest/api/sesiones/actualizarSesion/';

            //Creamos el flujo
            $opciones = array('http' => array('method' => "POST",
                                                'header' => 'Content-type: application/json',
                                                'content' => $json,
                                                'timeout' => 60)
                            );

            $contexto = stream_context_create($opciones);

            //Realizamos la llamada al API REST y Obtenemos la respuesta
            $json = file_get_contents($url, false, $contexto);

            //Decodificamos el JSON
            $data = json_decode($json);

            //Desmontamos el JSON
            $dato = $data->dato;

            //Desmontamos los datos de envio
            $datoenvio->obtenerDatos($dato);

            //Obtenemos la Sesion y la informacion
            $sesion = $datoenvio->getSesion();
            $usuario = $datoenvio->getDato();

            if($data->status != 'OK')
            {
                $this->session->remove('auth');
                $this->flash->error('Error en nombre/password');  
                return $this->forward('index/index');
            }       
        }
*/    }

    public function registerAction()
    {
        if($this->request->isPost())
        {
            
            $email = $this->request->getPost('nombre');
            $password = $this->security->hash($this->request->getPost('password'));

            $usuario = new Usuario();
            //$usuario->putUsuario($email, $password, 4, 1);
            $usuario->putUsuario($email, $password, 1, 1);


            $sesion = new Sesion();
            $sesion->putSesion(0, $email, 1, date('Y/m/d_H:i:s'), date('Y/m/d_H:i:s',mktime(date('H'), date('i') + 10, 0, date('m'), date('d'), date('Y'))));

            $datoenvio = new Datoenvio();
            $dato = $datoenvio->enviarDatos($sesion, $usuario);

            $data = array('dato' => $dato
                            ,'status' => 'TO_REGISTER'
                            ,'message' => 'Realizar registro.');

            $json = json_encode($data);

            $url = 'http://localhost/rest/api/usuarios/registrar/';

            $opciones = array('http' => array('method' => "POST"
                                                ,'header' => 'Content-type: application/json'
                                                ,'content' => $json
                                                ,'timeout' => 60)
                            );

            $contexto = stream_context_create($opciones);

            $json = file_get_contents($url, false, $contexto);
//$this->flash->error($json);
//return $this->forward('index/index');

            $data = json_decode($json);

            $dato = $data->dato;

            $datoenvio->obtenerDatos($dato);

            $sesion = $datoenvio->getSesion();
            $usuario = $datoenvio->getDato();

            if($data->status == 'OK')
            {
                $this->_registerUsuario($usuario, $sesion);
                $this->flash->success('Bienvenido ' . $usuario->getEmail());
                return $this->forward('index/index');
            }

            $this->session->remove('auth');
            $this->flash->error('Error en nombre/password');            
        }

        return $this->forward('index/index');
    }


    public function loginAction()
    {
    	if($this->request->isPost())
    	{
            
            $email = $this->request->getPost('nombre');
            //$password = $this->security->hash($this->request->getPost('password'));
            $password = $this->request->getPost('password');

            $usuario = new Usuario();
            $usuario->putUsuario($email, $password, 1, 1);

            //Creamos una nueva sesion y la rellenamos
            $sesion = new Sesion();
            $sesion->putSesion(0, $email, $usuario->getRol(), date('Y/m/d_H:i:s'), date('Y/m/d_H:i:s',mktime(date('H'), date('i') + 10, 0, date('m'), date('d'), date('Y'))));

            //Montamos los datos de envio
            $datoenvio = new Datoenvio();
            $dato = $datoenvio->enviarDatos($sesion, $usuario);

            //Montamos el JSON
            $data = array('dato' => $dato
                            ,'status' => 'TO_FIND'
                            ,'message' => 'Realizar login.');

            //Codificamos el JSON
            $json = json_encode($data);

            //Obtenemos la url
            $url = 'http://localhost/rest/api/usuarios/login2/';

            //Creamos el flujo
            $opciones = array('http' => array('method' => "POST",
                                                'header' => 'Content-type: application/json',
                                                'content' => $json,
                                                'timeout' => 60)
                            );

            $contexto = stream_context_create($opciones);

            //Realizamos la llamada al API REST y Obtenemos la respuesta
            $json = file_get_contents($url, false, $contexto);
//$this->flash->error($json);
//return $this->forward('index/index');

            //Decodificamos el JSON
            $data = json_decode($json);

            //Desmontamos el JSON
            $dato = $data->dato;

            //Desmontamos los datos de envio
            $datoenvio->obtenerDatos($dato);

            //Obtenemos la Sesion y la informacion
            $sesion = $datoenvio->getSesion();
            $usuario = $datoenvio->getDato();

            if($data->status == 'OK')
    		{
                $this->_registerUsuario($usuario, $sesion);
                $this->flash->success('Bienvenido ' . $usuario->getEmail());
    			return $this->forward('index/index');
    		}

            $this->session->remove('auth');
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

        $auth = $this->session->get('auth');
        $usuario = $auth['user'];
        $sesion = $auth['sesion'];

        $sesion->putFechaActual(date('Y/m/d_H:i:s'));
        $sesion->putFechaCaducidad(date('Y/m/d_H:i:s'));

        $datoenvio = new Datoenvio();
        $dato = $datoenvio->enviarDatos($sesion, $usuario);

        $data = array('dato' => $dato
                        ,'status' => 'TO_EXIT'
                        ,'message' => 'Realizar logout.');

        $json = json_encode($data);

        //Obtenemos la url
        $url = 'http://localhost/rest/api/usuarios/logout/';

        //Creamos el flujo
        $opciones = array('http' => array('method' => "POST",
                                            'header' => 'Content-type: application/json',
                                            'content' => $json,
                                            'timeout' => 60)
                        );

        $contexto = stream_context_create($opciones);

        //Realizamos la llamada al API REST y Obtenemos la respuesta
        $json = file_get_contents($url, false, $contexto);

        //Decodificamos el JSON
        $data = json_decode($json);

        //Desmontamos el JSON
        $dato = $data->dato;

        //Desmontamos los datos de envio
        $datoenvio->obtenerDatos($dato);

        //Obtenemos la Sesion y la informacion
        $sesion = $datoenvio->getSesion();
        $usuario = $datoenvio->getDato();

        //$this->flash->error($data->dato);
        //return $this->forward('index/index');

        $this->session->remove('auth');

        if($data->status == 'OK')
        {
            //$this->session->remove('auth');
            $this->flash->success('Goodbye!');
            return $this->forward('index/index');
        }

        $this->flash->error('Error en nombre/password');  
        return $this->forward('index/index');
    }


    /**
    * Mantenimiento de los usuarios
    */
    public function mantenimientoAction()
    {            
//        //deshabilitamos la vista para peticiones ajax
//        $this->view->disable();
     
        //si es una petición post
        if($this->request->isPost() == true) 
        {
            $auth = $this->session->get('auth');
            $usuario = $auth['user'];
            $sesion = $auth['sesion'];

            $paso = false;
$this->flash->error('->' . isset($_POST['usuario_M']) . '<-');  
return $this->forward('trabajoadmin/index');

            if(isset($_POST['usuario_A']))
            {
                $email = $this->request->getPost('usuarioInputEmail');
                $password = $this->security->hash($this->request->getPost('usuarioInputPass1'));
                $active = $this->request->getPost('usuarioInputActive');
                $rol = $this->request->getPost('usuarioInputRol');
                $persona = $this->request->getPost('usuarioInputUsuario');

                $valor['email'] = $email;
                $valor['password'] = $password;
                $valor['active'] = $active;
                $valor['rol'] = $rol;
                $valor['persona'] = $persona;

                //Obtenemos la url
                $url = 'http://localhost/rest/api/usuarios/addusuario/';

                $paso = true;
            }
                
            if(isset($_POST['usuario_M']))
            {
                $email = $this->request->getPost('usuarioInputEmail');
                $password = $this->security->hash($this->request->getPost('usuarioInputPass1'));
                $active = $this->request->getPost('usuarioInputActive');
                $rol = $this->request->getPost('usuarioInputRol');
                $persona = $this->request->getPost('usuarioInputUsuario');

                $valor['email'] = $email;
                $valor['password'] = $password;
                $valor['active'] = $active;
                $valor['rol'] = $rol;
                $valor['persona'] = $persona;

                //Obtenemos la url
                $url = 'http://localhost/rest/api/usuarios/updusuario/';

                $paso = true;
            }

            if(isset($_POST['usuario_E']))
            {
                $email = $this->request->getPost('usuarioInputEmail');

                $valor = $email;

                //Obtenemos la url
                $url = 'http://localhost/rest/api/usuarios/delusuario/';

                $paso = true;
            }
/*
            if($paso)
            {


                $datoenvio = new Datoenvio();
                $dato = $datoenvio->enviarDatos($sesion, $valor);

                $data = array('dato' => $dato
                                ,'status' => 'TO_ACTIONUSER'
                                ,'message' => 'Accciones con usuario.');

                $json = json_encode($data);
/*
                //Obtenemos la url
                $url = 'http://localhost/rest/api/sesiones/actualizarSesion/';
*//*
                //Creamos el flujo
                $opciones = array('http' => array('method' => "POST",
                                                    'header' => 'Content-type: application/json',
                                                    'content' => $json,
                                                    'timeout' => 60)
                                );

                $contexto = stream_context_create($opciones);

                //Realizamos la llamada al API REST y Obtenemos la respuesta
                $json = file_get_contents($url, false, $contexto);
//$this->flash->error($url);  
//return $this->forward('trabajoadmin/index');
//}
    
                //Decodificamos el JSON
                $data = json_decode($json);

                //Desmontamos el JSON
                $dato = $data->dato;

                //Desmontamos los datos de envio
                $datoenvio->obtenerDatos($dato);

                //Obtenemos la Sesion y la informacion
                $sesion = $datoenvio->getSesion();
                $valor = $datoenvio->getDato();

                if($data->status != 'OK')
                {
                    $this->session->remove('auth');
                    $this->flash->error('Error en nombre/password');  
                    return $this->forward('index/index');
                } 
            }
            else
            {
                $this->flash->error('No se ha realizado ningun cambio.');  
                return $this->forward('trabajoadmin/index');
            }

            $this->flash->success('Cambios realizados.');  
            return $this->forward('trabajoadmin/index');
    */
$this->flash->error($url);  
return $this->forward('trabajoadmin/index');
        }
    }

}

