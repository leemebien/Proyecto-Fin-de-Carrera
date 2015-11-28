<?php
/*
//include ("../gweb/app/clases/Datoenvio.php");
include ("../clases/Datoenvio.php");



    //deshabilitamos la vista para peticiones ajax
    //$this->view->disable();

	$a = $_GET['a'];
///	$aa = unserialize($a);
$aa = json_decode($a)
	$imagen = $aa->getFotobinaria();
	$tipo = $aa->getTipo();
/*
	$f = $_GET['f'];
	$tipo = $f->getTipo();
	$imagen = $f->getFotobinaria();
*/	
/*
                $data = json_decode($a);
//echo $data->dato;                

                //Desmontamos el JSON
                $dato = $data->dato;

$datoenvio = new Datoenvio();

                //Desmontamos los datos de envio
                $datoenvio->obtenerDatos($dato);

                //Obtenemos la Sesion y la informacion
                $sesion = $datoenvio->getSesion();
                $dato = $datoenvio->getDato();
$imagen = $dato->getFotobinaria();
$tipo = $dato->getTipo();


header("Content-type: $tipo ");
//header('Content-type: image/jpeg ');


	echo $imagen;
//die($imagen);
	*/
/*
	$tiec = $_GET['tipo'];
	$imec = $_GET['imagen'];
/*
$crypt = new \Phalcon\Crypt();
$tipo = $crypt->decrypt($tiec, "samuelmoralesmangas27979");
$imagen = $crypt->decrypt($imec, "samuelmoralesmangas27979");
*/
	//$json = $_GET['json'];
	$json = $_POST['json'];

//                $data = json_decode($json);
//$data=$json;
$data = $json;

$a='';
    for ($i=0; $i < strlen($data)-1; $i+=2){
        $a .= chr(hexdec($data[$i].$data[$i+1]));
    }



$sd = unserialize($a);

$tipo = $sd['tipo'];
$imagen = $sd['imagen'];

/*
$tipo = $data['tipo'];
$imagen = $data['imagen'];
*/

header("Content-type: $tipo ");

	//echo $imagen;
	imagejpeg($imagen);

	?>
