<?php

/*Instrucciones REST para Entidad-Informe*/

//obtenemos todos los entidadinformes
$application->get('/api/entidadinformes', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadinforme ORDER BY id";
    $entidadinformes = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($entidadinformes as $entidadinforme) 
    {
        $data[] = array(
            'id' => $entidadinforme->id,
            'informe' => $entidadinforme->informe,
            'usuariocreador' => $entidadinforme->usuariocreador,
            'usuarioultimamodificacion' => $entidadinforme->usuarioultimamodificacion,
            'articulo' => $entidadinforme->articulo,
            'sala' => $entidadinforme->sala,
            'entidad' => $entidadinforme->entidad,
        );
    }
    echo json_encode($data);
});


//buscamos entidadinformes por su informe
$application->get('/api/entidadinformes/search/{report}', function($report) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadinforme WHERE informe LIKE :report: ORDER BY id";
    $entidadinformes = $application->modelsManager->executeQuery($phql, array(
        'report' => '%' . $report . '%'
    ));
 
    $data = array();
    foreach ($entidadinformes as $entidadinforme) 
    {
        $data[] = array(
            'id' => $entidadinforme->id,
            'informe' => $entidadinforme->informe,
            'usuariocreador' => $entidadinforme->usuariocreador,
            'usuarioultimamodificacion' => $entidadinforme->usuarioultimamodificacion,
            'articulo' => $entidadinforme->articulo,
            'sala' => $entidadinforme->sala,
            'entidad' => $entidadinforme->entidad,
        );
    }
 
    echo json_encode($data);
});


//buscamos entidadinformes por su id
$application->get('/api/entidadinformes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidadinforme WHERE id = :id:";
    $entidadinforme = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el entidadinforme no existe
    if ($entidadinforme == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el entidadinforme si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $entidadinforme->id,
	            'informe' => $entidadinforme->informe,
	            'usuariocreador' => $entidadinforme->usuariocreador,
	            'usuarioultimamodificacion' => $entidadinforme->usuarioultimamodificacion,
	            'articulo' => $entidadinforme->articulo,
	            'sala' => $entidadinforme->sala,
	            'entidad' => $entidadinforme->entidad,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo entidadinforme
$application->post('/api/entidadinformes', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadinforme = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Entidadinforme (informe, usuariocreador, usuarioultimamodificacion, articulo, sala, entidad) VALUES (:informe:, :usuariocreador:, :usuarioultimamodificacion:, :articulo:, :sala:, :entidad:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'informe' => $entidadinforme->informe,
        'usuariocreador' => $entidadinforme->usuariocreador,
        'usuarioultimamodificacion' => $entidadinforme->usuarioultimamodificacion,
        'articulo' => $entidadinforme->articulo,
        'sala' => $entidadinforme->sala,
        'entidad' => $entidadinforme->entidad
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $entidadinforme->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $entidadinforme));
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


//actualizamos un entidadinforme por su id
$application->put('/api/entidadinformes/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $entidadinforme = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Entidadinforme SET informe = :informe:, usuariocreador = :usuariocreador:, usuarioultimamodificacion = :usuarioultimamodificacion:, articulo = :articulo:, sala = :sala:, entidad = :entidad: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'informe' => $entidadinforme->informe,
        'usuariocreador' => $entidadinforme->usuariocreador,
        'usuarioultimamodificacion' => $entidadinforme->usuarioultimamodificacion,
        'articulo' => $entidadinforme->articulo,
        'sala' => $entidadinforme->sala,
        'entidad' => $entidadinforme->entidad
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


//eliminamos un entidadinforme por su id
$application->delete('/api/entidadinformes/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Entidadinforme WHERE id = :id:";
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
