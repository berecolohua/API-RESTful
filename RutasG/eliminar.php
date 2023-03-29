<?php
/*****************************************************************************************
 
 Método para  [ ELIMINAR ] el registro por identificar 
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
	include_once '../object/RutasG.php';
	$database = new Database();
	$db = $database->getConnection();
	$delete = new RutasG($db);
    $delete->id_galeria = isset($_GET['id_galeria']) ? $_GET['id_galeria'] : die();
	$delete->consultarPorRutasG();

	if ( $delete->id_galeria!=null ) {
		if($delete->eliminarRutasG()) {
			http_response_code(200);
			echo json_encode(array("message" => "La Ruta Galeria se eliminó correctamente"));
		} else {
			http_response_code(404);
			echo json_encode(array("status" => "No se eliminó el registro, intenta nuevamente"));
		}
	} else {
		http_response_code(503);
		echo json_encode(array("Error" => "No se encontró el registro con dicho Identificador"));		
	}
?>




