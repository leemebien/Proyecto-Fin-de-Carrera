<?php

class ContactController extends ControllerBase
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
	                        ,'message' => 'Moverse a Contact.');

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

}

