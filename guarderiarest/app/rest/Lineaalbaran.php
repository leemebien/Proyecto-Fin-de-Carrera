<?php

/*Instrucciones REST para Linea Albaran*/

//obtenemos todos los lineaalbaranes
$application->get('/api/lineaalbaranes', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineaalbaran ORDER BY id";
    $lineaalbaranes = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($lineaalbaranes as $lineaalbaran) 
    {
        $data[] = array(
            'id' => $lineaalbaran->id,
            'articulo' => $lineaalbaran->articulo,
            'cantidad' => $lineaalbaran->cantidad,
            'precio' => $lineaalbaran->precio,
            'albaran' => $lineaalbaran->albaran,
        );
    }
    echo json_encode($data);
});


//buscamos lineaalbaranes por su articulo
$application->get('/api/lineaalbaranes/search/{item}', function($item) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineaalbaran WHERE articulo LIKE :item: ORDER BY id";
    $lineaalbaranes = $application->modelsManager->executeQuery($phql, array(
        'item' => '%' . $item . '%'
    ));
 
    $data = array();
    foreach ($lineaalbaranes as $lineaalbaran) 
    {
        $data[] = array(
            'id' => $lineaalbaran->id,
            'articulo' => $lineaalbaran->articulo,
            'cantidad' => $lineaalbaran->cantidad,
            'precio' => $lineaalbaran->precio,
            'albaran' => $lineaalbaran->albaran,
        );
    }
 
    echo json_encode($data);
});


//buscamos lineaalbaranes por su id
$application->get('/api/lineaalbaranes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineaalbaran WHERE id = :id:";
    $lineaalbaran = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el lineaalbaran no existe
    if ($lineaalbaran == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el lineaalbaran si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $lineaalbaran->id,
	            'articulo' => $lineaalbaran->articulo,
	            'cantidad' => $lineaalbaran->cantidad,
	            'precio' => $lineaalbaran->precio,
	            'albaran' => $lineaalbaran->albaran,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo lineaalbaran
$application->post('/api/lineaalbaranes', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $lineaalbaran = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Lineaalbaran (articulo, cantidad, precio, albaran) VALUES (:articulo:, :cantidad:, :precio:, :albaran:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'articulo' => $lineaalbaran->articulo,
        'cantidad' => $lineaalbaran->cantidad,
        'precio' => $lineaalbaran->precio,
        'albaran' => $lineaalbaran->albaran
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $lineaalbaran->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $lineaalbaran));
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


//actualizamos un lineaalbaran por su id
$application->put('/api/lineaalbaranes/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $lineaalbaran = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Lineaalbaran SET articulo = :articulo:, cantidad = :cantidad:, precio = :precio:, albaran = :albaran: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'articulo' => $lineaalbaran->articulo,
        'cantidad' => $lineaalbaran->cantidad,
        'precio' => $lineaalbaran->precio,
        'albaran' => $lineaalbaran->albaran
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


//eliminamos un lineaalbaran por su id
$application->delete('/api/lineaalbaranes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Lineaalbaran WHERE id = :id:";
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
