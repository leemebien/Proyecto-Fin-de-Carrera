<?php

	/**
	* Instrucciones REST para Roles
	*/

	/**
	* Obtener todos los roles
	*/
	$app->get('/api/fotos', function() use ($app) 
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
	* Obtener listado de fotos
	*/
	$app->post('/api/fotos/getlist', function() use ($app)
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
			$foto = new Foto();
			$arrayFotos = $foto->getListado();

			//Guardamos en Log

			//Devolvemos mesage correcto
			$status = 'OK';
			$message = 'Listado de foto.';				

			//Montamos los datos de envio
			$dato = $datoenvio->enviarDatos($sesion, $arrayFotos);
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
	* Obtener datos foto
	*/
	$app->post('/api/fotos/getDataFoto', function() use ($app)
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
			$foto = new Foto();
			if($foto->existeId($id) == true)
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
				//Obtenemos el foto
				$foto->putId($id);
				$foto->obtenerValores();

				$datoFoto['id'] = $foto->getId();
				$datoFoto['nombre'] = $foto->getNombre();
				$datoFoto['fotobinaria'] = $foto->getFotobinaria();
				$datoFoto['tipo'] = $foto->getTipo();

				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Datos de foto.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $datoFoto);
			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Foto inexistente.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $foto);
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
			$dato = $datoenvio->enviarDatos($sesion, $id);
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
	* Añadir nuevo foto
	*/
	$app->post('/api/fotos/addfoto', function() use ($app)
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
		$f = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if($sesion->checkearEstado() == true)
		{

			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			$foto = new Foto();
			if($foto->existeNombre($f['nombre']) != true)
			{
				$foto->generarNuevo($f['nombre'], $f['fotobinaria'], $f['tipo']);
				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Foto creado.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $foto);

			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Foto ya existe.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $foto);
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
			$dato = $datoenvio->enviarDatos($sesion, $f);
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
	* Actualizar foto
	*/
	$app->post('/api/fotos/updfoto', function() use ($app)
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
		$f = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if($sesion->checkearEstado() == true)
		{

			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			$foto = new Foto();
			if($foto->existeId($f['id']) == true)
			{
				$foto->putFoto($f['id'], $f['nombre'], $f['fotobinaria'], $f['tipo']);

				$foto->actualizarFoto($f['id'], $f['nombre'], $f['fotobinaria'], $f['tipo']);
				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Foto actualizado.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $foto);

			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Tipo no existe.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $foto);
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
			$dato = $datoenvio->enviarDatos($sesion, $f);
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
	* Borrar foto
	*/
	$app->post('/api/fotos/delfoto', function() use ($app)
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
		$f = $datoenvio->getDato();

		//Tratamos la Sesion y la informacion
		//Primero comprobamos la sesion
		if($sesion->checkearEstado() == true)
		{

			//Si es correcta tratamos la informacion
			//Comprobamos la informacion
			$foto = new Foto();
			if($foto->existeId($t['id']) == true)
			{
				$foto->putFoto($f['id'], $f['nombre'], $f['fotobinaria'], $f['tipo']);

				$foto->borrarFoto($f['id'], $f['nombre'], $f['fotobinaria'], $f['tipo']);
				//Guardamos en Log

				//Devolvemos mesage correcto
				$status = 'OK';
				$message = 'Foto borrado.';				

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $foto);

			}
			else
			{
				//Sino es correcta devolvemos mensage de usuario inexistente
				$status = 'ERROR-3';
				$message = 'Foto no existe.';

				//Montamos los datos de envio
				$dato = $datoenvio->enviarDatos($sesion, $foto);
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
			$dato = $datoenvio->enviarDatos($sesion, $f);
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
