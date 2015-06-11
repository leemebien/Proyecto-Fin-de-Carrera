<?php

/*Instrucciones REST para Centro*/

//obtenemos todos los centros
$application->get('/api/centros', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Centro ORDER BY id";
    $centros = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($centros as $centro) 
    {
        $data[] = array(
            'id' => $centro->id,
            'nombre' => $centro->nombre,
            'descripcion' => $centro->descripcion,
            'direccion' => $centro->direccion,
            'telefono' => $centro->telefono,
        );
    }
    echo json_encode($data);
});


//buscamos centros por su nombre
$application->get('/api/centros/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Centro WHERE nombre LIKE :name: ORDER BY id";
    $centros = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($centros as $centro) 
    {
        $data[] = array(
            'id' => $centro->id,
            'nombre' => $centro->nombre,
            'descripcion' => $centro->descripcion,
            'direccion' => $centro->direccion,
            'telefono' => $centro->telefono,
        );
    }
 
    echo json_encode($data);
});


//buscamos centros por su id
$application->get('/api/centros/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Centro WHERE id = :id:";
    $centro = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el centro no existe
    if ($centro == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el centro si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $centro->id,
	            'nombre' => $centro->nombre,
	            'descripcion' => $centro->descripcion,
	            'direccion' => $centro->direccion,
	            'telefono' => $centro->telefono,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo centro
$application->post('/api/centros', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $centro = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Centro (nombre, descripcion, direccion, telefono) VALUES (:nombre:, :descripcion:, :direccion:, :telefono:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $centro->nombre,
        'descripcion' => $centro->descripcion,
        'direccion' => $centro->direccion,
        'telefono' => $centro->telefono
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $centro->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $centro));
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


//actualizamos un centro por su id
$application->put('/api/centros/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $centro = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Centro SET nombre = :nombre:, descripcion = :descripcion:, direccion = :direccion:, telefono = :telefono: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $centro->nombre,
        'descripcion' => $centro->descripcion,
        'direccion' => $centro->direccion,
        'telefono' => $centro->telefono
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


//eliminamos un centro por su id
$application->delete('/api/centros/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Centro WHERE id = :id:";
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
