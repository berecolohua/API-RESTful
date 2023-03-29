<?php
/*****************************************************************************************
 ****************************************************************************************
	*  Clase para el control de datos del Objeto Administrador
****************************************************************************************
*****************************************************************************************/

	/**
	 * 	@var Class Administrador
	 */
class Administrador{
	/**
	 * [$xemc Conectividad a la base de datos]
	 * @var [conectividad]
	 */
	private $xemc;
	/**
	 * [$table_name Nombre de la base de datos ]
	 * @var table_Datos_Manuales
	 */
	private $table_name = "administrador";

	public $id_admin;
	public $nombre;
	public $password;
	

	/**
	 * @param [Construct]
	 */
	public function __construct($db) {
		$this->xemc = $db;
	}

/**
 * Método para consultar todos los registros de la tabla Administrador :D 
 */
	public function consultarTodosAdministradores() {
		$query = "SELECT * FROM
					" . $this->table_name . " 
					ORDER BY id_admin DESC ";
		$stmt = $this->xemc->prepare($query);
		$stmt->execute();
		return $stmt;
	}

/**
 * Método para la consulta de datos por identificador=id_admin :D 
 */
	public function consultaPorAdministrador() {
		$search ="SELECT * FROM " . $this->table_name . " 
					WHERE id_admin= ? ";
		$cemc = $this->xemc->prepare($search);
		$cemc->bindParam(1, $this->id_admin);
		$cemc->execute();
		$row = $cemc->fetch(PDO::FETCH_ASSOC);

		$this->id_admin = $row['id_admin'];
		$this->nombre = $row['nombre'];
		$this->password = $row['password'];
		
	}

	

/**
 * Método para eliminar registros en la tabla administrador, para ello es necesario enviar el identificador
 */
public function eliminarAdministrador() {
	$delete = "DELETE FROM " . $this->table_name ." WHERE id_admin = ?";
	$delt = $this->xemc->prepare($delete);
	$this->id_admin=htmlspecialchars(strip_tags($this->id_admin));
	$delt->bindParam(1, $this->id_admin);
	if($delt->execute()) {
		return true;
	}
	return false;
}
/**
 * Método para crear un nuevo registro en la tabla de Administrador
 */
	function crearAdministrador(){
        $query  = "INSERT INTO " . $this->table_name . " (
							  nombre
							, password
							
	                	) VALUES (
						  :nombre
						, :password) "; 

		$stmt = $this->xemc->prepare($query);
   		$this->nombre =htmlspecialchars(strip_tags($this->nombre));
		$this->password =htmlspecialchars(strip_tags($this->password));
		
		$stmt->bindParam(":nombre", $this->nombre);
		$stmt->bindParam(":password", $this->password);
		
		if($stmt->execute()) {
			return true;
		}
		return false;
	}
/**
 * Método para actualizar un registro de Administrador en la tabla 
 */

	public function actualizarAdministrador(){
        $sqlQuery = "UPDATE
                    ". $this->table_name ."
                SET
					  id_admin = :id_admin
					, nombre = :nombre
					, password = :password
					

                WHERE 
                    id_admin = :id_admin";
    
        $stmt = $this->xemc->prepare($sqlQuery);

		$this->id_admin =htmlspecialchars(strip_tags($this->id_admin));
		$this->nombre =htmlspecialchars(strip_tags($this->nombre));
		$this->password =htmlspecialchars(strip_tags($this->password));
		
		
	    $stmt->bindParam(":id_admin", $this->id_admin);
		$stmt->bindParam(":nombre", $this->nombre);
		$stmt->bindParam(":password", $this->password);
		

        if($stmt->execute()){
           return true;
        }
        return false;
    }

	}
	
	
	?>
