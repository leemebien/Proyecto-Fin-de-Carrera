<?php

	/**
	* Instrucciones REST para Alumnos
	*/

	/**
	* Obtener todos los usuarios
	*/
	$app->get('/api/alumnos', function() use ($app) 
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





