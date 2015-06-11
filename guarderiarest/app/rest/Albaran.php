<?php

/*Instrucciones REST para Albaran*/

//obtenemos todos los albaranes
$application->get('/api/albaranes', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Albaran ORDER BY id";
    $albaranes = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($albaranes as $albaran) 
    {
        $data[] = array(
            'id' => $albaran->id,
            'fecha' => $albaran->fecha,
            'saldo' => $albaran->saldo,
            'estado' => $albaran->estado,
        );
    }
    echo json_encode($data);
});


//buscamos albaranes por su fecha
$application->get('/api/albaranes/search/{date}', function($date) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Albaran WHERE fecha LIKE :date: ORDER BY id";
    $albaranes = $application->modelsManager->executeQuery($phql, array(
        'date' => '%' . $date . '%'
    ));
 
    $data = array();
    foreach ($albaranes as $albaran) 
    {
        $data[] = array(
            'id' => $albaran->id,
            'fecha' => $albaran->fecha,
            'saldo' => $albaran->saldo,
            'estado' => $albaran->estado,
        );
    }
 
    echo json_encode($data);
});


//buscamos albaranes por su id
$application->get('/api/albaranes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Albaran WHERE id = :id:";
    $albaran = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el albaran no existe
    if ($albaran == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el albaran si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $albaran->id,
	            'fecha' => $albaran->fecha,
	            'saldo' => $albaran->saldo,
	            'estado' => $albaran->estado,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo albaran
$application->post('/api/albaranes', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $albaran = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Albaran (fecha, saldo, estado) VALUES (:fecha:, :saldo:, :estado:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'fecha' => $albaran->fecha,
        'saldo' => $albaran->saldo,
        'estado' => $albaran->estado
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $albaran->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $albaran));
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


//actualizamos un albaran por su id
$application->put('/api/albaranes/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $albaran = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Albaran SET fecha = :fecha:, saldo = :saldo:, estado = :estado: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'fecha' => $albaran->fecha,
        'saldo' => $albaran->saldo,
        'estado' => $albaran->estado
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


//eliminamos un albaran por su id
$application->delete('/api/albaranes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Albaran WHERE id = :id:";
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
