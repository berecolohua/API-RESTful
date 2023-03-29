<?php
/*****************************************************************************************
 ****************************************************************************************
	

	* @Document:  Método para  [ ELIMINAR ] el registro por identificar 
	* @Method: [ DELETE ]
	
****************************************************************************************
*****************************************************************************************/

	// Required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: DELETE ");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/Database.php';
	include_once '../object/Usuario.php';
	$database = new Database();
	$db = $database->getConnection();
	$delete = new Usuario($db);
	
	$delete->id_usuario =isset($_GET['id_usuario']) ? $_GET['id_usuario'] : die();
	$delete->consultarPorUsuarios();

	if ( $delete->id_usuario!=null ) {
		if($delete->eliminarUsuarios()) {
			http_response_code(200);
			echo json_encode(array("message" => "Se eliminó Usuario Turista :(  "));
		} else {
			http_response_code(503);
			echo json_encode(array("status" => "No se eliminó Usuario Turista"));
		}
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No se encontró el Usuari Turista con dicho Identificador"));		
	}
?>




