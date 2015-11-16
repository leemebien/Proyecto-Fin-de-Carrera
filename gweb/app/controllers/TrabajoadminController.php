<?php

class TrabajoadminController extends ControllerBase
{
	
    public function indexAction()
    {
        $auth = $this->session->get('auth');
    	if($auth)
    	{
	        $usuario = $auth['user'];
	        $sesion = $auth['sesion'];

	        $datoenvio = new Datoenvio();
	        $dato = $datoenvio->enviarDatos($sesion, $usuario);

	        $data = array('dato' => $dato
	                        ,'status' => 'TO_MOVE'
	                        ,'message' => 'Moverse a Trabajoadmin.');

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

/*
    Public function ajaxUsuarioAction()
    {
			
    	//deshabilitamos la vista para peticiones ajax
	    $this->view->disable();
	 
	    //si es una petición post
	    if($this->request->isPost() == true) 
	    {
	        //si es una petición ajax
	        if($this->request->isAjax() == true) 
	        {
	        	$email = $this->request->getPost('email', array('striptags', 'trim'));
	        	$action = $this->request->getPost('action', array('striptags', 'trim'));

	        	$auth = $this->session->get('auth');
//                $usuario = $auth['user'];
                $sesion = $auth['sesion'];

                $datoenvio = new Datoenvio();
                $dato = $datoenvio->enviarDatos($sesion, $email);

                $data = array('dato' => $dato
                                ,'status' => 'TO_GETDATAUSER'
                                ,'message' => 'Obtener listado usuarios.');

                $json = json_encode($data);
  
                //Obtenemos la url
                //$url = 'http://localhost/rest/api/usuarios/getlist/';
                $url = 'http://localhost/rest/api/usuarios/' . $action .'/';                

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
                $resultado = $datoenvio->getDato();
	        	/*-------------------------------------------------------

	        	$resultado = array(
					'success'  => false,
					'message' => 'No fue posible ejecutar la peticion.',
					'datos'   => $json 
				);
	        	-------------------------------------------------------*/
/*
	        	$this->response->setJsonContent($resultado);

	        	$this->response->setStatusCode(200, "OK");

	        	$this->response->send();
	        }
	    }
	}
*/
}
