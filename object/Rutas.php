<?php
/*****************************************************************************************
 ****************************************************************************************
	
*  Clase para el control de datos del Objeto rutas

****************************************************************************************
*****************************************************************************************/

	/**
	 * 	@var Class Servicio
	 */
class Rutas{
	/**
	* [$xemc Conectividad a la base de datos]
	* @var [conectividad]
	*/
	private $xemc;
	/**
	* [$table_name Nombre de la tabla]
	* @var table_Datos_Ruta_turistica
	*/
	private $table_name = "ruta_turistica";

	public $id_ruta;
	public $nombre;
	public $descripcion;
	public $coord_lat;
	public $coord_long;
	public $rs_facebook;
	public $rs_whatsapp;
	public $rs_inst;
	public $thumbnail;
	public $des_foto;

	/**
	 * @param [Constructor]
	 */
	public function __construct($db) {
		$this->xemc = $db;
	}

/**
 * Método para consultar todos los registros de la tabla ruta_turistica :D 
 */
	public function consultarTodasRutasturisticas() {
		$query = "SELECT * FROM
					" . $this->table_name . " 
					ORDER BY id_ruta DESC ";
		$stmt = $this->xemc->prepare($query);
		$stmt->execute();
		return $stmt;
	}

/**
 * Método para la consulta de datos por identificador de la tabla ruta_turisticas:D 
*/
    public function consultaPorRutaturistica() {
			$search ="SELECT * FROM " . $this->table_name . " 
						WHERE id_ruta= ? ";
			$cemc = $this->xemc->prepare($search);
			$cemc->bindParam(1, $this->id_ruta);
			$cemc->execute();
			$row = $cemc->fetch(PDO::FETCH_ASSOC);
	
			$this->id_servicio = $row['id_ruta'];
			$this->nombre = $row['nombre'];
			$this->descripcion = $row['descripcion'];
			$this->coord_lat = $row['coord_lat'];
			$this->coord_long = $row['coord_long'];
			$this->rs_facebook = $row['rs_facebook'];
			$this->rs_whatsapp = $row['rs_whatsapp'];
			$this->rs_inst = $row['rs_inst'];
			$this->thumbnail = $row['thumbnail']=base64_encode($row['thumbnail']);
			$this->des_foto = $row['des_foto'];
		
		}

/**
 * Método para eliminar  una Ruta en la tabla=ruta_turistica, para ello es necesario enviar el identificador=id_galeria
 */
	public function eliminarRutaturistica() {
		$delete = "DELETE FROM " . $this->table_name ." WHERE id_ruta = ?";
		$delt = $this->xemc->prepare($delete);
		$this->id_ruta=htmlspecialchars(strip_tags($this->id_ruta));
		$delt->bindParam(1, $this->id_ruta);
		if($delt->execute()) {
			return true;
		}
		return false;
	}

/**
 * Método para crear una nueva Ruta en la tabla de ruta_turistica
 */
	function crearRutaturistica(){
        $query  = "INSERT INTO " . $this->table_name . " (
							  nombre
							, descripcion
							, coord_lat
							, coord_long
							, rs_facebook
							, rs_whatsapp
							, rs_inst
							, thumbnail
							, des_foto
	                	) VALUES (
						  :nombre
						, :descripcion
						, :coord_lat
						, :coord_long
						, :rs_facebook
						, :rs_whatsapp
						, :rs_inst
						, :thumbnail
						, :des_foto ) "; 

		$stmt = $this->xemc->prepare($query);

		
		$this->nombre =htmlspecialchars(strip_tags($this->nombre));
		$this->descripcion =htmlspecialchars(strip_tags($this->descripcion));
		$this->coord_lat =htmlspecialchars(strip_tags($this->coord_lat));
		$this->coord_long =htmlspecialchars(strip_tags($this->coord_long));
		$this->rs_facebook =htmlspecialchars(strip_tags($this->rs_facebook));
		$this->rs_whatsapp =htmlspecialchars(strip_tags($this->rs_whatsapp));
		$this->rs_inst =htmlspecialchars(strip_tags($this->rs_inst));
		$this->thumbnail =htmlspecialchars(strip_tags($this->thumbnail));
		$this->des_foto =htmlspecialchars(strip_tags($this->des_foto));
		
	    
		$stmt->bindParam(":nombre", $this->nombre);
		$stmt->bindParam(":descripcion", $this->descripcion);
		$stmt->bindParam(":coord_lat", $this->coord_lat);
		$stmt->bindParam(":coord_long", $this->coord_long);
		$stmt->bindParam(":rs_facebook", $this->rs_facebook);
		$stmt->bindParam(":rs_whatsapp", $this->rs_whatsapp);
		$stmt->bindParam(":rs_inst", $this->rs_inst);
		$stmt->bindParam(":thumbnail", $this->thumbnail);
		$stmt->bindParam(":des_foto", $this->des_foto);
		
		if($stmt->execute()) {
			return true;
		}
		return false;
	}



/**
 * Método para actualizar una Ruta en la tabla de ruta_turistica
 */
	public function actualizarRutaturistica(){
        $sqlQuery = "UPDATE
                    ". $this->table_name ."
                SET
					  id_ruta = :id_ruta
					, nombre = :nombre
					, descripcion = :descripcion
					, coord_lat = :coord_lat
					, coord_long = :coord_long
					, rs_facebook = :rs_facebook
					, rs_whatsapp = :rs_whatsapp
					, rs_inst = :rs_inst
					, thumbnail = :thumbnail
					, des_foto = :des_foto

                WHERE 
				id_ruta = :id_ruta";
    
        $stmt = $this->xemc->prepare($sqlQuery);

		$this->id_ruta =htmlspecialchars(strip_tags($this->id_ruta));
		$this->nombre =htmlspecialchars(strip_tags($this->nombre));
		$this->descripcion =htmlspecialchars(strip_tags($this->descripcion));
		$this->coord_lat =htmlspecialchars(strip_tags($this->coord_lat));
		$this->coord_long =htmlspecialchars(strip_tags($this->coord_long));
		$this->rs_facebook =htmlspecialchars(strip_tags($this->rs_facebook));
		$this->rs_whatsapp =htmlspecialchars(strip_tags($this->rs_whatsapp));
		$this->rs_inst =htmlspecialchars(strip_tags($this->rs_inst));
		$this->thumbnail =htmlspecialchars(strip_tags($this->thumbnail));
		$this->des_foto =htmlspecialchars(strip_tags($this->des_foto));
		
	    $stmt->bindParam(":id_ruta", $this->id_ruta);
		$stmt->bindParam(":nombre", $this->nombre);
		$stmt->bindParam(":descripcion", $this->descripcion);
		$stmt->bindParam(":coord_lat", $this->coord_lat);
		$stmt->bindParam(":coord_long", $this->coord_long);
		$stmt->bindParam(":rs_facebook", $this->rs_facebook);
		$stmt->bindParam(":rs_whatsapp", $this->rs_whatsapp);
		$stmt->bindParam(":rs_inst", $this->rs_inst);
		$stmt->bindParam(":thumbnail", $this->thumbnail);
		$stmt->bindParam(":des_foto", $this->des_foto);

        if($stmt->execute()){
           return true;
        }
        return false;
    }
}
?>