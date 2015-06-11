<?php

/*Instrucciones REST para Articulo*/

//obtenemos todos los articulos
$application->get('/api/articulos', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Articulo ORDER BY id";
    $articulos = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($articulos as $articulo) 
    {
        $data[] = array(
            'id' => $articulo->id,
            'nombre' => $articulo->nombre,
            'descripcion' => $articulo->descripcion,
            'cantidad' => $articulo->cantidad,
            'tipo' => $articulo->tipo,
        );
    }
    echo json_encode($data);
});


//buscamos articulos por su nombre
$application->get('/api/articulos/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Articulo WHERE nombre LIKE :name: ORDER BY id";
    $articulos = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($articulos as $articulo) 
    {
        $data[] = array(
            'id' => $articulo->id,
            'nombre' => $articulo->nombre,
            'descripcion' => $articulo->descripcion,
            'cantidad' => $articulo->cantidad,
            'tipo' => $articulo->tipo,
        );
    }
 
    echo json_encode($data);
});


//buscamos articulos por su id
$application->get('/api/articulos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Articulo WHERE id = :id:";
    $articulo = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el articulo no existe
    if ($articulo == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el articulo si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $articulo->id,
	            'nombre' => $articulo->nombre,
	            'descripcion' => $articulo->descripcion,
	            'cantidad' => $articulo->cantidad,
	            'tipo' => $articulo->tipo,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo articulo
$application->post('/api/articulos', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $articulo = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Articulo (nombre, descripcion, cantidad, tipo) VALUES (:nombre:, :descripcion:, :cantidad:, :tipo:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $articulo->nombre,
        'descripcion' => $articulo->descripcion,
        'cantidad' => $articulo->cantidad,
        'tipo' => $articulo->tipo
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $articulo->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $articulo));
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


//actualizamos un articulo por su id
$application->put('/api/articulos/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $articulo = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Articulo SET nombre = :nombre:, descripcion = :descripcion:, cantidad = :cantidad:, tipo = :tipo: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $articulo->nombre,
        'descripcion' => $articulo->descripcion,
        'cantidad' => $articulo->cantidad,
        'tipo' => $articulo->tipo
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


//eliminamos un articulo por su id
$application->delete('/api/articulos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Articulo WHERE id = :id:";
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
