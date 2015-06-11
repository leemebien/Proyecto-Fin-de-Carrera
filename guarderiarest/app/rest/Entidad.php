<?php

/*Instrucciones REST para Entidad*/

//obtenemos todos los entidades
$application->get('/api/entidades', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidad ORDER BY id";
    $entidades = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($entidades as $entidad) 
    {
        $data[] = array(
            'id' => $entidad->id,
            'tipo' => $entidad->tipo,
            'dni' => $entidad->dni,
            'nombre' => $entidad->nombre,
            'apellido1' => $entidad->apellido1,
            'apellido2' => $entidad->apellido2,
            'direccion' => $entidad->direccion,
            'telefono' => $entidad->telefono,
            'movil' => $entidad->movil,
            'email' => $entidad->email,
            'sexo' => $entidad->sexo,
            'fechanacimiento' => $entidad->fechanacimiento,
            'cuenta' => $entidad->cuenta,
            'salario' => $entidad->salario,
        );
    }
    echo json_encode($data);
});


//buscamos entidades por su tipo
$application->get('/api/entidades/search/{type}', function($type) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidad WHERE tipo LIKE :type: ORDER BY id";
    $entidades = $application->modelsManager->executeQuery($phql, array(
        'type' => '%' . $type . '%'
    ));
 
    $data = array();
    foreach ($entidades as $entidad) 
    {
        $data[] = array(
            'id' => $entidad->id,
            'tipo' => $entidad->tipo,
            'dni' => $entidad->dni,
            'nombre' => $entidad->nombre,
            'apellido1' => $entidad->apellido1,
            'apellido2' => $entidad->apellido2,
            'direccion' => $entidad->direccion,
            'telefono' => $entidad->telefono,
            'movil' => $entidad->movil,
            'email' => $entidad->email,
            'sexo' => $entidad->sexo,
            'fechanacimiento' => $entidad->fechanacimiento,
            'cuenta' => $entidad->cuenta,
            'salario' => $entidad->salario,
        );
    }
 
    echo json_encode($data);
});


//buscamos entidades por su id
$application->get('/api/entidades/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Entidad WHERE id = :id:";
    $entidad = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el entidad no existe
    if ($entidad == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el entidad si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $entidad->id,
	            'tipo' => $entidad->tipo,
	            'dni' => $entidad->dni,
	            'nombre' => $entidad->nombre,
	            'apellido1' => $entidad->apellido1,
	            'apellido2' => $entidad->apellido2,
	            'direccion' => $entidad->direccion,
	            'telefono' => $entidad->telefono,
	            'movil' => $entidad->movil,
	            'email' => $entidad->email,
	            'sexo' => $entidad->sexo,
	            'fechanacimiento' => $entidad->fechanacimiento,
	            'cuenta' => $entidad->cuenta,
	            'salario' => $entidad->salario,
            )
        ));
    }
    return $response;
});


//añadimos un nuevo entidad
$application->post('/api/entidades', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $entidad = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Entidad (tipo, dni, nombre, apellido1, apellido2, direccion, telefono, movil, email, sexo, fechanacimiento, cuenta, salario) VALUES (:tipo:, :dni:, :nombre:, :apellido1:, :apellido2:, :direccion:, :telefono:, :movil:, :email:, :sexo:, :fechanacimiento:, :cuenta:, :salario:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'tipo' => $entidad->tipo,
        'dni' => $entidad->dni,
        'nombre' => $entidad->nombre,
        'apellido1' => $entidad->apellido1,
        'apellido2' => $entidad->apellido2,
        'direccion' => $entidad->direccion,
        'telefono' => $entidad->telefono,
        'movil' => $entidad->movil,
        'email' => $entidad->email,
        'sexo' => $entidad->sexo,
        'fechanacimiento' => $entidad->fechanacimiento,
        'cuenta' => $entidad->cuenta,
        'salario' => $entidad->salario
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $entidad->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $entidad));
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


//actualizamos un entidad por su id
$application->put('/api/entidades/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $entidad = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Entidad SET tipo = :tipo:, dni = :dni:, nombre = :nombre:, apellido1 = :apellido1:, apellido2 = :apellido2:, direccion = :direccion:, telefono = :telefono:, movil = :movil:, email = :email:, sexo = :sexo:, fechanacimiento = :fechanacimiento:, cuenta = :cuenta:, salario = :salario: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'tipo' => $entidad->tipo,
        'dni' => $entidad->dni,
        'nombre' => $entidad->nombre,
        'apellido1' => $entidad->apellido1,
        'apellido2' => $entidad->apellido2,
        'direccion' => $entidad->direccion,
        'telefono' => $entidad->telefono,
        'movil' => $entidad->movil,
        'email' => $entidad->email,
        'sexo' => $entidad->sexo,
        'fechanacimiento' => $entidad->fechanacimiento,
        'cuenta' => $entidad->cuenta,
        'salario' => $entidad->salario
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


//eliminamos un entidad por su id
$application->delete('/api/entidades/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Entidad WHERE id = :id:";
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
