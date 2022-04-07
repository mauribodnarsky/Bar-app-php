<?php
require_once '../models/caja.php';
require_once ('../config/db.php');
class cajaChica extends caja{
	private $ingreso;
	private $egreso;
	private $detalle;
	private $fecha;
	private $tipo;
	public function __construct() {
		$this->db = Database::connect();
	}



	function getIngreso() {
		return $this->ingreso;
	}

	function getEgreso() {
		return $this->egreso;
	}
	function getDetalle() {
		return $this->detalle;
	}
	function getTipo() {
		return $this->tipo;
	}

	function getFecha() {
		return $this->fecha;
	}


	
	function setIngreso($ingreso) {
		$this->ingreso = $ingreso;
	}


	function setTipo($tipo){
		$this->tipo=	$tipo;
	}
	function setFecha($fecha){
		$this->fecha=	$fecha;
	}
	function setEgreso($egreso) {
		$this->egreso = $egreso;
	}
	function setDetalle($detalle){
		$this->detalle=$detalle;
	}


	public function guardarmovimiento(){
						$fecha=$this->obtenerlafecha();

		$sql = "INSERT INTO caja_chica VALUES({$this->getIngreso()},{$this->getEgreso()},'{$this->getDetalle()}',{$this->getNumCaja()},NULL,'{$this->getTipo()}','".$fecha."','{$this->getPago()}'); ";
					$this->backup($sql);
		
		$save = $this->db->query($sql);
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function guardardescuento($comanda){
		$fecha=$this->obtenerlafecha();
		
		$sql = "INSERT INTO caja_chica VALUES({$this->getIngreso()},{$this->getEgreso()},'{$this->getDetalle()}',{$this->getNumCaja()},".$comanda.",'{$this->getTipo()}','".$fecha."','{$this->getPago()}'); ";
		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	
	public function obtenerdescuento($comanda){
		$sql="SELECT caja_chica.egreso FROM `caja_chica` WHERE caja_chica.comanda=".$comanda;
		$save=$this->db->query($sql);
		$total=false;
		if($save!=false){ 
			$total=$save->fetch_assoc();
			$total=$total['egreso'];
		}
		return $total;
	}
	public function totalposnet($caja){
		$total=0.00;
$sql="SELECT (SELECT (SUM(caja_chica.ingreso)) FROM caja_chica where caja_chica.pago='POSNET' and caja_chica.caja=".$caja." and caja_chica.tipo='')-(SELECT(SUM(caja_chica.egreso)) FROM caja_chica where caja_chica.pago='POSNET' and caja_chica.caja=".$caja.") as 'POSNET'";
		$save=$this->db->query($sql);
		$total=$save->fetch_assoc();
		$total=$total['POSNET'];
		return $total;
		}
	public function totalposnetbalance(){

		$sqlCC='SELECT sum(caja_chica.ingreso)-sum(caja_chica.egreso) AS "POSNET" FROM caja_chica where caja_chica.pago="POSNET"';
					$resultado=$this->db->query($sqlCC);
					$total=$resultado->fetch_assoc();
				    $total=$total['POSNET'];
				        
				        if(empty($total)){ 
				        $total=0.00;}

						return $total;
				}
	
	public function totalefectivo($caja){
		$sql="SELECT (SELECT (SUM(caja_chica.ingreso)) FROM caja_chica where caja_chica.pago='EFECTIVO' and caja_chica.caja=".$caja." and caja_chica.tipo='')-(SELECT(SUM(caja_chica.egreso)) FROM caja_chica where caja_chica.pago='EFECTIVO' and caja_chica.caja=".$caja.") as 'EFECTIVO'";
		$save=$this->db->query($sql);
		$total=$save->fetch_assoc();
		$total=$total['EFECTIVO'];
		return $total;
	}
	public function cajas(){
		$sql="select cajas.num_caja as 'caja',cajas.fecha_apertura as 'apertura',cajas.fecha_cierre AS 'cierre' ,(SELECT (SUM(caja_chica.ingreso)) FROM caja_chica where caja_chica.pago='POSNET' and caja_chica.caja=cajas.num_caja and caja_chica.tipo='')  AS 'VENTASPOSNET',(SELECT (SUM(caja_chica.ingreso)) FROM caja_chica where caja_chica.pago='EFECTIVO' and caja_chica.caja=cajas.num_caja and caja_chica.tipo='')  AS 'VENTASEFECTIVO',(SELECT (SUM(caja_chica.ingreso)) FROM caja_chica where caja_chica.pago='POSNET' and caja_chica.caja=cajas.num_caja and caja_chica.tipo='')-(SELECT(SUM(caja_chica.egreso)) FROM caja_chica where caja_chica.pago='POSNET' and caja_chica.caja=cajas.num_caja)  AS 'POSNET',(SELECT (SUM(caja_chica.ingreso)) FROM caja_chica where caja_chica.pago='EFECTIVO' and caja_chica.caja=cajas.num_caja and caja_chica.tipo='')-(SELECT(SUM(caja_chica.egreso)) FROM caja_chica where caja_chica.pago='EFECTIVO' and caja_chica.caja=cajas.num_caja)  AS 'EFECTIVO',SUM(caja_chica.egreso) AS 'EGRESO',(SELECT SUM(caja_chica.ingreso) FROM caja_chica WHERE caja_chica.pago='POSNET' and caja_chica.caja=cajas.num_caja  and caja_chica.tipo='')+(SELECT SUM(caja_chica.ingreso) from caja_chica WHERE caja_chica.pago='EFECTIVO' and caja_chica.caja=cajas.num_caja and caja_chica.tipo='') AS 'total' FROM cajas INNER JOIN caja_chica on cajas.num_caja=caja_chica.caja GROUP by cajas.num_caja ORDER BY cajas.fecha_apertura DESC";
		$resultado = $this->db->query($sql);
		while($filas=$resultado->fetch_assoc()){
			$cajas[]=$filas;
		}
		if(!empty($cajas)){ 

			return $cajas;
		}else{
			return false;
		}
	} 
	public function veregresos($caja){
		$sql="SELECT caja_chica.tipo as 'acreedor',caja_chica.egreso as 'monto', caja_chica.detalle as 'detalle',caja_chica.fecha as 'fecha' FROM caja_chica WHERE caja_chica.egreso>0 and caja_chica.caja=".$caja;
		$resultado=$this->db->query($sql);
		while($filas=$resultado->fetch_assoc()){
			$cajas[]=$filas;
		}
		if(!empty($cajas)){ 

			return $cajas;
		}else{
			return false;
		}
	}
	public function totalegresos($caja){
		$sql="SELECT SUM(caja_chica.egreso) as 'total' FROM caja_chica WHERE caja_chica.egreso>0 and caja_chica.caja=".$caja."";
		$resultado=$this->db->query($sql);
		$total=$resultado->fetch_assoc();
		$total=$total['total'];

		if($total==null){ 
			$total=0.00;}

			return $total;
		}
		public function obtenerfecha(){
			$sql="SELECT DATE_FORMAT(CURRENT_TIMESTAMP(), '%H:%i %d-%m-%Y') as 'fecha'";
			$resultado=$this->db->query($sql);
			$resultado=$resultado->fetch_assoc();
			$resultado=$resultado['fecha'];
			return $resultado;
		}
		public function verventas($fechainicio,$fechafin){

			$sql="SELECT productos.nombre as 'producto',ventas.cantidad as 'cantidad',productos.precio as 'precio',comandas.mesa as 'mesa',comandas.metodo_pago as 'pago',usuarios.nombre as 'mozo',productos.precio*ventas.cantidad as 'total', DATE_FORMAT(ventas.fecha,\"%H: %i hs %d-%m-%Y \") as 'fecha' FROM comandas INNER JOIN usuarios on usuarios.id=comandas.mozo INNER JOIN ventas ON ventas.comanda=comandas.num_comanda INNER JOIN productos on productos.codigo=ventas.producto WHERE ventas.fecha  BETWEEN ".$fechainicio." and ".$fechafin." ORDER BY ventas.fecha DESC;";
			$resultado = $this->db->query($sql);
			while($filas=$resultado->fetch_assoc()){
				$ventas[]=$filas;
			}
			
			return $ventas;


		}

		public function cajasmaximas($fechainicio="'2010-12-30 09:43:03'",$fechafin="CURRENT_TIMESTAMP"){
			$sql="select DATE_FORMAT(cajas.fecha_apertura,\"%H: %i hs %d-%m-%Y\") as 'apertura',DATE_FORMAT(cajas.fecha_cierre,\"%H: %i hs %d-%m-%Y\") AS 'cierre' ,(SELECT SUM(caja_chica.ingreso) FROM caja_chica WHERE caja_chica.detalle='POSNET' and caja_chica.caja=cajas.num_caja) as 'POSNET',(SELECT SUM(caja_chica.ingreso) from caja_chica WHERE caja_chica.detalle='EFECTIVO' and caja_chica.caja=cajas.num_caja) AS 'EFECTIVO',SUM(caja_chica.egreso) AS 'EGRESO',ifnull((SELECT SUM(caja_chica.ingreso) FROM caja_chica WHERE caja_chica.detalle='POSNET' and caja_chica.caja=cajas.num_caja),0)+ifnull((SELECT SUM(caja_chica.ingreso) from caja_chica WHERE caja_chica.detalle='EFECTIVO' and caja_chica.caja=cajas.num_caja),0)-ifnull((SUM(caja_chica.egreso)),0) AS 'total' FROM cajas INNER JOIN caja_chica on cajas.num_caja=caja_chica.caja  WHERE cajas.fecha_apertura BETWEEN ".$fechainicio." and ".$fechafin." GROUP BY cajas.num_caja ORDER BY total DESC LIMIT 5;";
			$resultado = $this->db->query($sql);
			
			while($filas=$resultado->fetch_assoc()){
				$cajas[]=$filas;
			}

			return $cajas;


		}
		public function cajaspormes(){
			$sql="SELECT month(cajas.fecha_apertura) as 'mes',year(cajas.fecha_apertura) as 'año', SUM(caja_chica.ingreso) as 'total' FROM cajas INNER JOIN caja_chica ON caja_chica.caja=cajas.num_caja GROUP BY mes,año ORDER BY total DESC";
			$resultado = $this->db->query($sql);
			while($filas=$resultado->fetch_assoc()){
				$ventas[]=$filas;
			}

			return $ventas;


		}
		public function cajasporaño(){
			$sql="SELECT year(cajas.fecha_apertura) as 'año', SUM(caja_chica.ingreso) as 'total' FROM cajas INNER JOIN caja_chica ON caja_chica.caja=cajas.num_caja GROUP BY año ORDER BY total DESC";
			$resultado = $this->db->query($sql);
			while($filas=$resultado->fetch_assoc()){
				$ventas[]=$filas;
			}

			return $ventas;


		}

		

	}