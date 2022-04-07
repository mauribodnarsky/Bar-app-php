<?php
				require_once ('../config/db.php');
				class mesa{
					private $numero;
					private $sector;
					private $estado;
					
					public function __construct() {
						$this->db = Database::connect();
					}
					
					function Id() {
						return $this->id;
					}

					function getNumeroMesa() {
						return $this->numero;
					}
				   
					function getSector() {
						return $this->sector;
					}
					function getEstado() {
						return $this->estado;
					}


					

	
					function setNumeroMesa($numero) {
						$this->numero = $this->$numero;
					}

					

					function setSector($sector) {
						$this->sector = $this->db->real_escape_string($sector);
					}
                    function setEstado($estado){
                    	$this->estado=$this->$estado;
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
				public function crearMesa($numero){
						$sql = "INSERT INTO mesas VALUES(NULL,$numero,true); ";

					$this->backup($sql);

						$save = $this->db->query($sql);
						
						$result = false;
						if($save){
							$result = true;
						}
						return $result;
					}
				public function abrirMesa($numero){
					$sql="UPDATE mesas SET estado=false where numero_mesa=".$numero." ; ";

					$this->backup($sql);

					$save = $this->db->query($sql);
						
						$result = false;
						if($save){
							$result = true;
						}
						return $result;
				}
				public function cerrarMesa($numero){
					$sql="UPDATE mesas SET estado=true where numero_mesa=".$numero." ; ";

					$this->backup($sql);

					$save = $this->db->query($sql);
						
						$result = false;
						if($save){
							$result = true;
						}
						return $result;
				}
				
				public function generarNumeroMesa(){
					$sql="SELECT MAX(numero_mesa) as numero from mesas";
					$resultado = $this->db->query($sql);
                     $resultado= $resultado->fetch_assoc();
                     return $resultado;
				}

					public function obtenerMesas(){
						$sql= "SELECT * FROM mesas ORDER BY numero_mesa ASC";
						$resultado = $this->db->query($sql);
						while($filas=$resultado->fetch_assoc()){
				            $mesas[]=$filas;
				        }

						return $mesas;

					}

				public function seleccionarMesa($id){
						$sql= "SELECT * FROM mesas WHERE numero_mesa=".$id.";";
						$resultado = $this->db->query($sql);
						$mesas=$resultado->fetch_assoc();

						return $mesas;

					}
					public function obtenerMozo($mesa){
						$sql= "SELECT usuarios.nombre as 'mozo' FROM usuarios INNER JOIN comandas ON comandas.mozo=usuarios.id INNER JOIN mesas ON mesas.numero_mesa=comandas.mesa WHERE comandas.mesa=".$mesa."  ORDER by comandas.fecha DESC limit 1;";
						$resultado = $this->db->query($sql);
						$mozo=$resultado->fetch_assoc();
						$mozo=$mozo['mozo'];

						return $mozo;

					}
					public function MesasAbiertas(){
						$sql= "SELECT numero_mesa FROM `mesas` WHERE estado=0";
						$resultado = $this->db->query($sql);
						$numerof=$resultado->num_rows;
						if ($numerof==0) {
							$mesas=false;
						}else{
						while($filas=$resultado->fetch_assoc()){
				            $mesas[]=$filas;
				        }}

						return $mesas;

					}
				}