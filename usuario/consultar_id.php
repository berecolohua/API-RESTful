<?php
	// Required headers
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Allow-Credentials: true");
	header('Content-Type: application/json');

/*****************************************************************************************
 ****************************************************************************************
	

	* @Document:  Método para el control de [ CONSULTAR POR IDENTIFICARO DE USUARIO] 
	* @Method: [ GET ]
	
****************************************************************************************
*****************************************************************************************/


	include_once '../config/Database.php';
	include_once '../object/Usuario.php';
	
	$database = new Database();
	$db = $database->getConnection();
	$consulta_id = new Usuario($db);
	$consulta_id->id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : die();
	$consulta_id->consultarPorUsuarios();

	if($consulta_id->id_usuario!=null) {
		$xemc = array(
			  "id_usuario" =>$consulta_id->id_usuario
			, "nombre" =>$consulta_id->nombre
			, "edad" =>$consulta_id->edad
			, "direccion" =>$consulta_id->direccion
			, "correo" =>$consulta_id->correo
			, "paswd" =>$consulta_id->paswd
			
		);
		http_response_code(200);
		echo json_encode($xemc);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No existe registro de los datos solicitados"));
	}
?>
