<?php

/*Instrucciones REST para Pedido*/

//obtenemos todos los pedidos
$application->get('/api/pedidos', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Pedido ORDER BY id";
    $pedidos = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($pedidos as $pedido) 
    {
        $data[] = array(
            'id' => $pedido->id,
            'fecha' => $pedido->fecha,
            'saldo' => $pedido->saldo,
            'estado' => $pedido->estado,
        );
    }
    echo json_encode($data);
});


//buscamos pedidos por su fecha
$application->get('/api/pedidos/search/{date}', function($date) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Pedido WHERE fecha LIKE :date: ORDER BY id";
    $pedidos = $application->modelsManager->executeQuery($phql, array(
        'date' => '%' . $date . '%'
    ));
 
    $data = array();
    foreach ($pedidos as $pedido) 
    {
        $data[] = array(
            'id' => $pedido->id,
            'fecha' => $pedido->fecha,
            'saldo' => $pedido->saldo,
            'estado' => $pedido->estado,
        );
    }
 
    echo json_encode($data);
});


//buscamos pedidos por su id
$application->get('/api/pedidos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Pedido WHERE id = :id:";
    $pedido = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el pedido no existe
    if ($pedido == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el pedido si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $pedido->id,
	            'fecha' => $pedido->fecha,
	            'saldo' => $pedido->saldo,
	            'estado' => $pedido->estado,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo pedido
$application->post('/api/pedidos', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $pedido = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Pedido (fecha, saldo, estado) VALUES (:fecha:, :saldo:, :estado:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'fecha' => $pedido->fecha,
        'saldo' => $pedido->saldo,
        'estado' => $pedido->estado
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $pedido->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $pedido));
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


//actualizamos un pedido por su id
$application->put('/api/pedidos/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $pedido = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Pedido SET fecha = :fecha:, saldo = :saldo:, estado = :estado: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'fecha' => $pedido->fecha,
        'saldo' => $pedido->saldo,
        'estado' => $pedido->estado
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


//eliminamos un pedido por su id
$application->delete('/api/pedidos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Pedido WHERE id = :id:";
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
