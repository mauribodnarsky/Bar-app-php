<?php
require_once 'models/proveedor.php';
require_once 'models/caja_grande.php';

class proveedorcontroller{

public function index(){
	       $objcajagrandeuno= new caja_grande();
     $objproveedor= new proveedor();
      $proveedores=$objproveedor->getAll();
      foreach ($proveedores as $proveedor) {
        $nombre= $proveedor['nombre'];
        $cuentas[]=$objcajagrandeuno->cuentasproveedores($nombre);

      }

	require 'views/administrador/proveedores.php';
}  
 public function guardarproveedor(){
   if(isset($_POST)){
     $nombre = $_POST['nombre'];
     $proveedor = new proveedor();
     $proveedor->setNombre($nombre);
     $proveedor->save();				
   }
   require_once 'views/administrador/productos.php';
 }
 

}