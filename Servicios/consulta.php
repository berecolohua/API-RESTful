<?php
/*****************************************************************************************
 ****************************************************************************************

	* Método para el control de [ CONSULTAR ] 
	* @Method: [ GET ]
	
****************************************************************************************
*****************************************************************************************/

	header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
	header("Content-Type: application/json; charset=UTF-8");

	include_once '../config/Database.php';
	include_once '../object/Servicios.php';

	$database = new Database();
	$db = $database->getConnection();
	
	$serv = new Servicios($db);
	$stmt = $serv->consultarTodosServicios();

	$num = $stmt->rowCount();

	if($num>0) {
		$service_arr = array();
		$service_arr["Datos"]=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$xemc=array(
				  "id_servicio" =>$id_servicio
				, "nombre"      =>$nombre
				, "descripcion" =>$descripcion
				, "coord_lat"   =>$coord_lat
				, "coord_long"  =>$coord_long
				, "horarios"    =>$horarios
				, "correo" 		=>$correo
				, "direccion" 	=>$direccion
				, "telefono" 	=>$telefono
				, "rs_facebook" =>$rs_facebook
				, "rs_whatsapp" =>$rs_whatsapp
				, "rs_inst" 	=>$rs_inst
				, "rs_pweb" 	=>$rs_pweb
				, "logo" 		=>$logo =base64_encode($row['logo'])
				, "categoria" 	=>$categoria
				
			);
			array_push($service_arr["Datos"], $xemc, );
		}
		http_response_code(200);
		echo json_encode($service_arr);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No se encontraron resultados del Servicio :("));
	}
