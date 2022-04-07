<?php
require_once ('../config/db.php');
class Proveedor{
	private $nombre;
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	

	function getNombre() {
		return $this->nombre;
	}

	


	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	public function backup($sql){
	$archivo=fopen("C:\wamp64\www\LaEstancia\backup\backup.sql", 'a');
	fwrite($archivo, "$sql"); 
fclose($archivo);
return 0;}
				

	public function getAll(){
		$proveedores=array();
		$proveedoress = $this->db->query("SELECT * FROM proveedores order by proveedores.nombre desc;");
		while($filas=$proveedoress->fetch_assoc()){
            $proveedores[]=$filas;
        }

		return $proveedores;
	}

	
	public function obtenerproveedor($id){
		$proveedor = $this->db->query("SELECT proveedores.nombre as 'proveedor' FROM proveedores WHERE id =".$id." ");
		$nombre[]=$proveedor->fetch_assoc();
		return $nombre;
	}
	
	
	public function save(){
		$sql = "INSERT INTO proveedores VALUES(NULL,'{$this->getNombre()}'); ";
		$save = $this->db->query($sql);
							$this->backup($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}}
	