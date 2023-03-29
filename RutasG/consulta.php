<?php
/*****************************************************************************************
 ****************************************************************************************
*Método para el control de [ CONSULTAR ] todos los registros de datos Manuales
	* @Method: [ GET ]
	
****************************************************************************************
*****************************************************************************************/

	header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
	
	header("Content-Type: application/json; charset=UTF-8");

	include_once '../config/Database.php';
	include_once '../object/RutasG.php';

	$database = new Database();
	$db = $database->getConnection();
	
	$RutasG = new RutasG($db);
	$stmt = $RutasG->consultarTodosRutasG();
	
	$num = $stmt->rowCount();

	if($num>0) {
		$RutasG_arr = array();
		$RutasG_arr["Datos"]=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$xemc=array(
				  "id_galeria" =>$id_galeria
				, "galeria"  =>$galeria=base64_encode($row['galeria'])
				, "des_galeria" =>$des_galeria
				, "ext_archivo" =>$ext_archivo
				, "id_ruta"     =>$id_ruta
				
				
			);
			array_push($RutasG_arr["Datos"], $xemc);
		}
		http_response_code(200);
		echo json_encode($RutasG_arr);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No se encontraron resultados"));
	}
