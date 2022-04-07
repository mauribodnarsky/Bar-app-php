<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
header('content-type: application/json; charset=utf-8');
require_once '../config/db.php';

require_once '../models/usuario.php';
require_once '../models/mesa.php';
require_once '../models/producto.php';
require_once '../models/caja.php';
require_once '../models/cajachica.php';
require_once '../models/proveedor.php';
require_once '../utils/utils.php';
class UsuarioController{
	
public $json; 
public function __construct($objjson) {
	$this->json = $objjson;
	
}

public function crearmozo(){
		$nombre =$this->json->nombre;
		$rol="mozo";

			$usuario = new Usuario();
			$usuario->setNombre($nombre);
			$usuario->setPassword("sd21aasfeadfdss");
			$usuario->setrol($rol);
			$save = $usuario->save();
			$mozos= $usuario->obtenermozos();
			$json=['mozos'=>$mozos];
			echo json_encode($json);
		
}
	 public function login(){
		
		if(isset($this->json->usuario) and isset($this->json->password)){
			// Identificar al usuario
			// Consulta a la base de datos
			$usuario = new Usuario();
			$usuario->setNombre($this->json->usuario);
			$usuario->setPassword($this->json->password);

			$identity = $usuario->login();

			if($identity && is_object($identity)){
				$_SESSION['identity'] = $identity;

				if($identity->rol == 'admin'){
					$objmesa= new mesa();
					$mesas= $objmesa->obtenerMesas();
					$objcaja=new caja();
					$estado=$objcaja->verificarCaja();
					if($estado=='a'){
						$estadocaja="abierta";
					}else{
						$estadocaja="cerrada";
					}
					$objusuario= new usuario();
					$mozos= $objusuario->obtenermozos();
					$json=['mozos'=>$mozos,'estadocaja'=>$estadocaja,'mesas'=>$mesas,'identity'=>$identity];
					echo json_encode($json);
				}
				elseif($identity->rol == 'cajero'){
					$objmesa= new mesa();
					$mesas= $objmesa->obtenerMesas();
					$_SESSION['cajero'] = true;
					$objcaja=new caja();
					$estado=$objcaja->verificarCaja();
					if($estado=='a'){
						$estadocaja="abierta";
					}else{
						$estadocaja="cerrada";
					}
					$json=['estadocaja'=>$estadocaja,'mesas'=>$mesas,'identity'=>$identity];
					echo json_encode($json);
				}
				elseif($identity->rol == 'mozo'){
					$objmesa= new mesa();
					$mesas= $objmesa->obtenerMesas();
					$_SESSION['mozo'] = true;
						$objcaja=new caja();
					$estado=$objcaja->verificarCaja();
					if($estado=='a'){
						$estadocaja="abierta";
					}
					$json=['estadocaja'=>$estadocaja,'mesas'=>$mesas,'identity'=>$identity];
					echo json_encode($json);
				}

			}else{
				$json=['identity'=>$identity];
					echo json_encode($json);
			}

		}else{	$json=['identity'=>"false"];
			echo json_encode($json);
		}
	}
	public function logout(){
			
		if(isset($_SESSION['identity'])){
			if($this->json->nombre==$_SESSION['identity']['nombre'])
				{
			unset($_SESSION['identity']);
		}
	}
	$json=['estado'=>"sesion cerrada"];
					echo json_encode($json);


	}
	public function agregarMesa(){

				$objmesa= new mesa();
				$numero= $objmesa->generarNumeroMesa();
				$numero=$numero['numero'] +1;
				$objmesa->crearMesa($numero);
				$mesas= $objmesa->obtenerMesas();

				$json=['mesas'=>$mesas];
				echo json_encode($json);			

		
	}
}
	$objrecibido = json_decode(file_get_contents("php://input"));
	$accion=$objrecibido->accion;
		$objetousuario= new UsuarioController($objrecibido);
	
		$objetousuario->$accion();																			
 