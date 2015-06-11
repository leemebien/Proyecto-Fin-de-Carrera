<?php

/*Instrucciones REST para Entidad-Nomina*/

//obtenemos todos los entidadnominas
$application->get('/api/entidadnominas', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadnomina ORDER BY id";
    $entidadnominas = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($entidadnominas as $entidadnomina) 
    {
        $data[] = array(
            'id' => $entidadnomina->id,
            'nomina' => $entidadnomina->nomina,
            'creador' => $entidadnomina->creador,
            'destinatario' => $entidadnomina->destinatario,
        );
    }
    echo json_encode($data);
});


//buscamos entidadnominas por su nomina
$application->get('/api/entidadnominas/search/{salary}', function($salary) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadnomina WHERE nomina LIKE :salary: ORDER BY id";
    $entidadnominas = $application->modelsManager->executeQuery($phql, array(
        'salary' => '%' . $salary . '%'
    ));
 
    $data = array();
    foreach ($entidadnominas as $entidadnomina) 
    {
        $data[] = array(
            'id' => $entidadnomina->id,
            'nomina' => $entidadnomina->nomina,
            'creador' => $entidadnomina->creador,
            'destinatario' => $entidadnomina->destinatario,
        );
    }
 
    echo json_encode($data);
});


//buscamos entidadnominas por su id
$application->get('/api/entidadnominas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadnomina WHERE id = :id:";
    $entidadnomina = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el entidadnomina no existe
    if ($entidadnomina == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el entidadnomina si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $entidadnomina->id,
	            'nomina' => $entidadnomina->nomina,
	            'creador' => $entidadnomina->creador,
	            'destinatario' => $entidadnomina->destinatario,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo entidadnomina
$application->post('/api/entidadnominas', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadnomina = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Entidadnomina (nomina, creador, destinatario) VALUES (:nomina:, :creador:, :destinatario:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nomina' => $entidadnomina->nomina,
        'creador' => $entidadnomina->creador,
        'destinatario' => $entidadnomina->destinatario
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $entidadnomina->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $entidadnomina));
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


//actualizamos un entidadnomina por su id
$application->put('/api/entidadnominas/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadnomina = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Entidadnomina SET nomina = :nomina:, creador = :creador:, destinatario = :destinatario: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nomina' => $entidadnomina->nomina,
        'creador' => $entidadnomina->creador,
        'destinatario' => $entidadnomina->destinatario
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


//eliminamos un entidadnomina por su id
$application->delete('/api/entidadnominas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Entidadnomina WHERE id = :id:";
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
