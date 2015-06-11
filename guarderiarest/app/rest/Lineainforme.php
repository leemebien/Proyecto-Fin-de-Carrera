<?php

/*Instrucciones REST para Linea Informe*/

//obtenemos todos los lineainformes
$application->get('/api/lineainformes', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineainforme ORDER BY id";
    $lineainformes = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($lineainformes as $lineainforme) 
    {
        $data[] = array(
            'id' => $lineainforme->id,
            'descripcion' => $lineainforme->descripcion,
            'informe' => $lineainforme->informe,
        );
    }
    echo json_encode($data);
});


//buscamos lineainformes por su descripcion
$application->get('/api/lineainformes/search/{description}', function($description) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineainforme WHERE descripcion LIKE :description: ORDER BY id";
    $lineainformes = $application->modelsManager->executeQuery($phql, array(
        'description' => '%' . $description . '%'
    ));
 
    $data = array();
    foreach ($lineainformes as $lineainforme) 
    {
        $data[] = array(
            'id' => $lineainforme->id,
            'descripcion' => $lineainforme->descripcion,
            'informe' => $lineainforme->informe,
        );
    }
 
    echo json_encode($data);
});


//buscamos lineainformes por su id
$application->get('/api/lineainformes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineainforme WHERE id = :id:";
    $lineainforme = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el lineainforme no existe
    if ($lineainforme == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el lineainforme si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $lineainforme->id,
	            'descripcion' => $lineainforme->descripcion,
	            'informe' => $lineainforme->informe,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo lineainforme
$application->post('/api/lineainformes', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $lineainforme = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Lineainforme (descripcion, informe) VALUES (:descripcion:, :informe:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'descripcion' => $lineainforme->descripcion,
        'informe' => $lineainforme->informe
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $lineainforme->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $lineainforme));
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


//actualizamos un lineainforme por su id
$application->put('/api/lineainformes/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $lineainforme = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Lineainforme SET descripcion = :descripcion:, informe = :informe: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'descripcion' => $lineainforme->descripcion,
        'informe' => $lineainforme->informe
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


//eliminamos un lineainforme por su id
$application->delete('/api/lineainformes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Lineainforme WHERE id = :id:";
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

