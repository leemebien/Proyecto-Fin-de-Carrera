<?php

/*Instrucciones REST para Factura*/

//obtenemos todos los facturas
$application->get('/api/facturas', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Factura ORDER BY id";
    $facturas = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($facturas as $factura) 
    {
        $data[] = array(
            'id' => $factura->id,
            'fecha' => $factura->fecha,
            'saldo' => $factura->saldo,
            'estado' => $factura->estado,
        );
    }
    echo json_encode($data);
});


//buscamos facturas por su fecha
$application->get('/api/facturas/search/{date}', function($date) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Factura WHERE fecha LIKE :date: ORDER BY id";
    $facturas = $application->modelsManager->executeQuery($phql, array(
        'date' => '%' . $date . '%'
    ));
 
    $data = array();
    foreach ($facturas as $factura) 
    {
        $data[] = array(
            'id' => $factura->id,
            'fecha' => $factura->fecha,
            'saldo' => $factura->saldo,
            'estado' => $factura->estado,
        );
    }
 
    echo json_encode($data);
});


//buscamos facturas por su id
$application->get('/api/facturas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Factura WHERE id = :id:";
    $factura = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el factura no existe
    if ($factura == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el factura si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $factura->id,
	            'fecha' => $factura->fecha,
	            'saldo' => $factura->saldo,
	            'estado' => $factura->estado,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo factura
$application->post('/api/facturas', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $factura = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Factura (fecha, saldo, estado) VALUES (:fecha:, :saldo:, :estado:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'fecha' => $factura->fecha,
        'saldo' => $factura->saldo,
        'estado' => $factura->estado
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $factura->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $factura));
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


//actualizamos un factura por su id
$application->put('/api/facturas/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $factura = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Factura SET fecha = :fecha:, saldo = :saldo:, estado = :estado: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'fecha' => $factura->fecha,
        'saldo' => $factura->saldo,
        'estado' => $factura->estado
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


//eliminamos un factura por su id
$application->delete('/api/facturas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Factura WHERE id = :id:";
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
