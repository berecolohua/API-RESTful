<?php
/*****************************************************************************************
 ****************************************************************************************
	 

	* @Document:  Método para el control de [ CONSULTAR ] todos los registros de la tabla Administrador 
	* @Method: [ GET ]
	
****************************************************************************************
*****************************************************************************************/

	header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
	header("Content-Type: application/json; charset=UTF-8");
	include_once '../config/Database.php';
	include_once '../object/Administrador.php';

	$database = new Database();
	$db = $database->getConnection();
	
	$admin = new Administrador($db);
	$stmt = $admin->consultarTodosAdministradores();
	
	$num = $stmt->rowCount();

	if($num>0) {
		$admin_arr = array();
		$admin_arr["Datos"]=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$xemc=array(
				  "id_admin" =>$id_admin
				, "nombre"   =>$nombre
				, "password" =>$password
				
				
			);
			array_push($admin_arr["Datos"], $xemc);
		}
		http_response_code(200);
		echo json_encode($admin_arr);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No se encontraron resultados"));
	}
