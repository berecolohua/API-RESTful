<?php
/*****************************************************************************************
 ****************************************************************************************

	* @Document:  Método para  [ ELIMINAR ] el registro por identificardor 
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
	include_once '../object/Servicios.php';
	$database = new Database();
	$db = $database->getConnection();
	$delete = new Servicios($db);
	$delete->id_servicio=isset($_GET['id_servicio']) ? $_GET['id_servicio'] : die();
	$delete->consultarPorServicio();
 if ( $delete->id_servicio!=null ) {
		if($delete->eliminarServicio()) {
			http_response_code(200);
			echo json_encode(array("message" => "El servicio se eliminó correctamente"));
		} else {
			http_response_code(404);
			echo json_encode(array("status" => "No se eliminó el registro, intenta nuevamente"));
		}
	} else {
		http_response_code(503);
		echo json_encode(array("Error" => "No se encontró el registro con dicho Identificador"));		
	}
?>




