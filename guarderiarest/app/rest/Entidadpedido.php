<?php

/*Instrucciones REST para Entidad-Pedido*/

//obtenemos todos los entidadpedidos
$application->get('/api/entidadpedidos', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadpedido ORDER BY id";
    $entidadpedidos = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($entidadpedidos as $entidadpedido) 
    {
        $data[] = array(
            'id' => $entidadpedido->id,
            'pedido' => $entidadpedido->pedido,
            'creador' => $entidadpedido->creador,
            'destinatario' => $entidadpedido->destinatario,
        );
    }
    echo json_encode($data);
});


//buscamos entidadpedidos por su pedido
$application->get('/api/entidadpedidos/search/{order}', function($order) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadpedido WHERE pedido LIKE :order: ORDER BY id";
    $entidadpedidos = $application->modelsManager->executeQuery($phql, array(
        'order' => '%' . $order . '%'
    ));
 
    $data = array();
    foreach ($entidadpedidos as $entidadpedido) 
    {
        $data[] = array(
            'id' => $entidadpedido->id,
            'pedido' => $entidadpedido->pedido,
            'creador' => $entidadpedido->creador,
            'destinatario' => $entidadpedido->destinatario,
        );
    }
 
    echo json_encode($data);
});


//buscamos entidadpedidos por su id
$application->get('/api/entidadpedidos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadpedido WHERE id = :id:";
    $entidadpedido = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el entidadpedido no existe
    if ($entidadpedido == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el entidadpedido si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $entidadpedido->id,
	            'pedido' => $entidadpedido->pedido,
	            'creador' => $entidadpedido->creador,
	            'destinatario' => $entidadpedido->destinatario,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo entidadpedido
$application->post('/api/entidadpedidos', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadpedido = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Entidadpedido (pedido, creador, destinatario) VALUES (:pedido:, :creador:, :destinatario:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'pedido' => $entidadpedido->pedido,
        'creador' => $entidadpedido->creador,
        'destinatario' => $entidadpedido->destinatario
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $entidadpedido->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $entidadpedido));
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


//actualizamos un entidadpedido por su id
$application->put('/api/entidadpedidos/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadpedido = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Entidadpedido SET pedido = :pedido:, creador = :creador:, destinatario = :destinatario: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'pedido' => $entidadpedido->pedido,
        'creador' => $entidadpedido->creador,
        'destinatario' => $entidadpedido->destinatario
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


//eliminamos un entidadpedido por su id
$application->delete('/api/entidadpedidos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Entidadpedido WHERE id = :id:";
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
