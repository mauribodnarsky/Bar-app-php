<?php
				require_once ('../config/db.php');
				class caja{
					private $num_caja;
					private $fecha;
					private $estado;
					public $db;
					private $pago;
					public function __construct() {
						$this->db = Database::connect();
					}
					
					function setNumCaja($num_caja) {
						$this->num_caja = $num_caja;
					}					

					function setFecha($fecha) {
						$this->fecha = $this->db->real_escape_string($fecha);
					}
                    function setEstado($estado){
                    	$this->estado=$estado;
                    }
                    function getPago() {
						return $this->pago;
					}



	
					function setPago($pago) {
					$this->pago = $pago;
					}



                    function getNumCaja() {
						return $this->num_caja;
					}
				   
					function getFecha() {
						return $this->fecha;
					}
					function getEstado() {
						return $this->estado;
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
				public function abrirCaja(){
					$fecha=$this->obtenerlafecha();

						$sql = "INSERT INTO cajas VALUES({$this->getNumCaja()},'".$fecha."','{$this->getEstado()}',NULL); ";

					$this->backup($sql);
						$save = $this->db->query($sql);
						
						$result = false;
						if($save){
							$result = true;
						}
						return $result;
					}
				
				
				public function seleccionarUltimaCaja(){
					$sql="SELECT MAX(num_caja) as numero from cajas";
					$resultado = $this->db->query($sql);
                    $resultado= $resultado->fetch_assoc();
                    $resultado= $resultado['numero'];

                     return $resultado;
				}

					public function verificarCaja(){
						$sql= "SELECT estado FROM cajas WHERE num_caja in(SELECT MAX(num_caja) FROM cajas)";
						$resultado = $this->db->query($sql);
						$objeto=$resultado->fetch_assoc();
						$estado=$objeto['estado'];
				  

						return $estado;

					}


				public function cerrarCaja($num_caja){
	$fecha=$this->obtenerlafecha();

					
						$sql= "UPDATE cajas SET estado='c',fecha_cierre='".$fecha."'  WHERE num_caja=".$num_caja."; ";

					$this->backup($sql);
						$resultado = $this->db->query($sql);
						if ($resultado==true) {
							return true;
						}else{
							return false;
						}


					}
					public function datosmozos($fechainicio="'2010-12-30 09:43:03'",$fechafin="CURRENT_TIMESTAMP",$mozo=""){
						$sql="SELECT SUM(ventas.cantidad*productos.precio) AS 'total',count(comandas.mozo) AS 'mesas_atendidas',SUM(ventas.cantidad) 'productos_vendidos',usuarios.nombre as 'mozo' FROM comandas INNER JOIN usuarios on usuarios.id=comandas.mozo INNER JOIN ventas ON ventas.comanda=comandas.num_comanda INNER JOIN productos on productos.codigo=ventas.producto where ventas.fecha BETWEEN ".$fechainicio." and ".$fechafin;
						if ($mozo!="") {
							$sql=$sql." AND comandas.mozo=".$mozo;
						
						}
						$sql=$sql." GROUP BY comandas.mozo";
							$resultado = $this->db->query($sql);

							if (mysqli_num_rows($resultado)>0) {
								
						while($filas=$resultado->fetch_assoc()){
						$datos[]=$filas;
						}

						return $datos;
					}else{return null;}}
					public function obtenermozos(){
						$sql="SELECT * FROM usuarios WHERE rol='mozo'";
							$resultado = $this->db->query($sql);
						while($filas=$resultado->fetch_assoc()){
						$datos[]=$filas;
						}
						
						return $datos;
					}
					public function ventasmozos($fechainicio="'2010-12-30 09:43:03'",$fechafin="CURRENT_TIMESTAMP",$mozo=""){
			$sql="SELECT productos.nombre as 'producto',ventas.cantidad as 'cantidad',productos.precio as 'precio',comandas.mesa as 'mesa',comandas.metodo_pago as 'pago',usuarios.nombre as 'mozo',productos.precio*ventas.cantidad as 'total', DATE_FORMAT(ventas.fecha,\"%H: %i hs %d-%m-%Y \") as 'fecha' FROM comandas INNER JOIN usuarios on usuarios.id=comandas.mozo INNER JOIN ventas ON ventas.comanda=comandas.num_comanda INNER JOIN productos on productos.codigo=ventas.producto WHERE";
			if ($mozo!="") {
				$sql=$sql." usuarios.id=".$mozo." AND ";
			}
			$sql=$sql."  ventas.fecha  BETWEEN ".$fechainicio." and ".$fechafin." ORDER BY ventas.fecha DESC;";
			$resultado = $this->db->query($sql);
			if (mysqli_num_rows($resultado)>0) {
			while($filas=$resultado->fetch_assoc()){
				$ventas[]=$filas;
			}
			return $ventas;
}else{return null;}

		}
				}