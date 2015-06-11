<?php

/*Instrucciones REST para Menu*/

//obtenemos todos los menus
$application->get('/api/menus', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Menu ORDER BY id";
    $menus = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($menus as $menu) 
    {
        $data[] = array(
            'id' => $menu->id,
            'nombre' => $menu->nombre,
            'descripcion' => $menu->descripcion,
            'dieta' => $menu->dieta,
        );
    }
    echo json_encode($data);
});


//buscamos menus por su nombre
$application->get('/api/menus/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Menu WHERE nombre LIKE :name: ORDER BY id";
    $menus = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($menus as $menu) 
    {
        $data[] = array(
            'id' => $menu->id,
            'nombre' => $menu->nombre,
            'descripcion' => $menu->descripcion,
            'dieta' => $menu->dieta,
        );
    }
 
    echo json_encode($data);
});


//buscamos menus por su id
$application->get('/api/menus/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Menu WHERE id = :id:";
    $menu = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el menu no existe
    if ($menu == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el menu si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $menu->id,
	            'nombre' => $menu->nombre,
	            'descripcion' => $menu->descripcion,
	            'dieta' => $menu->dieta,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo menu
$application->post('/api/menus', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $menu = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Menu (nombre, descripcion, dieta) VALUES (:nombre:, :descripcion:, :dieta:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $menu->nombre,
        'descripcion' => $menu->descripcion,
        'dieta' => $menu->dieta
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $menu->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $menu));
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


//actualizamos un menu por su id
$application->put('/api/menus/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $menu = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Menu SET nombre = :nombre:, descripcion = :descripcion:, dieta = :dieta: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $menu->nombre,
        'descripcion' => $menu->descripcion,
        'dieta' => $menu->dieta
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


//eliminamos un menu por su id
$application->delete('/api/menus/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Menu WHERE id = :id:";
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
