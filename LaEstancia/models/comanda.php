<?php

class Comanda{
	private $num_comanda;
	private $mesa;
	private $mozo;
	private $fecha;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	
	function getNum_Comanda() {
		return $this->num_comanda;
	}



	function getMesa() {
		return $this->mesa;
	}
	function getMozo() {
		return $this->mozo;
}
	function getFecha() {
		return $this->fecha;
	}

	
	function setFecha($fecha) {
		$this->fecha = $this->db->real_escape_string($fecha);
	}
function setMozo($mozo) {
		$this->mozo = $this->db->real_escape_string($mozo);
	}
	

	function setNum_Comanda($num_comanda) {
		$this->num_comanda = $num_comanda;
	}

	function setMesa($Mesa) {
		$this->mesa = $Mesa;
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
	 function save(){
	 	$fecha=$this->obtenerlafecha();
		
		$sql = "INSERT INTO comandas VALUES(NULL, {$this->getNum_Comanda()},{$this->getMesa()},{$this->getMozo()},'".$fecha."','EFECTIVO'); ";

					$this->backup($sql);
		

		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	 function generarnumerocomanda(){
		$sql = "SELECT MAX(num_comanda) as 'numero' FROM comandas;";

		$save = $this->db->query($sql);
		
		$result = $save->fetch_assoc();
		
		return $result;
	}
	function calculartotal($comanda){
		$sql="SELECT SUM(ventas.cantidad*productos.precio) as 'total' FROM productos INNER JOIN ventas ON ventas.producto=productos.codigo INNER JOIN comandas ON comandas.num_comanda=ventas.comanda WHERE comandas.num_comanda=".$comanda;
		$save = $this->db->query($sql);
		
		$result = $save->fetch_assoc();
		$result =$result['total'];
		if ($result==null) {
			$result=0;
		}
		return $result;
	}
	function seleccionarcomanda($mesa){
		$sql = "SELECT MAX(num_comanda) as 'comanda' FROM comandas WHERE mesa=".$mesa.";";
		$save = $this->db->query($sql);
		
		$result = $save->fetch_assoc();
		
		return $result;
	}
	function ingresarpago($comanda,$pago){
		$sql = "UPDATE comandas SET metodo_pago='".$pago."' WHERE num_comanda=".$comanda." ";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	function guardarventa($producto,$cantidad,$num_comanda){
					 	$fecha=$this->obtenerlafecha();


		$sql = "INSERT INTO ventas VALUES (".$producto.",".$cantidad.",".$num_comanda.",'".$fecha."'); ";
		$save = $this->db->query($sql);
					$this->backup($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;

	}
	function editarventa($comanda,$cantidad,$fecha){
		$sql="UPDATE ventas SET cantidad=".$cantidad." WHERE ventas.fecha='".$fecha."' and ventas.comanda=".$comanda."; ";

					$this->backup($sql);

		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = $sql;
		}
		return $result;
	}
	
	function generarfactura($mesa){
		$sql="SELECT ventas.fecha as 'fecha',ventas.comanda as 'comanda', productos.nombre as 'producto',SUM(ventas.cantidad) as 'cantidad',productos.precio as 'precio' FROM ventas INNER JOIN productos ON productos.codigo=ventas.producto WHERE ventas.comanda IN(SELECT MAX(comandas.num_comanda) FROM comandas WHERE comandas.mesa=".$mesa.") GROUP BY productos.nombre";
						$productoss = $this->db->query($sql);
			while($filas=$productoss->fetch_assoc()){
				            $productos[]=$filas;
				        }
			if (empty($productos)) {
				$productos=false;
			}
			return $productos;
	}

		function cambiarmozo($comanda,$mozo){
		$sql="UPDATE comandas SET mozo='".$mozo."' WHERE comandas.num_comanda=".$comanda."; ";

					$this->backup($sql);

		$save = $this->db->query($sql);
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	function obtenermozo($comanda){
		$sql="SELECT usuarios.nombre as 'mozo' FROM comandas INNER JOIN usuarios ON comandas.mozo=usuarios.id WHERE comandas.num_comanda=".$comanda;
		$save = $this->db->query($sql);
		$result = $save->fetch_assoc();
		$result=$result['mozo'];
		return $result;
	}

		function guardarcliente($mesa,$cliente,$direccion,$telefono){
		$sql="INSERT INTO clientes VALUES(".$mesa.",'".$cliente."','".$direccion."','".$telefono."'); ";
					$this->backup($sql);

		$save = $this->db->query($sql);
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	
}
function borrarcliente($nro){
	$sql="DELETE FROM clientes WHERE mesa=".$mesa."; ";
					$this->backup($sql);

		$save = $this->db->query($sql);
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
}
function seleccionarcliente($mesa){
		$sql="SELECT * FROM clientes WHERE clientes.mesa=".$mesa." ";
						$clientess = $this->db->query($sql);
			while($filas=$clientess->fetch_assoc()){

				            $clientes[]=$filas;
				        }
			if (empty($clientes)) {
				$clientes=false;
			}
			return $clientes;
	}
}