<?php
/*****************************************************************************************
 **************************************************************************************** 

	* @Document:  Método para el control de [ CONSULTAR POR IDENTIFICADOR] 
	* @Method: [ GET ]
	
****************************************************************************************
*****************************************************************************************/

	// Required headers
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Allow-Credentials: true");
	header('Content-Type: application/json');

	include_once '../config/Database.php';
	include_once '../object/Administrador.php';

	$database = new Database();
	$db = $database->getConnection();
	$consulta_id = new Administrador($db);
	$consulta_id->id_admin = isset($_GET['id_admin']) ? $_GET['id_admin'] : die();
	$consulta_id->consultaPorAdministrador();
	
	if($consulta_id->id_admin!=null) {
		$xemc = array(
			  "id_admin" =>$consulta_id->id_admin
			, "nombre"   =>$consulta_id->nombre
			, "password"    =>$consulta_id->password
	
		);

		http_response_code(200);
		echo json_encode($xemc);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No existe registro de los datos solicitados"));
	}

	
?>



