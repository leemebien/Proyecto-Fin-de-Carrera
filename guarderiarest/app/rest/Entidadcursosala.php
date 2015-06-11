<?php

/*Instrucciones REST para Entidad-Curso-Sala*/

//obtenemos todos los entidadcursosalas
$application->get('/api/entidadcursosalas', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadcursosala ORDER BY id";
    $entidadcursosalas = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($entidadcursosalas as $entidadcursosala) 
    {
        $data[] = array(
            'id' => $entidadcursosala->id,
            'entidad' => $entidadcursosala->entidad,
            'curso' => $entidadcursosala->curso,
            'sala' => $entidadcursosala->sala,
        );
    }
    echo json_encode($data);
});


//buscamos entidadcursosalas por su entidad
$application->get('/api/entidadcursosalas/search/{identity}', function($identity) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadcursosala WHERE entidad LIKE :identity: ORDER BY id";
    $entidadcursosalas = $application->modelsManager->executeQuery($phql, array(
        'identity' => '%' . $identity . '%'
    ));
 
    $data = array();
    foreach ($entidadcursosalas as $entidadcursosala) 
    {
        $data[] = array(
            'id' => $entidadcursosala->id,
            'entidad' => $entidadcursosala->entidad,
            'curso' => $entidadcursosala->curso,
            'sala' => $entidadcursosala->sala,
        );
    }
 
    echo json_encode($data);
});


//buscamos entidadcursosalas por su id
$application->get('/api/entidadcursosalas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadcursosala WHERE id = :id:";
    $entidadcursosala = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el entidadcursosala no existe
    if ($entidadcursosala == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el entidadcursosala si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $entidadcursosala->id,
	            'entidad' => $entidadcursosala->entidad,
	            'curso' => $entidadcursosala->curso,
	            'sala' => $entidadcursosala->sala,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo entidadcursosala
$application->post('/api/entidadcursosalas', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadcursosala = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Entidadcursosala (entidad, curso, sala) VALUES (:entidad:, :curso:, :sala:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'entidad' => $entidadcursosala->entidad,
        'curso' => $entidadcursosala->curso,
        'sala' => $entidadcursosala->sala
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $entidadcursosala->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $entidadcursosala));
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


//actualizamos un entidadcursosala por su id
$application->put('/api/entidadcursosalas/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadcursosala = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Entidadcursosala SET entidad = :entidad:, curso = :curso:, sala = :sala: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'entidad' => $entidadcursosala->entidad,
        'curso' => $entidadcursosala->curso,
        'sala' => $entidadcursosala->sala
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


//eliminamos un entidadcursosala por su id
$application->delete('/api/entidadcursosalas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Entidadcursosala WHERE id = :id:";
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
