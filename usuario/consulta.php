<?php
/*****************************************************************************************
 ****************************************************************************************
	
	* @Proyect_type: API 

	* @Document:  Método para el control de [ CONSULTAR ] todos los registros de datos Usuario
	* @Method: [ GET ]
	
****************************************************************************************
*****************************************************************************************/

	header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
	header("Content-Type: application/json; charset=UTF-8");

	include_once '../config/Database.php';
	include_once '../object/Usuario.php';

	$database = new Database();
	$db = $database->getConnection();
	
	$usuarios = new Usuario($db);

	$stmt = $usuarios->consultarTodosUsuarios();
	
	$num = $stmt->rowCount();

	if($num>0) {
		$usuarios_arr = array();
		$usuarios_arr["Datos"]=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$xemc=array(
				  "id_usuario" =>$id_usuario
				, "nombre" =>$nombre
				, "edad" =>$edad
				, "direccion" =>$direccion
				, "correo" =>$correo
				, "paswd" =>$paswd
				
			);
			array_push($usuarios_arr["Datos"], $xemc);
		}
		http_response_code(200);
		echo json_encode($usuarios_arr);
	} else {
		http_response_code(404);
		echo json_encode(array("Error" => "No se encontraron resultados"));
	}
