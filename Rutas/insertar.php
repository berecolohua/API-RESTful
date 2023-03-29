<?php
/*****************************************************************************************
 ****************************************************************************************

	* @Document:  Método para  [ REGISTRAR ]  
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
	include_once '../object/Rutas.php';

	$database = new Database();
	$db = $database->getConnection();
	
	$crt = new Rutas($db);
    $data = json_decode(file_get_contents("php://input"));

	if( !empty($data->nombre) ) {
	    $crt->nombre = $data->nombre;
	    $crt->descripcion = $data->descripcion;
	    $crt->coord_lat = $data->coord_lat;
	    $crt->coord_long = $data->coord_long;
	    $crt->rs_facebook = $data->rs_facebook;
	    $crt->rs_whatsapp = $data->rs_whatsapp;
	    $crt->rs_inst = $data->rs_inst;
	    $crt->thumbnail = $data->thumbnail;
	   // $crt->fotografia = $data->fotografia;
	    $crt->des_foto = $data->des_foto;
	    
   		if ($crt->crearRutaturistica()) {
			http_response_code(201);
			echo json_encode(array("message" => "Se registró una nueva Ruta Turistica"));
		} else {
			http_response_code(404);
			echo json_encode(array("status" => "No se registro, verifica los datos"));
		}

	} else {
		http_response_code(503);
		echo json_encode(array("error" => "Incapaz de crear el registro. Los datos están incompletos."));
	}



/*
http://localhost/API_RUTAS/Rutas/insertar.php


{
            "id_ruta": "6",
            "nombre": "Atlahutzia",
            "descripcion": "",
            "coord_lat": "",
            "coord_long": "",
            "rs_facebook": "",
            "rs_whatsapp": "",
            "rs_inst": "",
            "thumbnail": "",
            "fotografia": "",
            "des_foto": ""
        }





*/

?>