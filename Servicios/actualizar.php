<?php
/*****************************************************************************************
 ****************************************************************************************
    

	* Método para el control de [ ACTUALIZAR ] 
	* @Method: [ PUT ]
	
****************************************************************************************
*****************************************************************************************/

	/*
	*	@Indice_cabeza: Definimos loa parametros de la cabeza, 
	*	Datos que enviará el servidor.
	*/
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    /*
    *	@Connect: Archivos para conectar con el Servidor y el Objeto Servicio
    */
    include_once '../config/Database.php';
    include_once '../object/Servicios.php';
    
    /**
     * [$database Conectividad al objeto de la base de datos]
     * @var Database
     */
    $database = new Database();
    /**
     * [$db Obtiene la conexión del objeto]
     * @var [var]
     */
    $db = $database->getConnection();
    /**
     * [$upd Guarda la configuración de la conectividad con el objeto]
     * @var Servicios
     */
    $upd = new Servicios($db);
    /**
     * [$data description]
     * @var [var]
     */
    $data = json_decode(file_get_contents("php://input"));

    /**
     * [$upd->id_servicio Asigna los datos del JSON a cada variable]
     * @var [var]
     */

    $upd->id_servicio = $data->id_servicio;
    $upd->nombre = $data->nombre;
    $upd->descripcion = $data->descripcion;
    $upd->coord_lat = $data->coord_lat;
    $upd->coord_long = $data->coord_long;
    $upd->horarios = $data->horarios;
    $upd->correo = $data->correo;
    $upd->direccion = $data->direccion;
    $upd->telefono = $data->telefono;
    $upd->logo = $data->logo;
    $upd->categoria = $data->categoria;
    
    /**
     * Ejecutamos
     */
    if($upd->actualizarServicio()){
        http_response_code(200);
        echo json_encode(array("Exito" => "Los datos se actualizaron correctamente :)"));
    } else{
        http_response_code(404);
        echo json_encode(array("Error" => "Se presentó un error, intenta de nuevo :("));
    }


?>