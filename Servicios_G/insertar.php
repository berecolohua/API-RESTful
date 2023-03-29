<?php
/*****************************************************************************************
 ****************************************************************************************
	

	* @Document:  Método para  [ ELIMINAR ] el registro por identificar 
	* @Method: [ POST ]
	
****************************************************************************************
*****************************************************************************************/

	// Required headers
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");

	header("Access-Control-Allow-Methods: post");
	header("Access-Control-Allow-Credentials: true");
	header('Content-Type: application/json');
	
	include_once '../config/Database.php';
	include_once '../object/Servicios_Galeria.php';

	$database = new Database();
	$db = $database->getConnection();
    $crt = new Servicios_Galeria($db);
    $data = json_decode(file_get_contents("php://input"));

	if( !empty($data->foto) ) {
	    $crt-> foto= $data->foto;
	    $crt->des_foto = $data->des_foto;
	    $crt->ext_archivo = $data->ext_archivo;
	    $crt->id_servicio = $data->id_servicio;
	    
	    
   		if ($crt->crearServicios_Galeria()) {
			http_response_code(201);
			echo json_encode(array("message" => "Se registró un nuevo Servicio Galeria"));
		} else {
			http_response_code(404);
			echo json_encode(array("status" => "No se regitro, verifica los datos"));
		}

	} else {
		http_response_code(503);
		echo json_encode(array("error" => "Incapaz de crear el registro. Los datos están incompletos."));
	}


/*
{
      "nombre": "Ruta"
    , "descripcion": "larga"
    , "coord_lat": "lat"
    , "coord_long": "log"
    , "horarios": "matutinos"
    , "correo": "correo@correo.com"
    , "direccion": "Zongolica"
    , "telefono": "1234567890"
    , "logo": "logo_chido"
    , "categoria": "Carretara"
}
*/

?>