<?php

/*Instrucciones REST para Nomina*/

//obtenemos todos los nominas
$application->get('/api/nominas', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Nomina ORDER BY id";
    $nominas = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($nominas as $nomina) 
    {
        $data[] = array(
            'id' => $nomina->id,
            'fecha' => $nomina->fecha,
            'saldo' => $nomina->saldo,
            'estado' => $nomina->estado,
        );
    }
    echo json_encode($data);
});


//buscamos nominas por su fecha
$application->get('/api/nominas/search/{date}', function($date) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Nomina WHERE fecha LIKE :date: ORDER BY id";
    $nominas = $application->modelsManager->executeQuery($phql, array(
        'date' => '%' . $date . '%'
    ));
 
    $data = array();
    foreach ($nominas as $nomina) 
    {
        $data[] = array(
            'id' => $nomina->id,
            'fecha' => $nomina->fecha,
            'saldo' => $nomina->saldo,
            'estado' => $nomina->estado,
        );
    }
 
    echo json_encode($data);
});


//buscamos nominas por su id
$application->get('/api/nominas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Nomina WHERE id = :id:";
    $nomina = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el nomina no existe
    if ($nomina == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el nomina si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $nomina->id,
	            'fecha' => $nomina->fecha,
	            'saldo' => $nomina->saldo,
	            'estado' => $nomina->estado,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo nomina
$application->post('/api/nominas', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $nomina = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Nomina (fecha, saldo, estado) VALUES (:fecha:, :saldo:, :estado:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'fecha' => $nomina->fecha,
        'saldo' => $nomina->saldo,
        'estado' => $nomina->estado
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $nomina->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $nomina));
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


//actualizamos un nomina por su id
$application->put('/api/nominas/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $nomina = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Nomina SET fecha = :fecha:, saldo = :saldo:, estado = :estado: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'fecha' => $nomina->fecha,
        'saldo' => $nomina->saldo,
        'estado' => $nomina->estado
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


//eliminamos un nomina por su id
$application->delete('/api/nominas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Nomina WHERE id = :id:";
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
