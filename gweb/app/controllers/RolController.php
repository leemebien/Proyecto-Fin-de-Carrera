<?php

class RolController extends ControllerBase
{
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

            if(isset($_POST['rol_A']))
            {
//die('boton a');
                $id = $this->request->getPost('rolInputId');
                $nombre = $this->request->getPost('rolInputNombre');

                $valor = array('id' => $id
                                ,'nombre' => $nombre);

                //Obtenemos la url
                $url = 'http://localhost/rest/api/roles/addrol/';

                $paso = true;
            }
                
            if(isset($_POST['rol_M']))
            {
//die('boton m');
                $id = $this->request->getPost('rolInputId');
                $nombre = $this->request->getPost('rolInputNombre');

                $valor = array('id' => $id
                                ,'nombre' => $nombre);

                //Obtenemos la url
                $url = 'http://localhost/rest/api/roles/updrol/';

                $paso = true;
            }

            if(isset($_POST['rol_E']))
            { 
//die('boton e');  
                $id = $this->request->getPost('rolInputId');
                $nombre = $this->request->getPost('rolInputNombre');

                $valor = array('id' => $id
                                ,'nombre' => $nombre);

                //Obtenemos la url
                $url = 'http://localhost/rest/api/roles/delrol/';

                $paso = true;
            }

            if($paso)
            {
//die('paso ' . $id);
//die('paso ' . $nombre);
//die('paso ' . $url);


                $datoenvio = new Datoenvio();
                $dato = $datoenvio->enviarDatos($sesion, $valor);

                $data = array('dato' => $dato
                                ,'status' => 'TO_ACTIONUSER'
                                ,'message' => 'Accciones con usuario.');

                $json = json_encode($data);
/*
                //Obtenemos la url
                $url = 'http://localhost/rest/api/sesiones/actualizarSesion/';
*/
                //Creamos el flujo
                $opciones = array('http' => array('method' => "POST",
                                                    'header' => 'Content-type: application/json',
                                                    'content' => $json,
                                                    'timeout' => 60)
                                );

                $contexto = stream_context_create($opciones);

                //Realizamos la llamada al API REST y Obtenemos la respuesta
                $json = file_get_contents($url, false, $contexto);
//$this->flash->error('JSON -> ' .$json);  
//return $this->forward('trabajoSU/index');
    
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
                    //$this->session->remove('auth');
                    $this->flash->error($data->message);  
                    return $this->forward('trabajoSU/index');
                } 
            }
            else
            {
                $this->flash->error('No se ha realizado ningún cambio.');  
                return $this->forward('trabajoSU/index');
            }

            $this->flash->success('Operación realizada.');  
            return $this->forward('trabajoSU/index');
    
//$this->flash->error($url);  
//return $this->forward('trabajoadmin/index');
        }
    }

}

