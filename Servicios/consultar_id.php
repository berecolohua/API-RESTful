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
	include_once '../object/Servicios.php';
	
	$database = new Database();
	$db = $database->getConnection();
	$consulta_id = new Servicios($db);
	$consulta_id->id_servicio = isset($_GET['id_servicio']) ? $_GET['id_servicio'] : die();
	$consulta_id->consultarPorServicio();

	if($consulta_id->id_servicio!=null) {
		$xemc = array(
			      "id_servicio" =>$consulta_id->id_servicio
				, "nombre"      =>$consulta_id->nombre
				, "descripcion" =>$consulta_id->descripcion
				, "coord_lat"   =>$consulta_id->coord_lat
				, "coord_long"  =>$consulta_id->coord_long
				, "horarios"    =>$consulta_id->horarios
				, "correo" 		=>$consulta_id->correo
				, "direccion" 	=>$consulta_id->direccion
				, "telefono" 	=>$consulta_id->telefono
				, "rs_facebook" =>$consulta_id->rs_facebook
				, "rs_whatsapp" =>$consulta_id->rs_whatsapp
				, "rs_inst"     =>$consulta_id->rs_inst
				, "rs_pweb"     =>$consulta_id->rs_pweb
				, "logo" 		=>$consulta_id->logo
				, "categoria" 	=>$consulta_id->categoria
		);
		http_response_code(200);
		echo json_encode($xemc);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "El Servicio con el identificador no existe :( "));
	}
?>
