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
	include_once '../object/Rutas.php';

	$database = new Database();
	$db = $database->getConnection();
	$consulta_id = new Rutas($db);
	$consulta_id->id_ruta = isset($_GET['id_ruta']) ? $_GET['id_ruta'] : die();
	$consulta_id->consultaPorRutaturistica();
	
	if($consulta_id->id_ruta!=null) {
		$xemc = array(
			  "id_ruta" =>$consulta_id->id_ruta
			, "nombre" =>$consulta_id->nombre
			, "descripcion" =>$consulta_id->descripcion
			, "coord_lat" =>$consulta_id->coord_lat
			, "coord_long" =>$consulta_id->coord_long
			, "rs_facebook" =>$consulta_id->rs_facebook
			, "rs_whatsapp" =>$consulta_id->rs_whatsapp
			, "rs_inst" =>$consulta_id->rs_inst
			, "thumbnail" =>$consulta_id->thumbnail
			//, "fotografia" =>$consulta_id->fotografia
			, "des_foto" =>$consulta_id->des_foto
		);

		http_response_code(200);
		echo json_encode($xemc);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No existe registro de los datos solicitados"));
	}

	/**http://localhost/API_RUTAS/Rutas/consultar_id.php?id_ruta=7 */
?>

