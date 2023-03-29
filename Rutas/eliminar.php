<?php
/*****************************************************************************************
 ****************************************************************************************

	* @Document:  Método para  [ ELIMINAR ] el registro por identificador 
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
	include_once '../object/Rutas.php';
	$database = new Database();
	$db = $database->getConnection();
	$delete = new Rutas($db);
    $delete->id_ruta=isset($_GET['id_ruta']) ? $_GET['id_ruta'] : die();
	/*$db($request-> id_ruta);*/
	$delete->consultaPorRutaturistica();



	if ( $delete->id_ruta!=null ) {
		if($delete->eliminarRutaturistica()) {
			http_response_code(200);
			echo json_encode(array("message" => "La ruta se eliminó correctamente"));
		} else {
			http_response_code(404);
			echo json_encode(array("status" => "No se eliminó la ruta, intenta nuevamente"));
		}
	} else {
		http_response_code(503);
		echo json_encode(array("Error" => "No se encontró el registro con dicho Identificador"));		
	}

/**http://localhost/API_RUTAS/Rutas/eliminar.php?id_ruta=4
*/
?>
	






