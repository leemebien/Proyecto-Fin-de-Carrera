<?php

/*Instrucciones REST para Linea Nomina*/

//obtenemos todos los lineanominas
$application->get('/api/lineanominas', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineanomina ORDER BY id";
    $lineanominas = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($lineanominas as $lineanomina) 
    {
        $data[] = array(
            'id' => $lineanomina->id,
            'articulo' => $lineanomina->articulo,
            'cantidad' => $lineanomina->cantidad,
            'precio' => $lineanomina->precio,
            'nomina' => $lineanomina->nomina,
        );
    }
    echo json_encode($data);
});


//buscamos lineanominas por su articulo
$application->get('/api/lineanominas/search/{item}', function($item) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineanomina WHERE articulo LIKE :item: ORDER BY id";
    $lineanominas = $application->modelsManager->executeQuery($phql, array(
        'item' => '%' . $item . '%'
    ));
 
    $data = array();
    foreach ($lineanominas as $lineanomina) 
    {
        $data[] = array(
            'id' => $lineanomina->id,
            'articulo' => $lineanomina->articulo,
            'cantidad' => $lineanomina->cantidad,
            'precio' => $lineanomina->precio,
            'nomina' => $lineanomina->nomina,
        );
    }
 
    echo json_encode($data);
});


//buscamos lineanominas por su id
$application->get('/api/lineanominas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Lineanomina WHERE id = :id:";
    $lineanomina = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el lineanomina no existe
    if ($lineanomina == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el lineanomina si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $lineanomina->id,
	            'articulo' => $lineanomina->articulo,
	            'cantidad' => $lineanomina->cantidad,
	            'precio' => $lineanomina->precio,
	            'nomina' => $lineanomina->nomina,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo lineanomina
$application->post('/api/lineanominas', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $lineanomina = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Lineanomina (articulo, cantidad, precio, nomina) VALUES (:articulo:, :cantidad:, :precio:, :nomina:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'articulo' => $lineanomina->articulo,
        'cantidad' => $lineanomina->cantidad,
        'precio' => $lineanomina->precio,
        'nomina' => $lineanomina->nomina
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $lineanomina->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $lineanomina));
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


//actualizamos un lineanomina por su id
$application->put('/api/lineanominas/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $lineanomina = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Lineanomina SET articulo = :articulo:, cantidad = :cantidad:, precio = :precio:, nomina = :nomina: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'articulo' => $lineanomina->articulo,
        'cantidad' => $lineanomina->cantidad,
        'precio' => $lineanomina->precio,
        'nomina' => $lineanomina->nomina
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


//eliminamos un lineanomina por su id
$application->delete('/api/lineanominas/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Lineanomina WHERE id = :id:";
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
