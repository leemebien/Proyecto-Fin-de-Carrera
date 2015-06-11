<?php

/*Instrucciones REST para Persona Responsable*/

//obtenemos todos los personaresponsables
$application->get('/api/personaresponsables', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Personaresponsable ORDER BY id";
    $personaresponsables = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($personaresponsables as $personaresponsable) 
    {
        $data[] = array(
            'id' => $personaresponsable->id,
            'alumno' => $personaresponsable->alumno,
            'responsable' => $personaresponsable->responsable,
            'tipo' => $personaresponsable->tipo,
        );
    }
    echo json_encode($data);
});


//buscamos personaresponsables por su alumno
$application->get('/api/personaresponsables/search/{student}', function($student) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Personaresponsable WHERE alumno LIKE :student: ORDER BY id";
    $personaresponsables = $application->modelsManager->executeQuery($phql, array(
        'student' => '%' . $student . '%'
    ));
 
    $data = array();
    foreach ($personaresponsables as $personaresponsable) 
    {
        $data[] = array(
            'id' => $personaresponsable->id,
            'alumno' => $personaresponsable->alumno,
            'responsable' => $personaresponsable->responsable,
            'tipo' => $personaresponsable->tipo,
        );
    }
 
    echo json_encode($data);
});


//buscamos personaresponsables por su id
$application->get('/api/personaresponsables/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Personaresponsable WHERE id = :id:";
    $personaresponsable = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el personaresponsable no existe
    if ($personaresponsable == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el personaresponsable si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $personaresponsable->id,
	            'alumno' => $personaresponsable->alumno,
	            'responsable' => $personaresponsable->responsable,
	            'tipo' => $personaresponsable->tipo,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo personaresponsable
$application->post('/api/personaresponsables', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $personaresponsable = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Personaresponsable (alumno, responsable, tipo) VALUES (:alumno:, :responsable:, :tipo:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'alumno' => $personaresponsable->alumno,
        'responsable' => $personaresponsable->responsable,
        'tipo' => $personaresponsable->tipo
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $personaresponsable->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $personaresponsable));
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


//actualizamos un personaresponsable por su id
$application->put('/api/personaresponsables/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $personaresponsable = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Personaresponsable SET alumno = :alumno:, responsable = :responsable:, tipo = :tipo: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'alumno' => $personaresponsable->alumno,
        'responsable' => $personaresponsable->responsable,
        'tipo' => $personaresponsable->tipo
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


//eliminamos un personaresponsable por su id
$application->delete('/api/personaresponsables/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Personaresponsable WHERE id = :id:";
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
