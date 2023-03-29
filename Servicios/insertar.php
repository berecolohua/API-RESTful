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
	include_once '../object/Servicios.php';

	$database = new Database();
	$db = $database->getConnection();
	
	$crt = new Servicios($db);
    $data = json_decode(file_get_contents("php://input"));
    

	if( !empty($data->nombre) ) {
	    $crt->nombre = $data->nombre;
	    $crt->descripcion = $data->descripcion;
	    $crt->coord_lat = $data->coord_lat;
	    $crt->coord_long = $data->coord_long;
	    $crt->horarios = $data->horarios;
	    $crt->correo = $data->correo;
	    $crt->direccion = $data->direccion;   
	    $crt->telefono = $data->telefono;
		$crt->rs_facebook = $data->rs_facebook;
	    $crt->rs_whatsapp = $data->rs_whatsapp;
	    $crt->rs_inst = $data->rs_inst;
		$crt->rs_pweb = $data->rs_pweb;
        $crt->logo = $data->logo;
	    $crt->categoria = $data->categoria;
	    
   		if ($crt->crearServicio()) {
			http_response_code(201);
			echo json_encode(array("message" => "Se registró un nuevo servicio :)"));
		} else {
			http_response_code(404);
			echo json_encode(array("status" => "No se regitro, verifica los datos :("));
		}

	} else {
		http_response_code(503);
		echo json_encode(array("error" => "Incapaz de crear el registro. Los datos están incompletos."));
	}



/*
{
	"id_servicio": "6"
  , "nombre": "Villa Zongolica"
  , "descripcion": "Somos  una empresa de 4 años que se dedica a la elaboración y preparación de bebidas y alimentos de la región, con mas de 15 años en la elaboracion de comidas y experiencia."
  , "coord_lat": "80°"
  , "coord_long": "70°"
  , "horarios": "Todos los dias de 8am a 9pm"
  , "correo": "mf1015129@gmail.com"
  , "direccion": "Av. Ignacio Zaragoza #57, Zongolica, Ver. 95000"
  , "telefono": " 278-122-76-15"
  , "logo": "logo_chido"
  , "categoria": "Alimentos y bebidas"
}
*/

?>