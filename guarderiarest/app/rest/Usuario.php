<?php

/*Instrucciones REST para Usuario*/

//obtenemos todos los usuarios
$application->get('/api/usuarios', function() use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Usuario ORDER BY id";
    $usuarios = $application->modelsManager->executeQuery($phql);
 
    $data = array();
    foreach ($usuarios as $usuario) 
    {
        $data[] = array(
            'id' => $usuario->id,
            'nombre' => $usuario->nombre,
            'password' => $usuario->password,
            'entidad' => $usuario->entidad,
            'rol' => $usuario->rol,
            'estado' => $usuario->estado,
        );
    }
    echo json_encode($data);
});


//buscamos usuarios por su nombre
$application->get('/api/usuarios/search/{name}', function($name) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Usuario WHERE nombre LIKE :name: ORDER BY id";
    $usuarios = $application->modelsManager->executeQuery($phql, array(
        'name' => '%' . $name . '%'
    ));
 
    $data = array();
    foreach ($usuarios as $usuario) 
    {
        $data[] = array(
            'id' => $usuario->id,
            'nombre' => $usuario->nombre,
            'password' => $usuario->password,
            'entidad' => $usuario->entidad,
            'rol' => $usuario->rol,
            'estado' => $usuario->estado,
        );
    }
 
    echo json_encode($data);
});


//buscamos usuarios por su id
$application->get('/api/usuarios/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "SELECT * FROM Usuario WHERE id = :id:";
    $usuario = $application->modelsManager->executeQuery($phql, array(
        'id' => $id
    ))->getFirst();
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //si el usuario no existe
    if ($usuario == false) 
    {
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    } 
    else 
    {
        //si el usuario si que existe
        $response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => array(
                'id' => $usuario->id,
	            'nombre' => $usuario->nombre,
	            'password' => $usuario->password,
	            'entidad' => $usuario->entidad,
	            'rol' => $usuario->rol,
	            'estado' => $usuario->estado,
            )
        ));
    }
    return $response;
});


//buscamos usuarios por su nombre y password
$application->post('/api/usuarios/login', function() use ($application) 
{
    //Obtenemos el json que se ha enviado
    $login = $application->request->getJsonRawBody();

    //creamos la consulta con phql
    $phql = "SELECT * FROM Usuario WHERE nombre LIKE :name: AND password LIKE :pass: ORDER BY id";
    $usuario = $application->modelsManager->executeQuery($phql, array(
        'name' => $login->name,
        'pass' => $login->pass
    ))->getFirst();

    //creamos una respues
    $response = new Phalcon\Http\Response();

    //si el usuario no existe
    if($usuario == false){
        $response->setJsonContent(array('status' => 'NOT-FOUND'));
    }
    else{
        $response->setJsonContent(array('status' => 'OK-FOUND'));
    }
    return $response;
});


//añadimos un nuevo usuario
$application->post('/api/usuarios', function() use ($application) 
{
    //obtenemos el json que se ha enviado 
    $usuario = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "INSERT INTO Usuario (nombre, password, entidad, rol, estado) VALUES (:nombre:, :password:, :entidad:, :rol:, :estado:)";
 
    $status = $application->modelsManager->executeQuery($phql, array(
        'nombre' => $usuario->nombre,
	    'password' => $usuario->password,
	    'entidad' => $usuario->entidad,
	    'rol' => $usuario->rol,
	    'estado' => $usuario->estado
    ));
 
    //creamos una respuesta
    $response = new Phalcon\Http\Response();
 
    //comprobamos si el insert se ha llevado a cabo
    if ($status->success() == true) 
    {
        $usuario->id = $status->getModel()->id;
        $response->setJsonContent(array('status' => 'OK', 'data' => $usuario));
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


//actualizamos un usuario por su id
$application->put('/api/usuarios/{id:[0-9]+}', function($id) use($application) 
{
    //obtenemos el json que se ha enviado 
    $usuario = $application->request->getJsonRawBody();
 
    //creamos la consulta con phql
    $phql = "UPDATE Usuario SET nombre = :nombre:, password = :password:, entidad = :entidad:, rol = :rol:, estado = :estado: WHERE id = :id:";
    $status = $application->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'nombre' => $usuario->nombre,
	    'password' => $usuario->password,
	    'entidad' => $usuario->entidad,
	    'rol' => $usuario->rol,
	    'estado' => $usuario->estado        
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


//eliminamos un usuario por su id
$application->delete('/api/usuarios/{id:[0-9]+}', function($id) use ($application) 
{
    //creamos la consulta con phql
    $phql = "DELETE FROM Usuario WHERE id = :id:";
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
