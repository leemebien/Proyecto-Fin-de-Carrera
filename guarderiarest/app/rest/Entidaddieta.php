<?php

/*Instrucciones REST para Entidad-Dieta*/

//obtenemos todos los entidaddietas
$application->get('/api/entidaddietas', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidaddieta ORDER BY id";
    $entidaddietas = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($entidaddietas as $entidaddieta) 
    {
        $data[] = array(
            'id' => $entidaddieta->id,
            'alumno' => $entidaddieta->alumno,
            'dieta' => $entidaddieta->dieta,
        );
    }
    echo json_encode($data);
});


//buscamos entidaddietas por su alumno
$application->get('/api/entidaddietas/search/{student}', function($student) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidaddieta WHERE alumno LIKE :student: ORDER BY id";
    $entidaddietas = $application->modelsManager->executeQuery($phql, array(
        'student' => '%' . $student . '%'
    ));
 
    $data = array();
    foreach ($entidaddietas as $entidaddieta) 
    {
        $data[] = array(
            'id' => $entidaddieta->id,
            'alumno' => $entidaddieta->alumno,
            'dieta' => $entidaddieta->dieta,
        );
    }
 
    echo json_encode($data);
});


//buscamos entidaddietas por su id
$application->get('/api/entidaddietas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidaddieta WHERE id = :id:";
    $entidaddieta = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el entidaddieta no existe
    if ($entidaddieta == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el entidaddieta si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $entidaddieta->id,
	            'alumno' => $entidaddieta->alumno,
	            'dieta' => $entidaddieta->dieta,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo entidaddieta
$application->post('/api/entidaddietas', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $entidaddieta = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Entidaddieta (alumno, dieta) VALUES (:alumno:, :dieta:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'alumno' => $entidaddieta->alumno,
        'dieta' => $entidaddieta->dieta
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $entidaddieta->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $entidaddieta));
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


//actualizamos un entidaddieta por su id
$application->put('/api/entidaddietas/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $entidaddieta = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Entidaddieta SET alumno = :alumno:, dieta = :dieta: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'alumno' => $entidaddieta->alumno,
        'dieta' => $entidaddieta->dieta
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


//eliminamos un entidaddieta por su id
$application->delete('/api/entidaddietas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Entidaddieta WHERE id = :id:";
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
