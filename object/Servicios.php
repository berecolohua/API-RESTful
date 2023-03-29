<?php
/*****************************************************************************************
 ****************************************************************************************
	
*  Clase para el control de datos del Objeto servicios

****************************************************************************************
*****************************************************************************************/

	/**
	 * 	@var Class Servicio
	 */
class Servicios{
	/**
	* [$xemc Conectividad a la base de datos]
	* @var [conectividad]
	*/
	private $xemc;
	
	/**
	* [$table_name Nombre de la tabla]
	* @var table_Datos_Servicios
	*/
	private $table_name = "servicios";

	public $id_servicio;
	public $nombre;
	public $descripcion;
	public $coord_lat;
	public $coord_long;
	public $horarios;
	public $correo; 
	public $direccion;
	public $telefono;
	public $rs_facebook;
	public $rs_whatsapp;
	public $rs_inst;
	public $rs_pweb;
	public $logo;
	public $categoria;

	/**
	 * @param [Constructor]
	 */
	public function __construct($db) {
		$this->xemc = $db;
	}
	
/**
 * Método para consultar todos los registros de la tabla Servicios:D 
 */
	public function consultarTodosServicios() {
		$query = "SELECT * FROM
					" . $this->table_name . " 
					ORDER BY id_servicio DESC ";
		$stmt = $this->xemc->prepare($query);
		$stmt->execute();
		return $stmt;
		
		
				}


 /* Método para la consulta de datos por identificador :D 
 */
	public function consultarPorServicio() {
		$search ="SELECT * FROM " . $this->table_name . " 
					WHERE id_servicio= ? ";
		$cemc = $this->xemc->prepare($search);
		$cemc->bindParam(1, $this->id_servicio);
		$cemc->execute();
		$row = $cemc->fetch(PDO::FETCH_ASSOC);

		$this->id_servicio = $row['id_servicio'];
		$this->nombre = $row['nombre'];
		$this->descripcion = $row['descripcion'];
		$this->coord_lat = $row['coord_lat'];
		$this->coord_long = $row['coord_long'];
		$this->horarios = $row['horarios'];
		$this->correo = $row['correo'];
		$this->direccion = $row['direccion'];
		$this->telefono = $row['telefono'];
		$this->rs_facebook = $row['rs_facebook'];
		$this->rs_whatsapp = $row['rs_whatsapp'];
		$this->rs_inst = $row['rs_inst'];
		$this->rs_pweb = $row['rs_pweb'];
		$this->logo = $row['logo']=base64_encode($row['logo']);
		$this->categoria = $row['categoria'];
	}
/**
 * Prueba de Consulta por categoria
 */
public function consultarPorServicio_cat() {
	$search ="SELECT  * FROM " . $this->table_name . " 
				WHERE  categoria= ? ";
	$cemc = $this->xemc->prepare($search);
	//liena de codigo para eliminar codigo malisioso 
	$this->categoria=htmlspecialchars(strip_tags($this->categoria));
	//
	$cemc->bindParam(1, $this->categoria);
	$cemc->execute();
	return $cemc;
 
}


/**
 * Método para eliminar registros en la tabla, para ello es necesario enviar el identificador
 */
	public function eliminarServicio() {
		$delete = "DELETE FROM " . $this->table_name ." WHERE id_servicio = ?";
		$delt = $this->xemc->prepare($delete);
		$this->id_servicio=htmlspecialchars(strip_tags($this->id_servicio));
		$delt->bindParam(1, $this->id_servicio);
		if($delt->execute()) {
			return true;
		}
		return false;
	}
 
/**
 * Método para crear un nuevo registro en la tabla de servicios
 */
	function crearServicio(){
        $query  = "INSERT INTO " . $this->table_name . " (
							  nombre
							, descripcion
							, coord_lat
							, coord_long
							, horarios
							, correo
							, direccion
							, telefono
							, rs_facebook
							, rs_whatsapp
							, rs_inst
							, rs_pweb
							, logo
							, categoria
	                	) VALUES (
						  :nombre
						, :descripcion
						, :coord_lat
						, :coord_long
						, :horarios
						, :correo
						, :direccion
						, :telefono
						, :rs_facebook
						, :rs_whatsapp
						, :rs_inst
						, :rs_pweb
						, :logo
						, :categoria ) "; 

		$stmt = $this->xemc-> prepare($query);





		//$this->id_servicio =htmlspecialchars(strip_tags($this->id_servicio));
		$this->nombre =htmlspecialchars(strip_tags($this->nombre));
		$this->descripcion =htmlspecialchars(strip_tags($this->descripcion));
		$this->coord_lat =htmlspecialchars(strip_tags($this->coord_lat));
		$this->coord_long =htmlspecialchars(strip_tags($this->coord_long));
		$this->horarios =htmlspecialchars(strip_tags($this->horarios));
		$this->correo =htmlspecialchars(strip_tags($this->correo));
		$this->direccion =htmlspecialchars(strip_tags($this->direccion));
		$this->telefono =htmlspecialchars(strip_tags($this->telefono));
		$this->rs_facebook =htmlspecialchars(strip_tags($this->rs_facebook));
		$this->rs_whatsapp =htmlspecialchars(strip_tags($this->rs_whatsapp));
		$this->rs_inst =htmlspecialchars(strip_tags($this->rs_inst));
		$this->rs_pweb =htmlspecialchars(strip_tags($this->rs_pweb));
		$this->logo =htmlspecialchars(strip_tags($this->logo));
		$this->categoria =htmlspecialchars(strip_tags($this->categoria));
		
	    //$stmt->bindParam(":id_servicio", $this->id_servicio);
		$stmt->bindParam(":nombre", $this->nombre);
		$stmt->bindParam(":descripcion", $this->descripcion);
		$stmt->bindParam(":coord_lat", $this->coord_lat);
		$stmt->bindParam(":coord_long", $this->coord_long);
		$stmt->bindParam(":horarios", $this->horarios);
		$stmt->bindParam(":correo", $this->correo);
		$stmt->bindParam(":direccion", $this->direccion);
		$stmt->bindParam(":telefono", $this->telefono);
		$stmt->bindParam(":rs_facebook", $this->rs_facebook);
		$stmt->bindParam(":rs_whatsapp", $this->rs_whatsapp);
		$stmt->bindParam(":rs_inst", $this->rs_inst);
		$stmt->bindParam(":rs_pweb", $this->rs_pweb);
		$stmt->bindParam(":logo", $this->logo);
		$stmt->bindParam(":categoria", $this->categoria);
		if($stmt->execute()) {
			return true;
		}
		return false;
	}

/**
 * Método para actualizar una Servicio en la tabla 
 */
	public function actualizarServicio(){
        $sqlQuery = "UPDATE
                    ". $this->table_name ."
                SET
					  id_servicio = :id_servicio
					, nombre = :nombre
					, descripcion = :descripcion
					, coord_lat = :coord_lat
					, coord_long = :coord_long
					, horarios = :horarios
					, correo = :correo
					, direccion = :direccion
					, telefono = :telefono
					, rs_facebook = :rs_facebook
					, rs_whatsapp = :rs_whatsapp
					, rs_inst = :rs_inst
					, rs_pweb = :rs_pweb
					, logo = :logo
					, categoria = :categoria

                WHERE 
                    id_servicio = :id_servicio";
    
        $stmt = $this->xemc->prepare($sqlQuery);

		$this->id_servicio =htmlspecialchars(strip_tags($this->id_servicio));
		$this->nombre =htmlspecialchars(strip_tags($this->nombre));
		$this->descripcion =htmlspecialchars(strip_tags($this->descripcion));
		$this->coord_lat =htmlspecialchars(strip_tags($this->coord_lat));
		$this->coord_long =htmlspecialchars(strip_tags($this->coord_long));
		$this->horarios =htmlspecialchars(strip_tags($this->horarios));
		$this->correo =htmlspecialchars(strip_tags($this->correo));
		$this->direccion =htmlspecialchars(strip_tags($this->direccion));
		$this->telefono =htmlspecialchars(strip_tags($this->telefono));
		$this->rs_facebook =htmlspecialchars(strip_tags($this->rs_facebook));
		$this->rs_whatsapp =htmlspecialchars(strip_tags($this->rs_whatsapp));
		$this->rs_inst =htmlspecialchars(strip_tags($this->rs_inst));
		$this->rs_pweb =htmlspecialchars(strip_tags($this->rs_pweb));
		$this->logo =htmlspecialchars(strip_tags($this->logo));
		$this->categoria =htmlspecialchars(strip_tags($this->categoria));
		
	    $stmt->bindParam(":id_servicio", $this->id_servicio);
		$stmt->bindParam(":nombre", $this->nombre);
		$stmt->bindParam(":descripcion", $this->descripcion);
		$stmt->bindParam(":coord_lat", $this->coord_lat);
		$stmt->bindParam(":coord_long", $this->coord_long);
		$stmt->bindParam(":horarios", $this->horarios);
		$stmt->bindParam(":correo", $this->correo);
		$stmt->bindParam(":direccion", $this->direccion);
		$stmt->bindParam(":telefono", $this->telefono);
		$stmt->bindParam(":rs_facebook", $this->rs_facebook);
		$stmt->bindParam(":rs_whatsapp", $this->rs_whatsapp);
		$stmt->bindParam(":rs_inst", $this->rs_inst);
		$stmt->bindParam(":rs_pweb", $this->rs_pweb);
		$stmt->bindParam(":logo", $this->logo);
		$stmt->bindParam(":categoria", $this->categoria);

        if($stmt->execute()){
           return true;
        }
        return false;
    }
}
?>