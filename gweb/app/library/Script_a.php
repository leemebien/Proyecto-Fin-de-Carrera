<?php


//Fichero para ejetutar el ajax

//Directorio raiz de la app
//sera utilizado en caso de requirir alguna libreria
$root = '../';

//verificamos si existen las variables $_POST
if(isset($_POST) && !empty($_POST))
{
	//array de respuesta y regreso en JSON
	$resultado = array(
			'success'  => false,
			'message' => 'No fue posible ejecutar la peticion.',
			'datos'   => 'samu'
		);

	//incluimos las funciones
	include('Script_f.php');

	if(isset($_POST['action']))
	{

	}
	else
	{
		$resultado['message'] = 'Variable Action no declarada.';
	}

	echo json_encode($resultado);
	
}
else
{
	echo "No se puede ejecutar este script.";
}

exit();

?>