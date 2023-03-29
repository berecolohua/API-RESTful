<?php


	// Required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/Database.php';
	include_once '../object/Usuario.php';
	$database = new Database();
	$db = $database->getConnection();
	$crt = new Usuario($db);
	$data = json_decode(file_get_contents("php://input"));

	if(
		
		!empty($data->nombre)
	) {

		//$crt->id_usuario = $data->id_usuario;
		$crt->nombre = $data->nombre;
		$crt->edad= $data->edad;
		$crt->direccion= $data->direccion;
		$crt->correo = $data->correo;
		$crt->paswd = $data->paswd;
		

		if ($crt->crearNuevoUsuario()) {
			http_response_code(201);
			echo json_encode(array("Message" => "Se registró un nuevo Usuario Turista ;) "));
		} else {
			http_response_code(503);
			echo json_encode(array("Status" => "No se registraron los nuevos datos de Usuario Turista :( "));
		}
	} else {
		http_response_code(400);
		echo json_encode(array("Error" => "Incapaz de crear el registro Usuario Turista. Los datos están incompletos. :( "));
	}

?>