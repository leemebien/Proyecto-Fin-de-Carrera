<?php

/*Instrucciones REST para Sala*/

//obtenemos todos los salas
$application->get('/api/salas', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Sala ORDER BY id";
    $salas = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($salas as $sala) 
    {
        $data[] = array(
            'id' => $sala->id,
            'nombre' => $sala->nombre,
            'descripcion' => $sala->descripcion,
            'aforo' => $sala->aforo,
            'tipo' => $sala->tipo,
            'estado' => $sala->estado,
            'centro' => $sala->centro,
        );
    }
    echo json_encode($data);
});


//buscamos salas por su nombre
$application->get('/api/salas/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Sala WHERE nombre LIKE :name: ORDER BY id";
    $salas = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($salas as $sala) 
    {
        $data[] = array(
            'id' => $sala->id,
            'nombre' => $sala->nombre,
            'descripcion' => $sala->descripcion,
            'aforo' => $sala->aforo,
            'tipo' => $sala->tipo,
            'estado' => $sala->estado,
            'centro' => $sala->centro,
        );
    }
 
    echo json_encode($data);
});


//buscamos salas por su id
$application->get('/api/salas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Sala WHERE id = :id:";
    $sala = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el sala no existe
    if ($sala == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el sala si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $sala->id,
	            'nombre' => $sala->nombre,
	            'descripcion' => $sala->descripcion,
	            'aforo' => $sala->aforo,
	            'tipo' => $sala->tipo,
	            'estado' => $sala->estado,
	            'centro' => $sala->centro,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo sala
$application->post('/api/salas', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $sala = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Sala (nombre, descripcion, aforo, tipo, estado, centro) VALUES (:nombre:, :descripcion:, :aforo:, :tipo:, :estado:, :centro:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $sala->nombre,
        'descripcion' => $sala->descripcion,
        'aforo' => $sala->aforo,
        'tipo' => $sala->tipo,
        'estado' => $sala->estado,
        'centro' => $sala->centro
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $sala->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $sala));
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


//actualizamos un sala por su id
$application->put('/api/salas/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $sala = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Sala SET nombre = :nombre:, descripcion = :descripcion:, aforo = :aforo:, tipo = :tipo:, estado = :estado:, centro = :centro: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $sala->nombre,
        'descripcion' => $sala->descripcion,
        'aforo' => $sala->aforo,
        'tipo' => $sala->tipo,
        'estado' => $sala->estado,
        'centro' => $sala->centro
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


//eliminamos un sala por su id
$application->delete('/api/salas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Sala WHERE id = :id:";
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
