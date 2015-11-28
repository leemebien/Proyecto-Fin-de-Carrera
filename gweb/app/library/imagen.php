<?php

    //deshabilitamos la vista para peticiones ajax
    //$this->view->disable();

	$id = $_GET['id'];
/*//	$aa = unserialize($a);
$aa = json_decode($a)
	$imagen = $aa->getFotobinaria();
	$tipo = $aa->getTipo();
/*
	$f = $_GET['f'];
	$tipo = $f->getTipo();
	$imagen = $f->getFotobinaria();
*/	


////////////////////////////////////////////////////////////////


                $auth = $this->session->get('auth');
                //$usuario = $auth['user'];
                $sesion = $auth['sesion'];

                $datoenvio = new Datoenvio();
                $dato = $datoenvio->enviarDatos($sesion, $id);

                $data = array('dato' => $dato
                                ,'status' => 'TO_GETLIST'
                                ,'message' => 'Obtener listado fotos.');

                $json = json_encode($data);

                //Obtenemos la url
                $url = 'http://localhost/rest/api/fotos/getDataFoto/';

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
//die($json);
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
                $dato = $datoenvio->getDato();
////////////////////////////////////////////////////////////////







$imagen = $dato->getFotobinaria();
$tipo = $dato->getTipo();


header("Content-type: $tipo ");
//header('Content-type: image/jpeg ');


	echo $imagen;
//die($imagen);
