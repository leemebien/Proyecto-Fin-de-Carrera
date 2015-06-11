<?php

/*Instrucciones REST para Linea Libro Contable*/

//obtenemos todos los linealibrocontabilidades
$application->get('/api/linealibrocontabilidades', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Linealibrocontabilidad ORDER BY id";
    $linealibrocontabilidades = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($linealibrocontabilidades as $linealibrocontabilidad) 
    {
        $data[] = array(
            'id' => $linealibrocontabilidad->id,
            'fecha' => $linealibrocontabilidad->fecha,
            'conceptop' => $linealibrocontabilidad->conceptop,
            'conceptof' => $linealibrocontabilidad->conceptof,
            'concepton' => $linealibrocontabilidad->concepton,
            'descripcion' => $linealibrocontabilidad->descripcion,
            'debe' => $linealibrocontabilidad->debe,
            'haber' => $linealibrocontabilidad->haber,
            'libro' => $linealibrocontabilidad->libro,
        );
    }
    echo json_encode($data);
});


//buscamos linealibrocontabilidades por su fecha
$application->get('/api/linealibrocontabilidades/search/{date}', function($date) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Linealibrocontabilidad WHERE fecha LIKE :date: ORDER BY id";
    $linealibrocontabilidades = $application->modelsManager->executeQuery($phql, array(
        'date' => '%' . $date . '%'
    ));
 
    $data = array();
    foreach ($linealibrocontabilidades as $linealibrocontabilidad) 
    {
        $data[] = array(
            'id' => $linealibrocontabilidad->id,
            'fecha' => $linealibrocontabilidad->fecha,
            'conceptop' => $linealibrocontabilidad->conceptop,
            'conceptof' => $linealibrocontabilidad->conceptof,
            'concepton' => $linealibrocontabilidad->concepton,
            'descripcion' => $linealibrocontabilidad->descripcion,
            'debe' => $linealibrocontabilidad->debe,
            'haber' => $linealibrocontabilidad->haber,
            'libro' => $linealibrocontabilidad->libro,
        );
    }
 
    echo json_encode($data);
});


//buscamos linealibrocontabilidades por su id
$application->get('/api/linealibrocontabilidades/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Linealibrocontabilidad WHERE id = :id:";
    $linealibrocontabilidad = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el linealibrocontabilidad no existe
    if ($linealibrocontabilidad == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el linealibrocontabilidad si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $linealibrocontabilidad->id,
	            'fecha' => $linealibrocontabilidad->fecha,
	            'conceptop' => $linealibrocontabilidad->conceptop,
	            'conceptof' => $linealibrocontabilidad->conceptof,
	            'concepton' => $linealibrocontabilidad->concepton,
	            'descripcion' => $linealibrocontabilidad->descripcion,
	            'debe' => $linealibrocontabilidad->debe,
	            'haber' => $linealibrocontabilidad->haber,
	            'libro' => $linealibrocontabilidad->libro,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo linealibrocontabilidad
$application->post('/api/linealibrocontabilidades', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $linealibrocontabilidad = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Linealibrocontabilidad (fecha, conceptop, conceptof, concepton, descripcion, debe, haber, libro) VALUES (:fecha:, :conceptop:, :conceptof:, :concepton:, :descripcion:, :debe:, :haber:, :libro:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'fecha' => $linealibrocontabilidad->fecha,
        'conceptop' => $linealibrocontabilidad->conceptop,
        'conceptof' => $linealibrocontabilidad->conceptof,
        'concepton' => $linealibrocontabilidad->concepton,
        'descripcion' => $linealibrocontabilidad->descripcion,
        'debe' => $linealibrocontabilidad->debe,
        'haber' => $linealibrocontabilidad->haber,
        'libro' => $linealibrocontabilidad->libro
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $linealibrocontabilidad->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $linealibrocontabilidad));
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


//actualizamos un linealibrocontabilidad por su id
$application->put('/api/linealibrocontabilidades/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $linealibrocontabilidad = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Linealibrocontabilidad SET fecha = :fecha:, conceptop = :conceptop:, conceptof = :conceptof:, concepton = :concepton:, descripcion = :descripcion:, debe = :debe:, haber = :haber:, libro = :libro: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'fecha' => $linealibrocontabilidad->fecha,
        'conceptop' => $linealibrocontabilidad->conceptop,
        'conceptof' => $linealibrocontabilidad->conceptof,
        'concepton' => $linealibrocontabilidad->concepton,
        'descripcion' => $linealibrocontabilidad->descripcion,
        'debe' => $linealibrocontabilidad->debe,
        'haber' => $linealibrocontabilidad->haber,
        'libro' => $linealibrocontabilidad->libro
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


//eliminamos un linealibrocontabilidad por su id
$application->delete('/api/linealibrocontabilidades/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Linealibrocontabilidad WHERE id = :id:";
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

