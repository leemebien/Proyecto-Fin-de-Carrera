<?php

/*Instrucciones REST para Linea Menu*/

//obtenemos todos los lineamenus
$application->get('/api/lineamenus', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineamenu ORDER BY id";
    $lineamenus = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($lineamenus as $lineamenu) 
    {
        $data[] = array(
            'id' => $lineamenu->id,
            'nombre' => $lineamenu->nombre,
            'descripcion' => $lineamenu->descripcion,
            'menu' => $lineamenu->menu,
            'plato' => $lineamenu->plato,
            'orden' => $lineamenu->orden,
        );
    }
    echo json_encode($data);
});


//buscamos lineamenus por su nombre
$application->get('/api/lineamenus/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineamenu WHERE nombre LIKE :name: ORDER BY id";
    $lineamenus = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($lineamenus as $lineamenu) 
    {
        $data[] = array(
            'id' => $lineamenu->id,
            'nombre' => $lineamenu->nombre,
            'descripcion' => $lineamenu->descripcion,
            'menu' => $lineamenu->menu,
            'plato' => $lineamenu->plato,
            'orden' => $lineamenu->orden,
        );
    }
 
    echo json_encode($data);
});


//buscamos lineamenus por su id
$application->get('/api/lineamenus/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineamenu WHERE id = :id:";
    $lineamenu = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el lineamenu no existe
    if ($lineamenu == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el lineamenu si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $lineamenu->id,
	            'nombre' => $lineamenu->nombre,
	            'descripcion' => $lineamenu->descripcion,
	            'menu' => $lineamenu->menu,
	            'plato' => $lineamenu->plato,
	            'orden' => $lineamenu->orden,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo lineamenu
$application->post('/api/lineamenus', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $lineamenu = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Lineamenu (nombre, descripcion, menu, plato, orden) VALUES (:nombre:, :descripcion:, :menu:, :plato:, :orden:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $lineamenu->nombre,
        'descripcion' => $lineamenu->descripcion,
        'menu' => $lineamenu->menu,
        'plato' => $lineamenu->plato,
        'orden' => $lineamenu->orden
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $lineamenu->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $lineamenu));
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


//actualizamos un lineamenu por su id
$application->put('/api/lineamenus/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $lineamenu = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Lineamenu SET nombre = :nombre:, descripcion = :descripcion:, menu = :menu:, plato = :plato:, orden = :orden: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $lineamenu->nombre,
        'descripcion' => $lineamenu->descripcion,
        'menu' => $lineamenu->menu,
        'plato' => $lineamenu->plato,
        'orden' => $lineamenu->orden
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


//eliminamos un lineamenu por su id
$application->delete('/api/lineamenus/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Lineamenu WHERE id = :id:";
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
