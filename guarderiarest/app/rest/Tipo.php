<?php

/*Instrucciones REST para Tipo*/

//obtenemos todos los tipos
$application->get('/api/tipos', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Tipo ORDER BY id";
    $tipos = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($tipos as $tipo) 
    {
        $data[] = array(
            'id' => $tipo->id,
            'clave' => $tipo->clave,
            'nombre' => $tipo->nombre,
            'descripcion' => $tipo->descripcion,
        );
    }
    echo json_encode($data);
});


//buscamos tipos por su nombre
$application->get('/api/tipos/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Tipo WHERE nombre LIKE :name: ORDER BY id";
    $tipos = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($tipos as $tipo) 
    {
        $data[] = array(
            'id' => $tipo->id,
            'clave' => $tipo->clave,
            'nombre' => $tipo->nombre,
            'descripcion' => $tipo->descripcion,
        );
    }
 
    echo json_encode($data);
});


//buscamos tipos por su id
$application->get('/api/tipos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Tipo WHERE id = :id:";
    $tipo = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el tipo no existe
    if ($tipo == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el tipo si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $tipo->id,
                'clave' => $tipo->clave,
                'nombre' => $tipo->nombre,
                'descripcion' => $tipo->descripcion,
            )
        ));
    }
    return $response;
});


//buscamos un tipo por su nombre pero siendo un usuario registrado
$application->post('/api/tipos/search/login', function() use ($application)
{
    //obtenemos el json que se ha enviado
    $data = $application->request->getJsonRawBody();

    //chequeamos el usuario registrado
    $phql = "SELECT * FROM Usuario WHERE nombre LIKE :name: AND password LIKE :pass: ORDER BY id";
    $usuario = $application->modelsManager->executeQuery($phql, array(
        'name' => $data->login->name,
        'pass' => $data->login->pass
    ))->getFirst();

    //creamos la respuesta
    $response = new Phalcon\Http\Response();

    if($usuario == false)
    {
        //respuesta negativa
        $response->setJsonContent(array('status' => 'NOT_LOGIN'));
    }
    else
    {
        //buscamos los tipos
        $phql = "SELECT * FROM Tipo WHERE nombre LIKE :name: ORDER BY id";
        $tipos = $application->modelsManager->executeQuery($phql, array(
            'name' => '%' . $data->data->name . '%'
        ));
 
        $data = array();
        foreach ($tipos as $tipo) 
        {
            $data[] = array(
                'id' => $tipo->id,
                'clave' => $tipo->clave,
                'nombre' => $tipo->nombre,
                'descripcion' => $tipo->descripcion,
            );
        };

        //respuesta afirmativa
        $response->setJsonContent(array('status' => 'OK', 'data' => $data));
    }

    return $response;
});


//añadimos un nuevo tipo
$application->post('/api/tipos', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $tipo = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Tipo (clave, nombre, descripcion) VALUES (:clave:, :nombre:, :descripcion:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'clave' => $tipo->clave,
        'nombre' => $tipo->nombre,
        'descripcion' => $tipo->descripcion
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $tipo->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $tipo));
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


//actualizamos un tipo por su id
$application->put('/api/tipos/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $tipo = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Tipo SET clave = :clave:, nombre = :nombre:, descripcion = :descripcion: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'clave' => $tipo->clave,
        'nombre' => $tipo->nombre,
        'descripcion' => $tipo->descripcion
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


//eliminamos un tipo por su id
$application->delete('/api/tipos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Tipo WHERE id = :id:";
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
