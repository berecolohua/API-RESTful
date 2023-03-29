<?php
/*****************************************************************************************
 ****************************************************************************************
	* @Document:  Método para  [ REGISTRAR ] 
	* @Method: [ POST ]
	
****************************************************************************************
*****************************************************************************************/

	// Required headers
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: post");
	header("Access-Control-Allow-Credentials: true");
	header('Content-Type: application/json');
	
	include_once '../config/Database.php';
	include_once '../object/Administrador.php';

	$database = new Database();
	$db = $database->getConnection();
	
	$crt = new Administrador($db);
    $data = json_decode(file_get_contents("php://input"));
	
	
	
	if( !empty($data->nombre) ) {
	    $crt->nombre = $data->nombre;
	    $crt->password = $data->password;
	    
	    
   		if ($crt->crearAdministrador()) {
			http_response_code(201);
			echo json_encode(array("message" => "Se registró un nuevo administrador"));
		} else {
			http_response_code(404);
			echo json_encode(array("status" => "No se regitro, verifica los datos"));
		}

	} else {
		http_response_code(503);
		echo json_encode(array("error" => "Incapaz de crear el registro. Los datos están incompletos."));
	}


/*
{
      "nombre": ""
    , "paswd": ""
    
}
*/

?>