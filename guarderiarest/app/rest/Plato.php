<?php

/*Instrucciones REST para Plato*/

//obtenemos todos los platos
$application->get('/api/platos', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Plato ORDER BY id";
    $platos = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($platos as $plato) 
    {
        $data[] = array(
            'id' => $plato->id,
            'nombre' => $plato->nombre,
            'descripcion' => $plato->descripcion,
            'ingredientes' => $plato->ingredientes,
        );
    }
    echo json_encode($data);
});


//buscamos platos por su nombre
$application->get('/api/platos/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Plato WHERE nombre LIKE :name: ORDER BY id";
    $platos = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($platos as $plato) 
    {
        $data[] = array(
            'id' => $plato->id,
            'nombre' => $plato->nombre,
            'descripcion' => $plato->descripcion,
            'ingredientes' => $plato->ingredientes,
        );
    }
 
    echo json_encode($data);
});


//buscamos platos por su id
$application->get('/api/platos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Plato WHERE id = :id:";
    $plato = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el plato no existe
    if ($plato == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el plato si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $plato->id,
	            'nombre' => $plato->nombre,
	            'descripcion' => $plato->descripcion,
	            'ingredientes' => $plato->ingredientes,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo plato
$application->post('/api/platos', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $plato = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Plato (nombre, descripcion, ingredientes) VALUES (:nombre:, :descripcion:, :ingredientes:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $plato->nombre,
        'descripcion' => $plato->descripcion,
        'ingredientes' => $plato->ingredientes
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $plato->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $plato));
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


//actualizamos un plato por su id
$application->put('/api/platos/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $plato = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Plato SET nombre = :nombre:, descripcion = :descripcion:, ingredientes = :ingredientes: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $plato->nombre,
        'descripcion' => $plato->descripcion,
        'ingredientes' => $plato->ingredientes
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


//eliminamos un plato por su id
$application->delete('/api/platos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Plato WHERE id = :id:";
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
