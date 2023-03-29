<?php
/*****************************************************************************************
 ****************************************************************************************
	
	* Description: Update variables of table
	
****************************************************************************************
*****************************************************************************************/

	/**
	 * 	@var Class Servicio
	 */
class Servicios_Galeria{
	/**
	 * [$xemc Coenctividad a la base de datos]
	 * @var [conectividad]
	 */
	private $xemc;
	/**
	 * [$table_name Nombre de la base de datos ]
	 * @var table_Datos_Manuales
	 */
	private $table_name = "servicios_galeria";

	public $id_galeria;
	public $foto;
	public $des_foto;
	public $ext_archivo;
	public $id_servicio;


	/**
	 * @param [Construct]
	 */
	public function __construct($db) {
		$this->xemc = $db;
	}

/**
 * Método para consultar todos los registros de la tabla  Servicios_galeria:D 
 */
	public function consultarTodosServicios_Galeria() {
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
	public function consultarPorServicios_Galeria() {
		$search ="SELECT * FROM " . $this->table_name . " 
					WHERE id_galeria= ? ";
		$cemc = $this->xemc->prepare($search);
		$cemc->bindParam(1, $this->id_galeria);
		$cemc->execute();
		$row = $cemc->fetch(PDO::FETCH_ASSOC);

		$this->id_galeria = $row['id_galeria'];
		$this->foto = $row['foto']=base64_encode($row['foto']);
		$this->des_foto = $row['des_foto'];
		$this->ext_archivo = $row['ext_archivo'];
		$this->id_servicio = $row['id_servicio'];
		
	}


/**
 * Método para eliminar registros en la tabla, para ello es necesario enviar el identificador
 */
	public function eliminarServicios_Galeria() {
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
 * Método para crear un nuevo registro en la tabla de servicios_galeria
 */
	function crearServicios_Galeria(){
        $query  = "INSERT INTO " . $this->table_name . " (
			                 foto
			                ,des_foto
							, ext_archivo
							, id_servicio
							
	                	) VALUES (
						  :foto
						, :des_foto
						, :ext_archivo
						, :id_servicio ) "; 

		$stmt = $this->xemc->prepare($query);

		//$this->id_servicio =htmlspecialchars(strip_tags($this->id_servicio));
		$this->foto =htmlspecialchars(strip_tags($this->foto));
		$this->des_foto =htmlspecialchars(strip_tags($this->des_foto));
		$this->ext_archivo =htmlspecialchars(strip_tags($this->ext_archivo));
		$this->id_servicio =htmlspecialchars(strip_tags($this->id_servicio));
		
		
	    //$stmt->bindParam(":id_servicio", $this->id_servicio);
		$stmt->bindParam(":foto", $this->foto);
		$stmt->bindParam(":des_foto", $this->des_foto  );
		$stmt->bindParam(":ext_archivo", $this->ext_archivo);
		$stmt->bindParam(":id_servicio", $this->id_servicio);
		
		
		if($stmt->execute()) {
			return true;
		}
		return false;
	}

/**
 * Método para actualizar una Servicio Galeria en la tabla 
 */
	public function actualizarServicios_Galeria(){
        $sqlQuery = "UPDATE
                    ". $this->table_name ."
                SET
					  id_galeria = :id_galeria
					, foto = :foto
					, des_foto = :des_foto
					, ext_archivo = :ext_archivo
					, id_servicio = :id_servicio
					

                WHERE 
                    id_galeria = :id_galeria";
    
        $stmt = $this->xemc->prepare($sqlQuery);

		$this->id_galeria =htmlspecialchars(strip_tags($this->id_galeria));
		$this->foto =htmlspecialchars(strip_tags($this->foto));
		$this->des_foto =htmlspecialchars(strip_tags($this->des_foto));
		$this->ext_archivo =htmlspecialchars(strip_tags($this->ext_archivo));
		$this->id_servicio =htmlspecialchars(strip_tags($this->id_servicio));
		
		
	    $stmt->bindParam(":id_galeria", $this->id_galeria);
		$stmt->bindParam(":foto", $this->foto);
		$stmt->bindParam(":des_foto", $this->des_foto);
		$stmt->bindParam(":ext_archivo", $this->ext_archivo);
		$stmt->bindParam(":id_servicio", $this->id_servicio);
		

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