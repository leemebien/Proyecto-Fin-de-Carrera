<?php

/*Instrucciones REST para Curso*/

//obtenemos todos los cursos
$application->get('/api/cursos', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Curso ORDER BY id";
    $cursos = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($cursos as $curso) 
    {
        $data[] = array(
            'id' => $curso->id,
            'nombre' => $curso->nombre,
            'descripcion' => $curso->descripcion,
            'fechainicio' => $curso->fechainicio,
            'fechafin' => $curso->fechafin,
        );
    }
    echo json_encode($data);
});


//buscamos cursos por su nombre
$application->get('/api/cursos/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Curso WHERE nombre LIKE :name: ORDER BY id";
    $cursos = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($cursos as $curso) 
    {
        $data[] = array(
            'id' => $curso->id,
            'nombre' => $curso->nombre,
            'descripcion' => $curso->descripcion,
            'fechainicio' => $curso->fechainicio,
            'fechafin' => $curso->fechafin,
        );
    }
 
    echo json_encode($data);
});


//buscamos cursos por su id
$application->get('/api/cursos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Curso WHERE id = :id:";
    $curso = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el curso no existe
    if ($curso == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el curso si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $curso->id,
	            'nombre' => $curso->nombre,
	            'descripcion' => $curso->descripcion,
	            'fechainicio' => $curso->fechainicio,
	            'fechafin' => $curso->fechafin,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo curso
$application->post('/api/cursos', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $curso = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Curso (nombre, descripcion, fechainicio, fechafin) VALUES (:nombre:, :descripcion:, :fechainicio:, :fechafin:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $curso->nombre,
        'descripcion' => $curso->descripcion,
        'fechainicio' => $curso->fechainicio,
        'fechafin' => $curso->fechafin
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $curso->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $curso));
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


//actualizamos un curso por su id
$application->put('/api/cursos/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $curso = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Curso SET nombre = :nombre:, descripcion = :descripcion:, fechainicio = :fechainicio:, fechafin = :fechafin: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $curso->nombre,
        'descripcion' => $curso->descripcion,
        'fechainicio' => $curso->fechainicio,
        'fechafin' => $curso->fechafin
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


//eliminamos un curso por su id
$application->delete('/api/cursos/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Curso WHERE id = :id:";
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
