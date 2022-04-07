<?php
require_once ('../config/db.php');

class Venta{
	private $comanda;
	private $producto;
	private $cantidad;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	
	function getComanda() {
		return $this->comanda;
	}



	function getProducto() {
		return $this->producto;
	}
	function getCantidad() {
		return $this->Cantidad;

	}

	
	function setComanda($comanda) {
		$this->comanda = $this->db->real_escape_string($comanda);
	}
function setCantidad($cantidad) {
		$this->cantidad = $this->db->real_escape_string($cantidad);
	}
	

	function setProducto($producto) {
		$this->producto = $this->db->real_escape_string($producto);
	}


	public function save(){
		$sql = "INSERT INTO ventas VALUES(NULL, {$this->getProducto()},{$this->getCantidad()},{$this->getComanda()},CURRENT_TIMESTAMP()); ";
		var_dump($sql);die;
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	
	
	
	
}