<?php

	//funcion para recuperar los datos del usuario
	function getUsuario($email)
	{
		$respuesta = false;

		$auth = $this->session->get('auth');
        //$usuario = $auth['user'];
        $sesion = $auth['sesion'];

        $datoenvio = new Datoenvio();
        $dato = $datoenvio->enviarDatos($sesion, $email);

        $data = array('dato' => $dato
                        ,'status' => 'TO_GETDETAIL'
                        ,'message' => 'Obtener detalle usuarios.');

        $json = json_encode($data);

        //Obtenemos la url
//        $url = 'http://localhost/rest/api/usuarios/getlist/';

        //Creamos el flujo
        $opciones = array('http' => array('method' => "POST",
                                            'header' => 'Content-type: application/json',
                                            'content' => $json,
                                            'timeout' => 60)
                        );

        $contexto = stream_context_create($opciones);
/*$this->flash->error($contexto);  
return $this->forward('index/index');
*/
        //Realizamos la llamada al API REST y Obtenemos la respuesta
        $json = file_get_contents($url, false, $contexto);
/*$this->flash->error($json);  
return $this->forward('index/index');
*/
        //Decodificamos el JSON
        $data = json_decode($json);

        //Desmontamos el JSON
        $dato = $data->dato;

        //Desmontamos los datos de envio
        $datoenvio->obtenerDatos($dato);

        //Obtenemos la Sesion y la informacion
        $sesion = $datoenvio->getSesion();
        $u = $datoenvio->getDato();

        $respuesta = $u;

        return $respuesta;
	}

?>