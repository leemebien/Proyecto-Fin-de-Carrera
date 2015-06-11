<?php

/*Instrucciones REST para Entidad-Factura*/

//obtenemos todos los entidadfacturas
$application->get('/api/entidadfacturas', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadfactura ORDER BY id";
    $entidadfacturas = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($entidadfacturas as $entidadfactura) 
    {
        $data[] = array(
            'id' => $entidadfactura->id,
            'factura' => $entidadfactura->factura,
            'creador' => $entidadfactura->creador,
            'destinatario' => $entidadfactura->destinatario,
        );
    }
    echo json_encode($data);
});


//buscamos entidadfacturas por su factura
$application->get('/api/entidadfacturas/search/{receipt}', function($receipt) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadfactura WHERE factura LIKE :receipt: ORDER BY id";
    $entidadfacturas = $application->modelsManager->executeQuery($phql, array(
        'receipt' => '%' . $receipt . '%'
    ));
 
    $data = array();
    foreach ($entidadfacturas as $entidadfactura) 
    {
        $data[] = array(
            'id' => $entidadfactura->id,
            'factura' => $entidadfactura->factura,
            'creador' => $entidadfactura->creador,
            'destinatario' => $entidadfactura->destinatario,
        );
    }
 
    echo json_encode($data);
});


//buscamos entidadfacturas por su id
$application->get('/api/entidadfacturas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadfactura WHERE id = :id:";
    $entidadfactura = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el entidadfactura no existe
    if ($entidadfactura == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el entidadfactura si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $entidadfactura->id,
	            'factura' => $entidadfactura->factura,
	            'creador' => $entidadfactura->creador,
	            'destinatario' => $entidadfactura->destinatario,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo entidadfactura
$application->post('/api/entidadfacturas', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadfactura = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Entidadfactura (factura, creador, destinatario) VALUES (:factura:, :creador:, :destinatario:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'factura' => $entidadfactura->factura,
        'creador' => $entidadfactura->creador,
        'destinatario' => $entidadfactura->destinatario
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $entidadfactura->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $entidadfactura));
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


//actualizamos un entidadfactura por su id
$application->put('/api/entidadfacturas/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadfactura = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Entidadfactura SET factura = :factura:, creador = :creador:, destinatario = :destinatario: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'factura' => $entidadfactura->factura,
        'creador' => $entidadfactura->creador,
        'destinatario' => $entidadfactura->destinatario
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


//eliminamos un entidadfactura por su id
$application->delete('/api/entidadfacturas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Entidadfactura WHERE id = :id:";
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
