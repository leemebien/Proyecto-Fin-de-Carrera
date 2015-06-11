<?php

/*Instrucciones REST para Libro Contabilidad*/

//obtenemos todos los librocontabilidades
$application->get('/api/librocontabilidades', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Librocontabilidad ORDER BY id";
    $librocontabilidades = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($librocontabilidades as $librocontabilidad) 
    {
        $data[] = array(
            'id' => $librocontabilidad->id,
            'fecha' => $librocontabilidad->fecha,
            'debe' => $librocontabilidad->debe,
            'haber' => $librocontabilidad->haber,
            'saldo' => $librocontabilidad->saldo,
        );
    }
    echo json_encode($data);
});


//buscamos librocontabilidades por su fecha
$application->get('/api/librocontabilidades/search/{date}', function($date) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Librocontabilidad WHERE fecha LIKE :date: ORDER BY id";
    $librocontabilidades = $application->modelsManager->executeQuery($phql, array(
        'date' => '%' . $date . '%'
    ));
 
    $data = array();
    foreach ($librocontabilidades as $librocontabilidad) 
    {
        $data[] = array(
            'id' => $librocontabilidad->id,
            'fecha' => $librocontabilidad->fecha,
            'debe' => $librocontabilidad->debe,
            'haber' => $librocontabilidad->haber,
            'saldo' => $librocontabilidad->saldo,
        );
    }
 
    echo json_encode($data);
});


//buscamos librocontabilidades por su id
$application->get('/api/librocontabilidades/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Librocontabilidad WHERE id = :id:";
    $librocontabilidad = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el librocontabilidad no existe
    if ($librocontabilidad == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el librocontabilidad si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $librocontabilidad->id,
	            'fecha' => $librocontabilidad->fecha,
	            'debe' => $librocontabilidad->debe,
	            'haber' => $librocontabilidad->haber,
	            'saldo' => $librocontabilidad->saldo,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo librocontabilidad
$application->post('/api/librocontabilidades', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $librocontabilidad = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Librocontabilidad (fecha, debe, haber, saldo) VALUES (:fecha:, :debe:, :haber:, :saldo:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'fecha' => $librocontabilidad->fecha,
        'debe' => $librocontabilidad->debe,
        'haber' => $librocontabilidad->haber,
        'saldo' => $librocontabilidad->saldo
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $librocontabilidad->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $librocontabilidad));
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


//actualizamos un librocontabilidad por su id
$application->put('/api/librocontabilidades/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $librocontabilidad = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Librocontabilidad SET fecha = :fecha:, debe = :debe:, haber = :haber:, saldo = :saldo: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'fecha' => $librocontabilidad->fecha,
        'debe' => $librocontabilidad->debe,
        'haber' => $librocontabilidad->haber,
        'saldo' => $librocontabilidad->saldo
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


//eliminamos un librocontabilidad por su id
$application->delete('/api/librocontabilidades/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Librocontabilidad WHERE id = :id:";
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

