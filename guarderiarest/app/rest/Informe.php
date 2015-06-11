<?php

/*Instrucciones REST para Informe*/

//obtenemos todos los informes
$application->get('/api/informes', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Informe ORDER BY id";
    $informes = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($informes as $informe) 
    {
        $data[] = array(
            'id' => $informe->id,
            'nombre' => $informe->nombre,
            'concepto' => $informe->concepto,
            'fechacreacion' => $informe->fechacreacion,
            'fechaultimamodificacion' => $informe->fechaultimamodificacion,
            'tipo' => $informe->tipo,
            'estado' => $informe->estado,
        );
    }
    echo json_encode($data);
});


//buscamos informes por su nombre
$application->get('/api/informes/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Informe WHERE nombre LIKE :name: ORDER BY id";
    $informes = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($informes as $informe) 
    {
        $data[] = array(
            'id' => $informe->id,
            'nombre' => $informe->nombre,
            'concepto' => $informe->concepto,
            'fechacreacion' => $informe->fechacreacion,
            'fechaultimamodificacion' => $informe->fechaultimamodificacion,
            'tipo' => $informe->tipo,
            'estado' => $informe->estado,
        );
    }
 
    echo json_encode($data);
});


//buscamos informes por su id
$application->get('/api/informes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Informe WHERE id = :id:";
    $informe = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el informe no existe
    if ($informe == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el informe si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $informe->id,
	            'nombre' => $informe->nombre,
	            'concepto' => $informe->concepto,
	            'fechacreacion' => $informe->fechacreacion,
	            'fechaultimamodificacion' => $informe->fechaultimamodificacion,
	            'tipo' => $informe->tipo,
	            'estado' => $informe->estado,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo informe
$application->post('/api/informes', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $informe = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Informe (nombre, concepto, fechacreacion, fechaultimamodificacion, tipo, estado) VALUES (:nombre:, :concepto:, :fechacreacion:, :fechaultimamodificacion:, :tipo:, :estado:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $informe->nombre,
        'concepto' => $informe->concepto,
        'fechacreacion' => $informe->fechacreacion,
        'fechaultimamodificacion' => $informe->fechaultimamodificacion,
        'tipo' => $informe->tipo,
        'estado' => $informe->estado
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $informe->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $informe));
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


//actualizamos un informe por su id
$application->put('/api/informes/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $informe = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Informe SET nombre = :nombre:, concepto = :concepto:, fechacreacion = :fechacreacion:, fechaultimamodificacion = :fechaultimamodificacion:, tipo = :tipo:, estado = :estado: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $informe->nombre,
        'concepto' => $informe->concepto,
        'fechacreacion' => $informe->fechacreacion,
        'fechaultimamodificacion' => $informe->fechaultimamodificacion,
        'tipo' => $informe->tipo,
        'estado' => $informe->estado
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


//eliminamos un informe por su id
$application->delete('/api/informes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Informe WHERE id = :id:";
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

