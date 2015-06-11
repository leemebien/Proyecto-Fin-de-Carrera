<?php

/*Instrucciones REST para Linea Factura*/

//obtenemos todos los lineafacturas
$application->get('/api/lineafacturas', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineafactura ORDER BY id";
    $lineafacturas = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($lineafacturas as $lineafactura) 
    {
        $data[] = array(
            'id' => $lineafactura->id,
            'articulo' => $lineafactura->articulo,
            'cantidad' => $lineafactura->cantidad,
            'precio' => $lineafactura->precio,
            'factura' => $lineafactura->factura,
        );
    }
    echo json_encode($data);
});


//buscamos lineafacturas por su articulo
$application->get('/api/lineafacturas/search/{item}', function($item) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineafactura WHERE articulo LIKE :item: ORDER BY id";
    $lineafacturas = $application->modelsManager->executeQuery($phql, array(
        'item' => '%' . $item . '%'
    ));
 
    $data = array();
    foreach ($lineafacturas as $lineafactura) 
    {
        $data[] = array(
            'id' => $lineafactura->id,
            'articulo' => $lineafactura->articulo,
            'cantidad' => $lineafactura->cantidad,
            'precio' => $lineafactura->precio,
            'factura' => $lineafactura->factura,
        );
    }
 
    echo json_encode($data);
});


//buscamos lineafacturas por su id
$application->get('/api/lineafacturas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineafactura WHERE id = :id:";
    $lineafactura = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el lineafactura no existe
    if ($lineafactura == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el lineafactura si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $lineafactura->id,
	            'articulo' => $lineafactura->articulo,
	            'cantidad' => $lineafactura->cantidad,
	            'precio' => $lineafactura->precio,
	            'factura' => $lineafactura->factura,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo lineafactura
$application->post('/api/lineafacturas', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $lineafactura = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Lineafactura (articulo, cantidad, precio, factura) VALUES (:articulo:, :cantidad:, :precio:, :factura:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'articulo' => $lineafactura->articulo,
        'cantidad' => $lineafactura->cantidad,
        'precio' => $lineafactura->precio,
        'factura' => $lineafactura->factura
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $lineafactura->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $lineafactura));
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


//actualizamos un lineafactura por su id
$application->put('/api/lineafacturas/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $lineafactura = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Lineafactura SET articulo = :articulo:, cantidad = :cantidad:, precio = :precio:, factura = :factura: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'articulo' => $lineafactura->articulo,
        'cantidad' => $lineafactura->cantidad,
        'precio' => $lineafactura->precio,
        'factura' => $lineafactura->factura
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


//eliminamos un lineafactura por su id
$application->delete('/api/lineafacturas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Lineafactura WHERE id = :id:";
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
