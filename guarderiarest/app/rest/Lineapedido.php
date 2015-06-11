<?php

/*Instrucciones REST para Linea Pedido*/

//obtenemos todos los lineapedidos
$application->get('/api/lineapedidos', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineapedido ORDER BY id";
    $lineapedidos = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($lineapedidos as $lineapedido) 
    {
        $data[] = array(
            'id' => $lineapedido->id,
            'articulo' => $lineapedido->articulo,
            'cantidad' => $lineapedido->cantidad,
            'precio' => $lineapedido->precio,
            'pedido' => $lineapedido->pedido,
        );
    }
    echo json_encode($data);
});


//buscamos lineapedidos por su articulo
$application->get('/api/lineapedidos/search/{item}', function($item) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineapedido WHERE articulo LIKE :item: ORDER BY id";
    $lineapedidos = $application->modelsManager->executeQuery($phql, array(
        'item' => '%' . $item . '%'
    ));
 
    $data = array();
    foreach ($lineapedidos as $lineapedido) 
    {
        $data[] = array(
            'id' => $lineapedido->id,
            'articulo' => $lineapedido->articulo,
            'cantidad' => $lineapedido->cantidad,
            'precio' => $lineapedido->precio,
            'pedido' => $lineapedido->pedido,
        );
    }
 
    echo json_encode($data);
});


//buscamos lineapedidos por su id
$application->get('/api/lineapedidos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineapedido WHERE id = :id:";
    $lineapedido = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el lineapedido no existe
    if ($lineapedido == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el lineapedido si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $lineapedido->id,
	            'articulo' => $lineapedido->articulo,
	            'cantidad' => $lineapedido->cantidad,
	            'precio' => $lineapedido->precio,
	            'pedido' => $lineapedido->pedido,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo lineapedido
$application->post('/api/lineapedidos', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $lineapedido = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Lineapedido (articulo, cantidad, precio, pedido) VALUES (:articulo:, :cantidad:, :precio:, :pedido:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'articulo' => $lineapedido->articulo,
        'cantidad' => $lineapedido->cantidad,
        'precio' => $lineapedido->precio,
        'pedido' => $lineapedido->pedido
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $lineapedido->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $lineapedido));
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


//actualizamos un lineapedido por su id
$application->put('/api/lineapedidos/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $lineapedido = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Lineapedido SET articulo = :articulo:, cantidad = :cantidad:, precio = :precio:, pedido = :pedido: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'articulo' => $lineapedido->articulo,
        'cantidad' => $lineapedido->cantidad,
        'precio' => $lineapedido->precio,
        'pedido' => $lineapedido->pedido
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


//eliminamos un lineapedido por su id
$application->delete('/api/lineapedidos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Lineapedido WHERE id = :id:";
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
