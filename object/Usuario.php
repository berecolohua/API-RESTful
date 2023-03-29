<?php
/*****************************************************************************************
 ****************************************************************************************
	
****************************************************************************************
*****************************************************************************************/

	/**
	 * 	@var Class Usuarios_turista 
	 */
class Usuario{
	/**
	 * [$xemc Coenctividad a la base de datos]
	 * @var [conectividad]
	 */
	private $xemc;
	/**
	 * [$table_name Nombre de la base de datos ]
	 * @var table_Datos_Manuales
	 */
	private $table_name = "usuario_turista";

	public $id_usuario;
	public $nombre;
	public $edad;
	public $direccion;
	public $correo;
	public $paswd;
	
	 

	/**
	 * @param [Construct]
	 */
	public function __construct($db) {
		$this->xemc = $db;
	}
/**
 * Método para consultar todos los registros de la tabla Usuario_turista:D 
 */

	public function consultarTodosUsuarios() {
		$query = "SELECT * FROM
					" . $this->table_name . " 
					ORDER BY id_usuario DESC ";
		$stmt = $this->xemc->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	// Consulta por identificador de usuario
	public function consultarPorUsuarios() {
		$search ="SELECT * FROM " . $this->table_name . " 
			WHERE id_usuario= ? ";
		$cemc = $this->xemc->prepare($search);
		$cemc->bindParam(1, $this->id_usuario);
		$cemc->execute();
		$row = $cemc->fetch(PDO::FETCH_ASSOC);
		
		//HERE
		$this->id_usuario = $row['id_usuario'];
		$this->nombre= $row['nombre'];
		$this->edad= $row['edad'];
		$this->direccion = $row['direccion'];
		$this->correo = $row['correo'];
		$this->paswd= $row['paswd'];
		
	}

/**
 * Método para eliminar registros en la tabla, para ello es necesario enviar el identificador
 */	

	public function eliminarUsuarios() {
		$delete = "DELETE FROM " . $this->table_name ." WHERE id_usuario = ?";
		$delt = $this->xemc->prepare($delete);
		$this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
		$delt->bindParam(1, $this->id_usuario);
		if($delt->execute()) {
			return true;
		}
		return false;
	}
/**
 * Método para crear un nuevo registro en la tabla de servicios Usuario Turista
 */

	public function crearNuevoUsuario() {
        $query  = 'INSERT INTO '. $this->table_name . ' (
        				  
						nombre
						,edad
						,direccion
						,correo
						,paswd
	                	) 
                	VALUES(
	                	  
					 :nombre
						, :edad
						, :direccion
						, :correo
						, :paswd
						) '; 

		$stmt = $this->xemc->prepare($query);

		
		$this->nombre =htmlspecialchars(strip_tags($this->nombre));
		$this->edad =htmlspecialchars(strip_tags($this->edad));
		$this->direccion =htmlspecialchars(strip_tags($this->direccion));
		$this->correo =htmlspecialchars(strip_tags($this->correo));
		$this->paswd =htmlspecialchars(strip_tags($this->paswd));

	   
		$stmt->bindParam(":nombre", $this->nombre);
		$stmt->bindParam(":edad", $this->edad);
		$stmt->bindParam(":direccion", $this->direccion);
		$stmt->bindParam(":correo", $this->correo);
		$stmt->bindParam(":paswd", $this->paswd);
		
		if($stmt->execute()) {
			return true;
		}
		return false;
	}

/**
 * Método para actualizar un Usuario Turista  Galeria en la tabla 
 */	

	public function actualizarUsuario(){
        $sqlQuery = "UPDATE
                    ". $this->table_name ."
                SET
					  id_usuario = :id_usuario
					, nombre = :nombre
					, edad = :edad
					, direccion = :direccion
					, correo = :correo
					, paswd = :paswd
					
                WHERE 
                    id_usuario = :id_usuario";
    
        $stmt = $this->xemc->prepare($sqlQuery);
		$this->id_usuario =htmlspecialchars(strip_tags($this->id_usuario));
		$this->nombre =htmlspecialchars(strip_tags($this->nombre));
		$this->edad=htmlspecialchars(strip_tags($this->edad));
		$this->direccion =htmlspecialchars(strip_tags($this->direccion));
		$this->correo =htmlspecialchars(strip_tags($this->correo));
		$this->paswd =htmlspecialchars(strip_tags($this->paswd));
		$stmt->bindParam(":id_usuario", $this->id_usuario);
		$stmt->bindParam(":nombre", $this->nombre);
		$stmt->bindParam(":edad", $this->edad);
		$stmt->bindParam(":direccion", $this->direccion);
		$stmt->bindParam(":correo", $this->correo);
		$stmt->bindParam(":paswd", $this->paswd);
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