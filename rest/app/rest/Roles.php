<?php

	/**
	* Instrucciones REST para Roles
	*/

	/**
	* Obtener todos los roles
	*/
	$app->get('/api/roles', function() use ($app) 
	{
/*		//Creamos la consulta con phpl
		$phpl = "SELECT * FROM Usuarios ORDER BY idusuarios";
		$usuarios = $app->modelsManager->executeQuery($phpl);

		//Recuperamos resultado
*/		$data = array();
/*		foreach($usuarios as $usuario)
		{
			$data[] = array('id' => $usuario->idusuarios,
							'user' => $usuario->emaill,
							'pass' => $usuario->pass,
							'active' => $usuario->active);
		}
*/
		//Codificamos en JSON
		echo json_encode($data);

	});


	/**
	* Obtener listado de usuarios
	*/
	$app->post('/api/roles/getlist', function() use ($app)
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
			//Obtenemos listado de usuarios
			$rol = new Rol();
			$arrayRoles = $rol->getListado();

			//Guardamos en Log

			//Devolvemos mesage correcto
			$status = 'OK';
			$message = 'Listado de usuario.';				

			//Montamos los datos de envio
			$dato = $datoenvio->enviarDatos($sesion, $arrayRoles);
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
	* Obtener datos rol
	*/
	$app->post('/api/roles/getDataRol', function() use ($app)
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
		$id = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if($sesion->checkearEstado() == true)
		{
			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			$rol = new Rol();
			if($rol->existeId($id) == true)
			{
				//Si es correcta
/*				//Obtenemos listado de usuarios
				$usuario->putEmail($email);
				$usuario->obtenerValores();
				//$datoUsuario['usuario'] = $usuario;
				$datoUsuario['email'] = $usuario->getEmail();
				$datoUsuario['pass'] = $usuario->getPass();
				$datoUsuario['rol'] = $usuario->getRol();
				$datoUsuario['active'] = $usuario->getActive();
				$datoUsuario['asignado'] = 'I';//xxxxx
*/
				//Obtenemos el rol
				$rol->putId($id);
				$rol->obtenerValores();

				$datoRol['id'] = $rol->getId();
				$datoRol['nombre'] = $rol->getNombre();

				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Datos de rol.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $datoRol);
			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Rol inexistente.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $email);
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
			$dato = $datoenvio->enviarDatos($sesion, $email);
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
	* Añadir nuevo usuario
	*/
	$app->post('/api/roles/addrol', function() use ($app)
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
		$r = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if($sesion->checkearEstado() == true)
		{

			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			$rol = new Rol();
			if($rol->existenombre($r['nombre']) != true)
			{
				$rol->generarNuevo($r['nombre']);
				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Rol creado.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $rol);

			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Rol ya existe.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $rol);
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
			$dato = $datoenvio->enviarDatos($sesion, $email);
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
	* Añadir nuevo usuario
	*/
	$app->post('/api/roles/updrol', function() use ($app)
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
		$rol = $datoenvio->getDato();
////////////////////////////////////////

		//Enviamos el JSON
		return $json;

	});


	/**
	* Añadir nuevo usuario
	*/
	$app->post('/api/roles/delrol', function() use ($app)
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
		$rol = $datoenvio->getDato();
////////////////////////////////////////

		//Enviamos el JSON
		return $json;

	});
