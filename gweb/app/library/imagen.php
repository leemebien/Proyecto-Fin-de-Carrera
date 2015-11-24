<?php

	$imagen = $_GET['imagen'];
	$tipo = $_GET['tipo_imagen'];

	header("Content-type: $tipo");

	echo $imagen;

?>