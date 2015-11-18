<?php

	/**
	* Instrucciones REST para Roles
	*/

	/**
	* Obtener todos los roles
	*/
	$app->get('/api/tipos', function() use ($app) 
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
	* Obtener listado de tipos
	*/
	$app->post('/api/tipos/getlist', function() use ($app)
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
			$tipo = new Tipo();
			$arrayTipos = $tipo->getListado();

			//Guardamos en Log

			//Devolvemos mesage correcto
			$status = 'OK';
			$message = 'Listado de tipo.';				

			//Montamos los datos de envio
			$dato = $datoenvio->enviarDatos($sesion, $arrayTipos);
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
	* Obtener datos tipo
	*/
	$app->post('/api/tipos/getDataTipo', function() use ($app)
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
			$tipo = new Tipo();
			if($tipo->existeId($id) == true)
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
				//Obtenemos el tipo
				$tipo->putId($id);
				$tipo->obtenerValores();

				$datoTipo['id'] = $tipo->getId();
				$datoTipo['nombre'] = $tipo->getNombre();

				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Datos de tipo.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $datoTipo);
			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Tipo inexistente.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $tipo);
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
	* Añadir nuevo tipo
	*/
	$app->post('/api/tipos/addtipo', function() use ($app)
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
		$t = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if($sesion->checkearEstado() == true)
		{

			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			$tipo = new Tipo();
			if($tipo->existeNombre($t['nombre']) != true)
			{
				$tipo->generarNuevo($t['nombre']);
				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Tipo creado.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $tipo);

			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Tipo ya existe.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $tipo);
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
			$dato = $datoenvio->enviarDatos($sesion, $t);
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
	* Actualizar tipo
	*/
	$app->post('/api/tipos/updtipo', function() use ($app)
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
		$t = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if($sesion->checkearEstado() == true)
		{

			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			$tipo = new Tipo();
			if($tipo->existeId($t['id']) == true)
			{
				$tipo->putTipo($t['id'], $t['nombre']);

				$tipo->actualizarTipo($t['id'], $t['nombre']);
				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Tipo actualizado.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $tipo);

			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Tipo no existe.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $tipo);
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
			$dato = $datoenvio->enviarDatos($sesion, $t);
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
	* Borrar tipo
	*/
	$app->post('/api/tipos/deltipo', function() use ($app)
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
		$t = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if($sesion->checkearEstado() == true)
		{

			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			$tipo = new Tipo();
			if($tipo->existeId($t['id']) == true)
			{
				$tipo->putTipo($t['id'], $t['nombre']);

				$tipo->borrarTipo($t['id'], $t['nombre']);
				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Tipo borrado.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $tipo);

			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Tipo no existe.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $tipo);
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
			$dato = $datoenvio->enviarDatos($sesion, $t);
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
