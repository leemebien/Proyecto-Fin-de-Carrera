<?php

	/**
	* Instrucciones REST para Sesiones
	*/

	/**
	* Obtener todas las sesiones
	*/
	$app->get('/api/sesiones', function() use ($app)
		{
			//Creamos la consulta con phpl
			$phpl = "SELECT * FROM Sesiones ORDER BY idsesiones";
			$sesiones = $app->modelsManager->executeQuery($phpl);

			//Recuperamos resultados
			$data = array();
			foreach($sesiones as $sesion)
			{
				$data[] = array('id' => $sesion->idsesiones,
								'user' => $sesion->usuario,
								'fechainicio' => $sesion->fechainicio,
								'fechasalida' => $sesion->fechasalida,
								'fechacaducidad' => $sesion->fechacaducidad);
			}

			//Codificamos en JSON
			echo json_encode($data);
		});

	/**
	* Actualiza sesion
	*/
	$app->post('/api/sesiones/actualizarSesion', function() use ($app)
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
					//Guarda la sesion 
					$sesion->generarNueva($usuario);

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
				$sesion->putFechaActual(date('Y/m/d_H:i:s'));
				$sesion->putFechaCaducidad(date('Y/m/d_H:i:s'));

				//Cerramos sesion 
				$sesion->cerrarSesion();

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
	

