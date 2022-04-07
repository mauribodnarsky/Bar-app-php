				<?php
				require_once ('../config/db.php');
				class Producto{
					private $id;
					private $nombre;					
					private $precio;				
					private $codigo;
					private $categoria;
					public $db;
					
					public function __construct() {
						$this->db = Database::connect();
					}
					
					

					function getNombre() {
						return $this->nombre;
					}
				  

					function getPrecio() {
						return $this->precio;
					}
                    function getCodigo() {
						return $this->codigo;
					}
					function getCategoria() {
						return $this->categoria;
					}

					

					function setNombre($nombre) {
						$this->nombre = $this->db->real_escape_string($nombre);
					}

					function setPrecio($precio) {
						$this->precio = $this->db->real_escape_string($precio);
					}
					

					function setCodigo($codigo) {
						$this->codigo = $this->db->real_escape_string($codigo);
					}
					function setCategoria($categoria) {
						$this->categoria = $this->db->real_escape_string($categoria);
					}
public function backup($sql){
	$archivo=fopen("C:\wamp64\www\LaEstancia\backup\backup.sql", 'a');
	fwrite($archivo, "$sql"); 
fclose($archivo);
return 0;}
public  function obtenerlafecha(){
	$fecha=$this->db->query("SELECT CURRENT_TIMESTAMP AS 'FECHA'");
					 $fecha= $fecha->fetch_assoc();
                    $fecha= $fecha['FECHA'];
                    return $fecha;
}
				

					public function getAll(){
						$productos=array();
						$productoss = $this->db->query("SELECT * FROM productos order by nombre asc limit 10;");
						while($filas=$productoss->fetch_assoc()){
				            $productos[]=$filas;
				        }

						return $productos;
					}
						public function productosvendidos(){
						$productos=array();
						$productoss = $this->db->query("SELECT * FROM productos WHERE productos.codigo in (SELECT ventas.producto FROM ventas) order by nombre asc ;");
						while($filas=$productoss->fetch_assoc()){
				            $productos[]=$filas;
				        }

						return $productos;
					}
					
					
					public function save(){
						$sql = "INSERT INTO productos VALUES('{$this->getNombre()}',{$this->getPrecio()}, '{$this->getCodigo()}','SIN CATEGORIA'); ";
											$this->backup($sql);

						$save = $this->db->query($sql);
						
						
						$result = false;
						if($save){
							$result = true;
						}
						return $result;
					}
					public function buscar($busqueda){
						$sql="SELECT * FROM productos WHERE productos.nombre LIKE'%".$busqueda."%' OR productos.codigo LIKE '%".$busqueda."%' order by nombre asc;";
						$productoss = $this->db->query($sql);
						if ($productoss->num_rows!=0) {
							
					
						while($filas=$productoss->fetch_assoc()){
				            $productos[]=$filas;
				        }

						return $productos;
					}else{
						return 0;
					}}
					public function obteneruno($id){
						$sql = "SELECT * FROM productos WHERE codigo=".$id.";";
						$resultado = $this->db->query($sql);
						$result= $resultado->fetch_assoc();
						return $result;
					}
					public function editar($id){
						$sql = "UPDATE productos SET nombre='{$this->getNombre()}',precio= {$this->getPrecio()},codigo= {$this->getCodigo()} where codigo=".$id.";";
						$referencias="UPDATE ventas SET producto= {$this->getCodigo()} where producto=".$id." ; ";
						$ejecutar = $this->db->query($referencias);
					$this->backup($sql);
					$this->backup($referencias);

						$save = $this->db->query($sql);
						$result = false;
						if($save){
							$result = true;
						}
						return $result;
					}
						public function aumentarprecio($porcentaje,$categoria){
						$sql = "UPDATE productos SET precio=precio+((precio *".$porcentaje.")/100) where categoria='".$categoria."' ; ";
						$save = $this->db->query($sql);
											$this->backup($sql);

						$result = false;
						if($save){
							$result = true;
						}
						return $result;
					}
					
					public function eliminar($id){
						$sql = "DELETE FROM productos WHERE codigo='".$id."' ; ";
						$delete = $this->db->query($sql);
											$this->backup($sql);

						$result = false;
						if($delete){
							$result = true;
						}
						return $result;
					}

                    public function eliminarceros(){
						$sql = "DELETE FROM productos WHERE precio=0;";
						$delete = $this->db->query($sql);
						
						$result = false;
						if($delete){
							$result = true;
						}
						return $result;
					}
				 public function obtenercodigos($busqueda){
						$sql="SELECT * FROM productos WHERE productos.codigo=".$busqueda.";";
						$productoss = $this->db->query($sql);
						$productos=[];
						if ($productoss !=null) {
						while($filas=$productoss->fetch_assoc()){
				            $productos[]=$filas;
				        }

						return $productos;	}else{
							return false;
						}}
                public function buscarcomanda($busqueda){
						$sql="SELECT * FROM productos WHERE productos.nombre LIKE'%".$busqueda."%' OR productos.codigo LIKE '%".$busqueda."%' limit 5;";
						$productoss = $this->db->query($sql);
						if ($productoss->num_rows!=0) {
							
					
						while($filas=$productoss->fetch_assoc()){
				            $productos[]=$filas;
				        }

						return $productos;
					}else{
						return 0;
					}}
					public function productosmasvendidos(){
						$sql="SELECT productos.nombre as 'producto', SUM(ventas.cantidad) as 'cantidad' FROM ventas INNER JOIN productos ON productos.codigo=ventas.producto GROUP BY productos.codigo ORDER BY cantidad DESC";
							$productoss = $this->db->query($sql);
						if ($productoss->num_rows!=0) {
							
					
						while($filas=$productoss->fetch_assoc()){
				            $productos[]=$filas;
				        }

						return $productos;
					}else{
						return 0;
					}}
				public function productosmasvendidosporfecha($fechainicio,$fechafin,$codigo=""){
						if($fechainicio=="" and $fechafin==""){
							$fechainicio="'2010-12-30 09:43:03'";
							$fechafin="CURRENT_TIMESTAMP";
					}
						$sql="SELECT productos.nombre as 'producto', SUM(ventas.cantidad) as 'cantidad' FROM ventas INNER JOIN productos ON productos.codigo=ventas.producto INNER JOIN comandas ON comandas.num_comanda=ventas.comanda WHERE comandas.fecha BETWEEN ".$fechainicio." AND ".$fechafin;
						if($codigo!=""){
						$sql=$sql." AND productos.codigo='".$codigo."'";
					}
					$sql=$sql." GROUP BY productos.codigo ORDER BY cantidad DESC";
							$productoss = $this->db->query($sql);
						while($filas=$productoss->fetch_assoc()){
				            $productos[]=$filas;
				        }

				        
						return $productos;
					}
					
				}
					