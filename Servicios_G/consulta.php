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
	include_once '../object/Servicios_Galeria.php';

	$database = new Database();
	$db = $database->getConnection();
	
	$ServiciosG = new Servicios_Galeria($db);
	$stmt = $ServiciosG->consultarTodosServicios_Galeria();
	
	$num = $stmt->rowCount();

	if($num>0) {
		$ServiciosG_arr = array();
		$ServiciosG_arr["Datos"]=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$xemc=array(
				  "id_galeria"  =>$id_galeria
				, "foto"        =>$foto=base64_encode($row['foto'])
				, "des_foto" =>$des_foto
				, "ext_archivo" =>$ext_archivo
				, "id_servicio" =>$id_servicio
				
				
			);
			array_push($ServiciosG_arr["Datos"], $xemc);
		}
		http_response_code(200);
		echo json_encode($ServiciosG_arr);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No se encontraron resultados"));
	}
