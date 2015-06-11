<?php

/*Instrucciones REST para Dieta*/

//obtenemos todos los dietas
$application->get('/api/dietas', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Dieta ORDER BY id";
    $dietas = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($dietas as $dieta) 
    {
        $data[] = array(
            'id' => $dieta->id,
            'nombre' => $dieta->nombre,
            'descripcion' => $dieta->descripcion,
        );
    }
    echo json_encode($data);
});


//buscamos dietas por su nombre
$application->get('/api/dietas/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Dieta WHERE nombre LIKE :name: ORDER BY id";
    $dietas = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($dietas as $dieta) 
    {
        $data[] = array(
            'id' => $dieta->id,
            'nombre' => $dieta->nombre,
            'descripcion' => $dieta->descripcion,
        );
    }
 
    echo json_encode($data);
});


//buscamos dietas por su id
$application->get('/api/dietas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Dieta WHERE id = :id:";
    $dieta = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el dieta no existe
    if ($dieta == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el dieta si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $dieta->id,
	            'nombre' => $dieta->nombre,
	            'descripcion' => $dieta->descripcion,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo dieta
$application->post('/api/dietas', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $dieta = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Dieta (nombre, descripcion) VALUES (:nombre:, :descripcion:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $dieta->nombre,
        'descripcion' => $dieta->descripcion
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $dieta->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $dieta));
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


//actualizamos un dieta por su id
$application->put('/api/dietas/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $dieta = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Dieta SET nombre = :nombre:, descripcion = :descripcion: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $dieta->nombre,
        'descripcion' => $dieta->descripcion
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


//eliminamos un dieta por su id
$application->delete('/api/dietas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Dieta WHERE id = :id:";
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
