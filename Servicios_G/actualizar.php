<?php
/*****************************************************************************************
 Método para el control de [ ACTUALIZAR ] 
	* @Method: [ PUT ]
	
****************************************************************************************
*****************************************************************************************/

	/*
	*	@Indice_cabeza: Definimos loa parametros de la cabeza, 
	*					Datos que enviará el servidor.
	*/
	header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    /*
    *	@Connect: Archivos para conectar con el Servidor y el Objeto User
    */
    include_once '../config/Database.php';
    include_once '../object/Servicios_Galeria.php';
    
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
     * @var Servicios_Galeria
     */
    $upd = new Servicios_Galeria($db);
    /**
     * [$data description]
     * @var [var]
     */
    $data = json_decode(file_get_contents("php://input"));

    /**
     * [$upd->id_servicio Asigna los datos del JSON a cada variable]
     * @var [var]
     */

    $upd->id_galeria = $data->id_galeria;
    $upd->foto = $data->foto;
    $upd->des_foto = $data->des_foto;
    $upd->ext_archivo = $data->ext_archivo;
    $upd->id_servicio = $data->id_servicio;
    
    
    /**
     * Ejecutamos
     */
    if($upd->actualizarServicios_Galeria()){
        http_response_code(200);
        echo json_encode(array("Exito" => "Los datos se actualizaron"));
    } else{
        http_response_code(404);
        echo json_encode(array("Error" => "Se presentó un error, intenta de nuevo"));
    }


?>