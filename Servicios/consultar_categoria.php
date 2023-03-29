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
	$consulta_categoria = new Servicios($db);
	$consulta_categoria->categoria = isset($_GET['categoria']) ? $_GET['categoria'] : die();
	$datos = $consulta_categoria->consultarPorServicio_cat();
	$num = $datos->rowCount();

	if($num>0) {
		$service_arr = array();
		$service_arr["Datos"]=array();
		while ($row = $datos->fetch(PDO::FETCH_ASSOC)) {
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
		echo json_encode(array("Error" => "El Servicio con el identificador no existe :( "));
	}
?>
