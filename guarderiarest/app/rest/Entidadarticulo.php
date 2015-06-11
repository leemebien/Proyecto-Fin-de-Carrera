<?php

/*Instrucciones REST para Entidad-Articulo*/

//obtenemos todos los entidadarticulos
$application->get('/api/entidadarticulos', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadarticulo ORDER BY id";
    $entidadarticulos = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($entidadarticulos as $entidadarticulo) 
    {
        $data[] = array(
            'id' => $entidadarticulo->id,
            'entidad' => $entidadarticulo->entidad,
            'articulo' => $entidadarticulo->articulo,
            'precio' => $entidadarticulo->precio,
        );
    }
    echo json_encode($data);
});


//buscamos entidadarticulos por su entidad
$application->get('/api/entidadarticulos/search/{identity}', function($identity) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadarticulo WHERE entidad LIKE :identity: ORDER BY id";
    $entidadarticulos = $application->modelsManager->executeQuery($phql, array(
        'identity' => '%' . $identity . '%'
    ));
 
    $data = array();
    foreach ($entidadarticulos as $entidadarticulo) 
    {
        $data[] = array(
            'id' => $entidadarticulo->id,
            'entidad' => $entidadarticulo->entidad,
            'articulo' => $entidadarticulo->articulo,
            'precio' => $entidadarticulo->precio,
        );
    }
 
    echo json_encode($data);
});


//buscamos entidadarticulos por su id
$application->get('/api/entidadarticulos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadarticulo WHERE id = :id:";
    $entidadarticulo = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el entidadarticulo no existe
    if ($entidadarticulo == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el entidadarticulo si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $entidadarticulo->id,
	            'entidad' => $entidadarticulo->entidad,
	            'articulo' => $entidadarticulo->articulo,
	            'precio' => $entidadarticulo->precio,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo entidadarticulo
$application->post('/api/entidadarticulos', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadarticulo = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Entidadarticulo (entidad, articulo, precio) VALUES (:entidad:, :articulo:, :precio:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'entidad' => $entidadarticulo->entidad,
        'articulo' => $entidadarticulo->articulo,
        'precio' => $entidadarticulo->precio
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $entidadarticulo->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $entidadarticulo));
    } 
    else 
    {
        //en otro caso cambiamos el estado http por un 500
        $response->setStatusCode(500, "Internal Error");
 
        //enviamos los errores
        $errors = array();
        foreach ($status->getMessages() as $message) {
            $errors[] = $message->getMessage();
        }
 
        $response->setJsonContent(array('status' => 'ERROR', 'messages' => $errors));
    }
    return $response;
});


//actualizamos un entidadarticulo por su id
$application->put('/api/entidadarticulos/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadarticulo = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Entidadarticulo SET entidad = :entidad:, articulo = :articulo:, precio = :precio: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'entidad' => $entidadarticulo->entidad,
        'articulo' => $entidadarticulo->articulo,
        'precio' => $entidadarticulo->precio
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si la actualización se ha llevado a cabo correctamente
    if ($status->success() == true) 
    {
        $response->setJsonContent(array('status' => 'OK'));
    } 
    else 
    {
        //en otro caso cambiamos el estado http por un 500
        $response->setStatusCode(500, "Internal Error");
 
        $errors = array();
        foreach ($status->getMessages() as $message) 
        {
            $errors[] = $message->getMessage();
        }
        $response->setJsonContent(array('status' => 'ERROR', 'messages' => $errors));
    }
    return $response;
});


//eliminamos un entidadarticulo por su id
$application->delete('/api/entidadarticulos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Entidadarticulo WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si la eliminación se ha llevado a cabo correctamente
    if ($status->success() == true) 
    {
        $response->setJsonContent(array('status' => 'OK'));
    } 
    else 
    {
        ////en otro caso cambiamos el estado http por un 500
        $response->setStatusCode(500, "Internal Error");
 
        $errors = array();
 
        //mostramos los errores
        foreach ($status->getMessages() as $message) 
        {
            $errors[] = $message->getMessage();
        }
        $response->setJsonContent(array('status' => 'ERROR', 'messages' => $errors));
    }
    return $response;
});
