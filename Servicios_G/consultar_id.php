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
	include_once '../object/Servicios_Galeria.php';

	$database = new Database();
	$db = $database->getConnection();
	$consulta_id = new Servicios_Galeria($db);
	$consulta_id->id_galeria = isset($_GET['id_galeria']) ? $_GET['id_galeria'] : die();
	$consulta_id->consultarPorServicios_Galeria();
	
	if($consulta_id->id_galeria!=null) {
		$xemc = array(
			  "id_galeria"  =>$consulta_id->id_galeria
			,  "foto"       =>$consulta_id->foto
			, "des_foto" =>$consulta_id->des_foto
			, "ext_archivo" =>$consulta_id->ext_archivo
			, "id_servicio"     =>$consulta_id->id_servicio
			  
	
		);

		http_response_code(200);
		echo json_encode($xemc);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No existe registro de los datos solicitados"));
	}

	
?>