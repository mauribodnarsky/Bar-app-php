<?php
require_once ('../config/db.php');

class Usuario{
	private $nombre;
	private $password;
	private $rol;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	
	function getNombre() {
		return $this->nombre;
	}


	function getPassword() {
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getRol() {
		return $this->rol;
	}

	
	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	

	function setPassword($password) {
		$this->password = $password;
	}

	function setRol($rol) {
		$this->rol = $rol;
	}

	public function getAll(){
		$usuarios=array();
		$usuarioss = $this->db->query("SELECT * FROM usuarios;");
		while($filas=$usuarioss->fetch_assoc()){
            $usuarios[]=$filas;
        }

		return $usuarios;
	}

	public function getOne($id){
		$usuario=array();
		$usuarioss = $this->db->query("SELECT * FROM usuarios WHERE id=".$id."; ");
		while($filas=$usuarioss->fetch_assoc()){
            $usuarios[]=$filas;
        }

		return $usuarios;
	}
	public function backup($sql){
	$archivo=fopen("C:\wamp64\www\LaEstancia\backup\backup.sql", 'a');
	fwrite($archivo, "$sql".PHP_EOL); 
fclose($archivo);
return 0;}
public  function obtenerlafecha(){
	$fecha=$this->db->query("SELECT CURRENT_TIMESTAMP AS 'FECHA'");
					 $fecha= $fecha->fetch_assoc();
                    $fecha= $fecha['FECHA'];
                    return $fecha;
}

public function cargarbackup($backupp){
	$archivo=$backupp;
		$archivo=fopen("C:\wamp64\www\LaEstancia\backup\backup.sql", 'r');

	while(!feof($archivo)) {

$fila= fgets($archivo);
		$resultado = $this->db->query($fila);

}

fclose($archivo);
return true;
}
public function vaciarbd(){
		
		$resultado = $this->db->query("DELETE FROM caja_grande;");
		$resultado = $this->db->query("DELETE FROM cajas;");
		$resultado = $this->db->query("DELETE FROM ventas;");
		$resultado = $this->db->query("DELETE FROM comandas;");
		$resultado = $this->db->query("DELETE FROM caja_chica;");

return true;
}
				
	public function obtenermozos(){
		$usuarios=array();
		$usuarioss = $this->db->query("SELECT * FROM usuarios where rol='mozo';");
		while($filas=$usuarioss->fetch_assoc()){
            $usuarios[]=$filas;
        }

		return $usuarios;
	}
	public function delete($id){
		$sql="DELETE FROM usuarios WHERE id=".$id.";";
		$delete = $this->db->query($sql);
		$this->backup($sql);


		
	}

	public function editar($id){
		$sql = "UPDATE usuarios SET nombre='{$this->getNombre()}',contrasena='{$this->getPassword()}',rol= '{$this->getRol()}' where id=".$id."; ";
$this->backup($sql);
		$save = $this->db->query($sql);
		$result = false;
		if($save){
			$result = true;
		}
		
		return $result;
	}
	

	public function save(){
		$sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}','{$this->getPassword()}', '{$this->getRol()}'); ";
$this->backup($sql);

		$save = $this->db->query($sql);
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function login(){
		$result = false;
		$nombre = $this->nombre;
		$password = $this->password;
		
		// Comprobar si existe el usuario
		$sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
		$login = $this->db->query($sql);
		
		
		if($login && $login->num_rows == 1){
			$usuario = $login->fetch_object();
			// Verificar la contraseña
			$verify = password_verify($password, $usuario->contrasena);
			
			if($verify){
				$result = $usuario;
			}
		}
		
		return $result;
	}
	
	
	
}