<?php
				require_once '../models/caja.php';
				require_once ('../config/db.php');
				class caja_grande extends caja{
					private $ingreso;
					private $egreso;
					private $detalle;
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

			

					

	
					function setIngreso($ingreso) {
						$this->ingreso = $ingreso;
					}

					

					function setEgreso($egreso) {
						$this->egreso = $egreso;
					}
                    function setDetalle($detalle){
                    	$this->detalle=$detalle;
                    }


                    function setTipo($tipo){
                    	$this->tipo=	$tipo;
                    }

				public function guardarmovimiento(){
					$fecha=$this->obtenerlafecha();
		
						$sql = "INSERT INTO caja_grande VALUES({$this->getIngreso()},{$this->getEgreso()},'{$this->getDetalle()}','".$fecha."','{$this->getTipo()}','{$this->getPago()}'); ";
					$this->backup($sql);
		
						$save = $this->db->query($sql);

						
						$result = false;
						if($save){
							$result = true;
						}
						return $result;
					}
					public function totalposnet(){
					$sqlCC='SELECT (sum(caja_grande.ingreso)-(sum(caja_grande.egreso))) as POSNET FROM caja_grande where caja_grande.pago="POSNET"';
					$resultado=$this->db->query($sqlCC);
					$total=$resultado->fetch_assoc();
				    $total=$total['POSNET'];
				        
				        if(empty($total)){ 
				        $total=0.00;}

						return $total;
				}
				public function totalefectivo(){
					$sql='SELECT SUM(caja_grande.ingreso) AS "EFECTIVO" FROM caja_grande where caja_grande.detalle="EFECTIVO" ';
					$resultado=$this->db->query($sql);
					$total=$resultado->fetch_assoc();
				    $total=$total['EFECTIVO'];
				        
				        if(empty($total)){ 
				        $total=0.00;}

						return $total;
				}
				public function totalegreso(){
					$sql='SELECT SUM(caja_grande.egreso) AS "EGRESO" FROM caja_grande; ';
					$resultado=$this->db->query($sql);
					$total=$resultado->fetch_assoc();
				    $total=$total['EGRESO'];
				        
				        if(empty($total)){ 
				        $total=0.00;}

						return $total;
				}
				public function totalotro(){
					$sql='SELECT SUM(caja_grande.ingreso)AS "OTRO" FROM caja_grande where caja_grande.tipo="OTRO" ';
					$resultado=$this->db->query($sql);
					$total=$resultado->fetch_assoc();
				    $total=$total['OTRO'];
				        
				        if(empty($total)){ 
				        $total=0.00;}

						return $total;
				}
				public function detalleproveedor($proveedor){
					$querycajagrande="SELECT caja_grande.tipo AS 'proveedor',DATE_FORMAT(caja_grande.fecha,\"%H: %i hs %d-%m-%Y\") as 'fecha',caja_grande.ingreso as 'ingresos',caja_grande.egreso as 'egresos',caja_grande.detalle FROM caja_grande WHERE caja_grande.tipo='".$proveedor."' ORDER BY caja_grande.fecha DESC;";

					$resultadoCG = $this->db->query($querycajagrande);

					  if(!empty($resultadoCG)){ 

					while($fila=$resultadoCG->fetch_assoc()){
				        if(!empty($fila)){ 
					            $cuentas[]=$fila;
					        }
				        }}  

				    $querycajachica="SELECT caja_chica.tipo AS 'proveedor',DATE_FORMAT(caja_chica.fecha,\"%H: %i hs %d-%m-%Y\") as 'fecha',caja_chica.ingreso as 'ingresos',caja_chica.egreso as 'egresos',caja_chica.detalle FROM caja_chica WHERE caja_chica.tipo='".$proveedor."' ORDER BY caja_chica.fecha DESC;";
					$resultadoCC = $this->db->query($querycajachica);
					  if(!empty($resultadoCC)){ 

					while($filas=$resultadoCC->fetch_assoc()){
				        if(!empty($filas)){ 
					            $cuentas[]=$filas;
					        }
				        }}    
				        if(!empty($cuentas)){ 

						return $cuentas;
				}else{
					return false;
				}
				}
				public function detalleproveedorporfecha($fechainicio,$fechafin,$proveedor){
					$querycajagrande="SELECT caja_grande.tipo AS 'proveedor',DATE_FORMAT(caja_grande.fecha,\"%H: %i hs %d-%m-%Y\") as 'fecha',caja_grande.ingreso as 'ingresos',caja_grande.egreso as 'egresos',caja_grande.detalle FROM caja_grande WHERE caja_grande.tipo='".$proveedor."'  and caja_grande.fecha  BETWEEN '".$fechainicio."'  and '".$fechafin."'  ORDER BY caja_grande.fecha DESC;";

					$resultadoCG = $this->db->query($querycajagrande);

					  if(!empty($resultadoCG)){ 

					while($fila=$resultadoCG->fetch_assoc()){
				        if(!empty($fila)){ 
					            $cuentas[]=$fila;
					        }
				        }}  

				    $querycajachica="SELECT caja_chica.tipo AS 'proveedor',DATE_FORMAT(caja_chica.fecha,\"%H: %i hs %d-%m-%Y\") as 'fecha',caja_chica.ingreso as 'ingresos',caja_chica.egreso as 'egresos',caja_chica.detalle FROM caja_chica WHERE caja_chica.tipo='".$proveedor."' and caja_chica.fecha  BETWEEN '".$fechainicio."'  and '".$fechafin."'  ORDER BY caja_chica.fecha DESC;";
					$resultadoCC = $this->db->query($querycajachica);
									                       

					  if(!empty($resultadoCC)){ 

					while($filas=$resultadoCC->fetch_assoc()){
				        if(!empty($filas)){ 
					            $cuentas[]=$filas;
					        }
				        }}    
				        if(!empty($cuentas)){ 

						return $cuentas;
				}else{
					return false;
				}
				}
				
				public function cuentasproveedores($nombre){
					$cajaGrandeIngreso= 'SELECT SUM(caja_grande.ingreso) as "ingresos" FROM caja_grande WHERE caja_grande.tipo="'.$nombre.'"';
					$cajaChicaIngreso= 'SELECT SUM(caja_chica.ingreso) as "ingresos" FROM caja_chica WHERE caja_chica.tipo="'.$nombre.'"';
					$cajaGrandeEgreso= 'SELECT SUM(caja_grande.egreso) as "egresos" FROM caja_grande WHERE caja_grande.tipo="'.$nombre.'"';
					$cajaChicaEgreso= 'SELECT SUM(caja_chica.egreso) as "egresos" FROM caja_chica WHERE caja_chica.tipo="'.$nombre.'"';
					
					$queryGrandeIngreso = $this->db->query($cajaGrandeIngreso);
					$queryGrandeEgreso = $this->db->query($cajaGrandeEgreso);
					$queryChicaIngreso = $this->db->query($cajaChicaIngreso);
					$queryChicaEgreso = $this->db->query($cajaChicaEgreso);
					

					// nombre_proveedor, sumar ingresos de cajas, sumar egresos de cajas, total

					$IngresoCG=$queryGrandeIngreso->fetch_assoc();
				     $IngresoCG=$IngresoCG['ingresos'];
				    $IngresoCC=$queryChicaIngreso->fetch_assoc();
				     $IngresoCC=$IngresoCC['ingresos'];
				    
				    $EgresoCG=$queryGrandeEgreso->fetch_assoc();
				     $EgresoCG=$EgresoCG['egresos'];
				    $EgresoCC=$queryChicaEgreso->fetch_assoc();
				     $EgresoCC=$EgresoCC['egresos'];

				    $egresos= $EgresoCC+$EgresoCG;
				    $ingresos= $IngresoCC+$IngresoCG;

				    $total=$ingresos-$egresos;
				    $resultado=array("PROVEEDOR"=>$nombre,"INGRESOS"=>$ingresos,"EGRESOS"=>$egresos,"TOTAL"=>$total);
				    return $resultado;
				      
				}
				public function movimientos(){
					$sql= "SELECT * FROM caja_grande ORDER BY caja_grande.fecha ASC limit 30";
						$resultado = $this->db->query($sql);

					while($filas=$resultado->fetch_assoc()){
				            $cuentas[]=$filas;
				        }
				        if(!empty($cuentas)){ 

						return $cuentas;
				}else{
					return false;
				}
				}					
				public function movimientosfiltrados($fechainicio,$fechafin){
					$sql= "SELECT * FROM caja_grande where caja_grande.fecha between '".$fechainicio."' and '".$fechafin."'  ORDER BY caja_grande.fecha ASC";
						$resultado = $this->db->query($sql);

					while($filas=$resultado->fetch_assoc()){
				            $cuentas[]=$filas;
				        }
				        if(!empty($cuentas)){ 

						return $cuentas;
				}else{
					return false;
				}
				}								
				}