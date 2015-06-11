<?php

/*Instrucciones REST para Rol*/

//obtenemos todos los roles
$application->get('/api/roles', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Rol ORDER BY id";
    $roles = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($roles as $rol) 
    {
        $data[] = array(
            'id' => $rol->id,
            'nombre' => $rol->nombre,
            'descripcion' => $rol->descripcion,
            'nivel' => $rol->nivel,
        );
    }
    echo json_encode($data);
});


//buscamos roles por su nombre
$application->get('/api/roles/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Rol WHERE nombre LIKE :name: ORDER BY id";
    $roles = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($roles as $rol) 
    {
        $data[] = array(
            'id' => $rol->id,
            'nombre' => $rol->nombre,
            'descripcion' => $rol->descripcion,
            'nivel' => $rol->nivel,
        );
    }
 
    echo json_encode($data);
});


//buscamos roles por su id
$application->get('/api/roles/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Rol WHERE id = :id:";
    $rol = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el rol no existe
    if ($rol == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el rol si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $rol->id,
	            'nombre' => $rol->nombre,
	            'descripcion' => $rol->descripcion,
	            'nivel' => $rol->nivel,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo rol
$application->post('/api/roles', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $rol = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Rol (nombre, descripcion, nivel) VALUES (:nombre:, :descripcion:, :nivel:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $rol->nombre,
        'descripcion' => $rol->descripcion,
        'nivel' => $rol->nivel
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $rol->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $rol));
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


//actualizamos un rol por su id
$application->put('/api/roles/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $rol = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Rol SET nombre = :nombre:, descripcion = :descripcion:, nivel = :nivel: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $rol->nombre,
        'descripcion' => $rol->descripcion,
        'nivel' => $rol->nivel
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


//eliminamos un rol por su id
$application->delete('/api/roles/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Rol WHERE id = :id:";
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
