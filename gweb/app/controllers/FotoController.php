<?php

class FotoController extends ControllerBase
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

            if(isset($_POST['foto_A']))
            {
//die('boton a');
                $id = $this->request->getPost('fotoInputId');
                $nombre = $this->request->getPost('fotoInputNombre');
                $fotobinaria = $this->request->getPost('fotoInputFotobinaria');
                $tipo = $this->request->getPost('fotoInputTipo');

//                $nombre = $this->request->getPost('fotoInputNombre');
//                $nombre = $_FILES['fotoInputFotobinaria']['name'];
//die($nombre);

//                $fotobinaria = $this->request->getPost('fotoInputFotobinaria');
                $fotobinaria = $_FILES['fotoInputFotobinaria']['tmp_name'];
//die($fotobinaria);
$data = file_get_contents($fotobinaria);
//die($data);
////$fotobinaria = mysql_escape_string($data);
//die(mysqli_real_escape_string($data));
//$fotobinaria = mysqli_real_escape_string($data);
//die($fotobinaria);

//                $tipo = $this->request->getPost('fotoInputTipo');
                $tipo = $_FILES['fotoInputFotobinaria']['type'];
//die($tipo);

                $valor = array('id' => $id
                                ,'nombre' => $nombre
                                //,'fotobinaria' => $fotobinaria
,'fotobinaria' => $data
                                ,'tipo' => $tipo);

                //Obtenemos la url
                $url = 'http://localhost/rest/api/fotos/addfoto/';

                $paso = true;
            }
                
            if(isset($_POST['foto_M']))
            {
//die('boton m');
                $id = $this->request->getPost('fotoInputId');
                $nombre = $this->request->getPost('fotoInputNombre');
                $fotobinaria = $this->request->getPost('fotoInputFotobinaria');
                $tipo = $this->request->getPost('fotoInputTipo');

//                $nombre = $this->request->getPost('fotoInputNombre');
                //$nombre = $_FILES['fotoInputFotobinaria']['name'];

//                $fotobinaria = $this->request->getPost('fotoInputFotobinaria');
                $fotobinaria = $_FILES['fotoInputFotobinaria']['tmp_name'];
$data = file_get_contents($fotobinaria);
//$fotobinaria = mysql_escape_string($data);

//                $tipo = $this->request->getPost('fotoInputTipo');
                $tipo = $_FILES['fotoInputFotobinaria']['type'];

                $valor = array('id' => $id
                                ,'nombre' => $nombre
                                //,'fotobinaria' => $fotobinaria
,'fotobinaria' => $data
                                ,'tipo' => $tipo);

                //Obtenemos la url
                $url = 'http://localhost/rest/api/fotos/updfoto/';

                $paso = true;
            }

            if(isset($_POST['foto_E']))
            { 
//die('boton e');  
                $id = $this->request->getPost('fotoInputId');
                $nombre = $this->request->getPost('fotoInputNombre');
                $fotobinaria = $this->request->getPost('fotoInputFotobinaria');
                $tipo = $this->request->getPost('fotoInputTipo');

//                $nombre = $this->request->getPost('fotoInputNombre');
                //$nombre = $_FILES['fotoInputFotobinaria']['name'];

//                $fotobinaria = $this->request->getPost('fotoInputFotobinaria');
                $fotobinaria = $_FILES['fotoInputFotobinaria']['tmp_name'];
$data = file_get_contents($fotobinaria);
//$fotobinaria = mysql_escape_string($data);

//                $tipo = $this->request->getPost('fotoInputTipo');
                $tipo = $_FILES['fotoInputFotobinaria']['type'];

                $valor = array('id' => $id
                                ,'nombre' => $nombre
                                //,'fotobinaria' => $fotobinaria
,'fotobinaria' => $data
                                ,'tipo' => $tipo);

                //Obtenemos la url
                $url = 'http://localhost/rest/api/fotos/delfoto/';

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
                                ,'status' => 'TO_ACTIONPHOTO'
                                ,'message' => 'Accciones con foto.');

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

