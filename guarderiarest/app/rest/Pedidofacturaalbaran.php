<?php

/*Instrucciones REST para PedidoFacturaAlbaran*/

//obtenemos todos los pedidofacturaalbaranes
$application->get('/api/pedidofacturaalbaranes', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Pedidofacturaalbaran ORDER BY id";
    $pedidofacturaalbaranes = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($pedidofacturaalbaranes as $pedidofacturaalbaran) 
    {
        $data[] = array(
            'id' => $pedidofacturaalbaran->id,
            'fecha' => $pedidofacturaalbaran->fecha,
            'pedido' => $pedidofacturaalbaran->pedido,
            'factura' => $pedidofacturaalbaran->factura,
            'albaran' => $pedidofacturaalbaran->albaran,
        );
    }
    echo json_encode($data);
});


//buscamos pedidofacturaalbaranes por su fecha
$application->get('/api/pedidofacturaalbaranes/search/{date}', function($date) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Pedidofacturaalbaran WHERE fecha LIKE :date: ORDER BY id";
    $pedidofacturaalbaranes = $application->modelsManager->executeQuery($phql, array(
        'date' => '%' . $date . '%'
    ));
 
    $data = array();
    foreach ($pedidofacturaalbaranes as $pedidofacturaalbaran) 
    {
        $data[] = array(
            'id' => $pedidofacturaalbaran->id,
            'fecha' => $pedidofacturaalbaran->fecha,
            'pedido' => $pedidofacturaalbaran->pedido,
            'factura' => $pedidofacturaalbaran->factura,
            'albaran' => $pedidofacturaalbaran->albaran,
        );
    }
 
    echo json_encode($data);
});


//buscamos pedidofacturaalbaranes por su id
$application->get('/api/pedidofacturaalbaranes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Pedidofacturaalbaran WHERE id = :id:";
    $pedidofacturaalbaran = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el pedidofacturaalbaran no existe
    if ($pedidofacturaalbaran == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el pedidofacturaalbaran si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $pedidofacturaalbaran->id,
	            'fecha' => $pedidofacturaalbaran->fecha,
	            'pedido' => $pedidofacturaalbaran->pedido,
	            'factura' => $pedidofacturaalbaran->factura,
	            'albaran' => $pedidofacturaalbaran->albaran,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo pedidofacturaalbaran
$application->post('/api/pedidofacturaalbaranes', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $pedidofacturaalbaran = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Pedidofacturaalbaran (fecha, pedido, factura, albaran) VALUES (:fecha:, :pedido:, :factura:, :albaran:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'fecha' => $pedidofacturaalbaran->fecha,
        'pedido' => $pedidofacturaalbaran->pedido,
        'factura' => $pedidofacturaalbaran->factura,
        'albaran' => $pedidofacturaalbaran->albaran
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $pedidofacturaalbaran->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $pedidofacturaalbaran));
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


//actualizamos un pedidofacturaalbaran por su id
$application->put('/api/pedidofacturaalbaranes/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $pedidofacturaalbaran = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Pedidofacturaalbaran SET fecha = :fecha:, pedido = :pedido:, factura = :factura:, albaran = :albaran: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'fecha' => $pedidofacturaalbaran->fecha,
        'pedido' => $pedidofacturaalbaran->pedido,
        'factura' => $pedidofacturaalbaran->factura,
        'albaran' => $pedidofacturaalbaran->albaran
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


//eliminamos un pedidofacturaalbaran por su id
$application->delete('/api/pedidofacturaalbaranes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Pedidofacturaalbaran WHERE id = :id:";
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
