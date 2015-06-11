<?php

/*Instrucciones REST para Entidad-Albaran*/

//obtenemos todos los entidadalbaranes
$application->get('/api/entidadalbaranes', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadalbaran ORDER BY id";
    $entidadalbaranes = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($entidadalbaranes as $entidadalbaran) 
    {
        $data[] = array(
            'id' => $entidadalbaran->id,
            'albaran' => $entidadalbaran->albaran,
            'creador' => $entidadalbaran->creador,
            'destinatario' => $entidadalbaran->destinatario,
        );
    }
    echo json_encode($data);
});


//buscamos entidadalbaranes por su albaran
$application->get('/api/entidadalbaranes/search/{deliverynote}', function($deliverynote) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadalbaran WHERE albaran LIKE :deliverynote: ORDER BY id";
    $entidadalbaranes = $application->modelsManager->executeQuery($phql, array(
        'deliverynote' => '%' . $deliverynote . '%'
    ));
 
    $data = array();
    foreach ($entidadalbaranes as $entidadalbaran) 
    {
        $data[] = array(
            'id' => $entidadalbaran->id,
            'albaran' => $entidadalbaran->albaran,
            'creador' => $entidadalbaran->creador,
            'destinatario' => $entidadalbaran->destinatario,
        );
    }
 
    echo json_encode($data);
});


//buscamos entidadalbaranes por su id
$application->get('/api/entidadalbaranes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadalbaran WHERE id = :id:";
    $entidadalbaran = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el entidadalbaran no existe
    if ($entidadalbaran == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el entidadalbaran si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $entidadalbaran->id,
	            'albaran' => $entidadalbaran->albaran,
	            'creador' => $entidadalbaran->creador,
	            'destinatario' => $entidadalbaran->destinatario,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo entidadalbaran
$application->post('/api/entidadalbaranes', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadalbaran = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Entidadalbaran (albaran, creador, destinatario) VALUES (:albaran:, :creador:, :destinatario:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'albaran' => $entidadalbaran->albaran,
        'creador' => $entidadalbaran->creador,
        'destinatario' => $entidadalbaran->destinatario
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $entidadalbaran->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $entidadalbaran));
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


//actualizamos un entidadalbaran por su id
$application->put('/api/entidadalbaranes/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadalbaran = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Entidadalbaran SET albaran = :albaran:, creador = :creador:, destinatario = :destinatario: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'albaran' => $entidadalbaran->albaran,
        'creador' => $entidadalbaran->creador,
        'destinatario' => $entidadalbaran->destinatario
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


//eliminamos un entidadalbaran por su id
$application->delete('/api/entidadalbaranes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Entidadalbaran WHERE id = :id:";
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
