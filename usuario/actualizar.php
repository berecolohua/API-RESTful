<?php
/*****************************************************************************************
 ****************************************************************************************
   
	* @Document:  Método para el control de [ ACTUALIZAR ] 
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
    include_once '../object/Usuario.php';
    
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
     * @var Manuales
     */
    $upd = new Usuario($db);
    /**
     * [$data description]
     * @var [var]
     */
    $data = json_decode(file_get_contents("php://input"));

    /**
     * [$upd->id_dapp Asigna los datos del JSON a cada variable]
     * @var [var]
     */
    $upd->id_usuario = $data->id_usuario;
    $upd->nombre = $data->nombre;
    $upd->edad = $data->edad;
    $upd->direccion = $data->direccion;
    $upd->correo = $data->correo;
    $upd->paswd = $data->paswd;
   
    /**
     * Ejecutamos
     */
    if($upd->actualizarUsuario()){
        echo json_encode(array("Exito" => "Los datos se actualizaron :) "));
    } else{
        echo json_encode(array("Error" => "Se presentó un error, intenta de nuevo :( "));
    }


?>