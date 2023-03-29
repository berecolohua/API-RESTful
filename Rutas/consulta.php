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
	include_once '../object/Rutas.php';
	

	$database = new Database();
	$db = $database->getConnection();
	
	$ruta = new Rutas($db);
	$stmt = $ruta->consultarTodasRutasturisticas();
	$num = $stmt->rowCount();
	
    

	if($num>0) {
		$ruta_arr = array();
		$ruta_arr["Datos"]=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$xemc=array(
				  "id_ruta"     =>$id_ruta
				, "nombre"      =>$nombre
				, "descripcion" =>$descripcion
				, "coord_lat"   =>$coord_lat
				, "coord_long"  =>$coord_long
				, "rs_facebook" =>$rs_facebook
				, "rs_whatsapp" =>$rs_whatsapp
				, "rs_inst" 	=>$rs_inst
				, "thumbnail" 	=>$thumbnail=base64_encode($row['thumbnail'])
				//, "fotografia" 	=>$fotografia=base64_encode($row['fotografia'])
				, "des_foto" 	=>$des_foto
				
			);
			array_push($ruta_arr["Datos"], $xemc);
		}
		http_response_code(200);
		echo json_encode($ruta_arr);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No se encontraron resultados"));
	}

	/**
	 * http://localhost/API_RUTAS/Rutas/consulta.php
	 */