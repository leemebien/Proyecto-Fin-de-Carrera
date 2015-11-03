<?php

	/**
	* Instrucciones REST para Usuarios
	*/

	/**
	* Obtener todos los usuarios
	*/
	$app->get('/api/usuarios', function() use ($app) 
	{
		//Creamos la consulta con phpl
		$phpl = "SELECT * FROM Usuarios ORDER BY idusuarios";
		$usuarios = $app->modelsManager->executeQuery($phpl);

		//Recuperamos resultado
		$data = array();
		foreach($usuarios as $usuario)
		{
			$data[] = array('id' => $usuario->idusuarios,
							'user' => $usuario->emaill,
							'pass' => $usuario->pass,
							'active' => $usuario->active);
		}

		//Codificamos en JSON
		echo json_encode($data);
	});

	
	/**
	* Busca usuario y confirma existencia
	*/
/*	$app->post('/api/usuarios/login', function() use ($app)
	{
		//Obtenemos el JSON que se ha enviado
	    $data = $app->request->getJsonRawBody();

	    //creamos la consulta con phql
	    $phql = "SELECT * FROM Usuarios WHERE emaill LIKE :user: AND pass LIKE :pass: ORDER BY idusuarios";
	    $usuario = $app->modelsManager->executeQuery($phql, array(
														        'user' => $data->login->user,
														        'pass' => $data->login->pass
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
*/

	/**
	* Buscar usuario, confirmar existencia y loguear
	*/
	$app->post('/api/usuarios/login2', function() use ($app)
	{
		//Obtenemos el JSON que se ha enviado
		$data = $app->request->getJsonRawBody();

		//Desmontamos el JSON
		$dato = $data->dato;

		//Desmontamos los datos de envio
		$datoenvio = new Datoenvio();
		$datoenvio->obtenerDatos($dato);

		//Obtenemos la Sesion y la informacion
		$sesion = $datoenvio->getSesion();
		$usuario = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if(($sesion->esInvitado() == true) || ($sesion->checkearEstado() == true))
		{
			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			if($usuario->existe() == true)
			{
				//Si es correcta
				//Obtenemos los valores del usuario
				$usuario->obtenerValores();

				//Generamos una sesion nueva
				$sesion->generarNueva($usuario);

				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Usuario logueado.';				
			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario incorrecto
				$status = 'ERROR-2';
				$message = 'Usuario incorrecto.';
			}
		}
		else
		{
			//Sino es correcta devolvemos mensage de sesion caducada
			$status = 'ERROR-1';
			$message = 'Sesion caducada.';
		}


		//Montamos los datos de envio
		$dato = $datoenvio->enviarDatos($sesion, $usuario);

		//Montamos el JSON
        $data = array('dato' => $dato
                        ,'status' => $status
                        ,'message' => $message);

		//Codificamos el JSON
		$json = json_encode($data);

		//Enviamos el JSON
		return $json;
	});

	
	/**
	* Buscar usuario
	*/



	/**
	* Registramos el usuario nuevo
	*/
	$app->post('/api/usuarios/registrar', function() use ($app)
	{
		//Obtenemos el JSON que se ha enviado
		$data = $app->request->getJsonRawBody();

		//Desmontamos el JSON
		$dato = $data->dato;

		//Desmontamos los datos de envio
		$datoenvio = new Datoenvio();
		$datoenvio->obtenerDatos($dato);

		//Obtenemos la Sesion y la informacion
		$sesion = $datoenvio->getSesion();
		$usuario = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if(($sesion->esInvitado() == true) || ($sesion->checkearEstado() == true))
		{
			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			if($usuario->existe2() == false)
			{
				//Si es correcta
				//creamos usuario
				$usuario->generarNuevo($usuario->getEmail(), $usuario->getPass(), $usuario->getRol(), $usuario->getActive());

				//Generamos una sesion nueva
				$sesion->generarNueva($usuario);
//return $datoenvio->getSesion()->getNumeroSesion() . ' |-| ';

				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Usuario creado.';				
			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario existente
				$status = 'ERROR-3';
				$message = 'Usuario existente.';
			}
		}
		else
		{
			//Sino es correcta devolvemos mensage de sesion caducada
			$status = 'ERROR-1';
			$message = 'Sesion caducada.';
		}

		//Montamos los datos de envio
		$dato = $datoenvio->enviarDatos($sesion, $usuario);

		//Montamos el JSON
        $data = array('dato' => $dato
                        ,'status' => $status
                        ,'message' => $message);

		//Codificamos el JSON
		$json = json_encode($data);

		//Enviamos el JSON
		return $json;
	});


	/**
	* Desconectar usuario
	*/
	$app->post('/api/usuarios/logout', function() use ($app)
	{
		//Obtenemos el JSON que se ha enviado
		$data = $app->request->getJsonRawBody();

		//Desmontamos el JSON
		$dato = $data->dato;

		//Desmontamos los datos de envio
		$datoenvio = new Datoenvio();
		$datoenvio->obtenerDatos($dato);

		//Obtenemos la Sesion y la informacion
		$sesion = $datoenvio->getSesion();
		$usuario = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if($sesion->checkearEstado() == true)
		{
			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			if($usuario->existe2() == true)
			{
				//Si es correcta
				//Cerramos sesion 
				$sesion->cerrarSesion();

				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Usuario deslogueado.';				
			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Usuario inexistente.';
			}
		}
		else
		{
			//Sino es correcta devolvemos mensage de sesion caducada pero cerramos sesion
			//Cerramos sesion 
			$sesion->cerrarSesion();

			$status = 'OK';
			$message = 'Sesion caducada.';
		}

		//Montamos los datos de envio
		$dato = $datoenvio->enviarDatos($sesion, $usuario);

		//Montamos el JSON
        $data = array('dato' => $dato
                        ,'status' => $status
                        ,'message' => $message);

		//Codificamos el JSON
		$json = json_encode($data);

		//Enviamos el JSON
		return $json;
	});


	/**
	* Obtener listado de usuarios
	*/
	$app->post('/api/usuarios/getlist', function() use ($app)
	{
		//Obtenemos el JSON que se ha enviado
		$data = $app->request->getJsonRawBody();

		//Desmontamos el JSON
		$dato = $data->dato;

		//Desmontamos los datos de envio
		$datoenvio = new Datoenvio();
		$datoenvio->obtenerDatos($dato);

		//Obtenemos la Sesion y la informacion
		$sesion = $datoenvio->getSesion();
		$usuario = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if($sesion->checkearEstado() == true)
		{
			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			if($usuario->existe2() == true)
			{
				//Si es correcta
				//Obtenemos listado de usuarios
				$arrayUsuario = $usuario->getListado();				

				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Listado de usuario.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $arrayUsuario);
			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Usuario inexistente.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $usuario);
			}
		}
		else
		{
			//Sino es correcta devolvemos mensage de sesion caducada pero cerramos sesion
			//Cerramos sesion 
			$sesion->cerrarSesion();

			$status = 'ERROR-1';
			$message = 'Sesion caducada.';

			//Montamos los datos de envio
			$dato = $datoenvio->enviarDatos($sesion, $usuario);
		}


		//Montamos el JSON
        $data = array('dato' => $dato
                        ,'status' => $status
                        ,'message' => $message);

		//Codificamos el JSON
		$json = json_encode($data);

		//Enviamos el JSON
		return $json;
	});








	/**
	* Buscar usuario y confirmar existencia con Encrptacion
	*/
/*	$app->get('/api/usuarios/login3', function() use ($app)
	{

		$user = 'Samuel';
		//$pass = hash('Cristina');
		$pass = 'Cristina';

		$sesion = new Sesion();

		$sesion->putSesion(1, $user, $pass, 0, date('Y/m/d_H:i:s'), date('Y/m/d_H:i:s'), date('Y/m/d_H:i:s',mktime(date('H'), date('i') + 10, 0, date('m'), date('d'), date('Y'))));

		//Montamos los datos de Envio
		$datoenvio = new Datoenvio();
		$dato = $datoenvio->enviarDatos($sesion, 'Samuel y Cristina');

		//Montamos el JSON
		$data[] = array('dato' => $dato);

		//Codificamos en JSON
		return json_encode($data);
	});
*/
