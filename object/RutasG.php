<?php
/*****************************************************************************************
 ****************************************************************************************
	
	* Description: Update variables of table
	
****************************************************************************************
*****************************************************************************************/

	/**
	 * 	@var Class Servicio
	 */
class RutasG{
	/**
	 * [$xemc Coenctividad a la base de datos]
	 * @var [conectividad]
	 */
	private $xemc;
	/**
	 * [$table_name Nombre de la base de datos ]
	 * @var table_Datos_Manuales
	 */
	private $table_name = "ruta_turistica_galeria";

	public $id_galeria;
	public $galeria;
	public $des_galeria;
	public $ext_archivo;
	public $id_ruta;


	/**
	 * @param [Construct]
	 */
	public function __construct($db) {
		$this->xemc = $db;
	}

/**
 * Método para consultar todos los registros de la tabla ruta_turistica_galeria:D 
 */
	public function consultarTodosRutasG() {
		$query = "SELECT * FROM
					" . $this->table_name . " 
					ORDER BY id_galeria DESC ";
		$stmt = $this->xemc->prepare($query);
		$stmt->execute();
		return $stmt;
	}

/**
 * Método para la consulta de datos por identificador :D 
 */
	public function consultarPorRutasG() {
		$search ="SELECT * FROM " . $this->table_name . " 
					WHERE id_galeria= ? ";
		$cemc = $this->xemc->prepare($search);
		$cemc->bindParam(1, $this->id_galeria);
		$cemc->execute();
		$row = $cemc->fetch(PDO::FETCH_ASSOC);

		$this->id_galeria = $row['id_galeria'];
		$this->galeria= $row['galeria']=base64_encode($row['galeria']);
		$this->des_galeria = $row['des_galeria'];
		$this->ext_archivo = $row['ext_archivo'];
		$this->id_ruta = $row['id_ruta'];
		
	}


/**
 * Método para eliminar registros en la tabla, para ello es necesario enviar el identificador
 */
	public function eliminarRutasG() {
		$delete = "DELETE FROM " . $this->table_name ." WHERE id_galeria = ?";
		$delt = $this->xemc->prepare($delete);
		$this->id_galeria=htmlspecialchars(strip_tags($this->id_galeria));
		$delt->bindParam(1, $this->id_galeria);
		if($delt->execute()) {
			return true;
		}
		return false;
	}

/**
 * Método para crear un nuevo registro en la tabla de servicios
 */
	function crearRutasG(){
        $query  = "INSERT INTO " . $this->table_name . " (
			                 galeria
			                ,des_galeria
							, ext_archivo
							, id_ruta
							
	                	) VALUES (
						  :galeria
						, :des_galeria
						, :ext_archivo
						, :id_ruta ) "; 

		$stmt = $this->xemc->prepare($query);

		//$this->id_servicio =htmlspecialchars(strip_tags($this->id_servicio));
		$this->galeria =htmlspecialchars(strip_tags($this->galeria));
		$this->des_galeria =htmlspecialchars(strip_tags($this->des_galeria));
		$this->ext_archivo =htmlspecialchars(strip_tags($this->ext_archivo));
		$this->id_ruta =htmlspecialchars(strip_tags($this->id_ruta));
		
		
	    //$stmt->bindParam(":id_servicio", $this->id_servicio);
		$stmt->bindParam(":galeria", $this->galeria);
		$stmt->bindParam(":des_galeria", $this->des_galeria);
		$stmt->bindParam(":ext_archivo", $this->ext_archivo);
		$stmt->bindParam(":id_ruta", $this->id_ruta);
		
		
		if($stmt->execute()) {
			return true;
		}
		return false;
	}
/**
 * Método para actualizar una Ruta Galeria en la tabla de  Ruta turistica Galeria
 */

	public function actualizarRutasG(){
        $sqlQuery = "UPDATE
                    ". $this->table_name ."
                SET
					  id_galeria = :id_galeria
					, galeria = :galeria
					, des_galeria = :des_galeria
					, ext_archivo = :ext_archivo
					, id_ruta = :id_ruta
					

                WHERE 
                    id_galeria = :id_galeria";
    
        $stmt = $this->xemc->prepare($sqlQuery);

		$this->id_galeria =htmlspecialchars(strip_tags($this->id_galeria));
		$this->galeria =htmlspecialchars(strip_tags($this->galeria));
		$this->des_galeria =htmlspecialchars(strip_tags($this->des_galeria));
		$this->ext_archivo =htmlspecialchars(strip_tags($this->ext_archivo));
		$this->id_ruta =htmlspecialchars(strip_tags($this->id_ruta));
		
		
	    $stmt->bindParam(":id_galeria", $this->id_galeria);
		$stmt->bindParam(":galeria", $this->galeria);
		$stmt->bindParam(":des_galeria", $this->des_galeria);
		$stmt->bindParam(":ext_archivo", $this->ext_archivo);
		$stmt->bindParam(":id_ruta", $this->id_ruta);
		

        if($stmt->execute()){
           return true;
        }
        return false;
    }
}

	/*
		Two very boring minutes later: Dos Minutos aburridos mas tarde		
	*/
?>