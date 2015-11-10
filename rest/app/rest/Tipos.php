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
	* Obtener listado de usuarios
	*/
	$app->post('/api/tipos/getlist', function() use ($app)
	{
		return "CRISTINA y SAMUEL";
	/*
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
	*/});
