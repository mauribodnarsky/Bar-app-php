<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
header('content-type: application/json; charset=utf-8');
require_once '../config/db.php';
require_once '../models/producto.php';
require_once '../models/mesa.php';
require_once '../models/usuario.php';
require_once '../models/comanda.php';
require_once '../models/caja.php';
require_once '../utils/utils.php';
require_once '../models/cajachica.php';
require_once '../models/caja_grande.php';
require_once '../models/proveedor.php';

require_once  '../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
class cajacontroller{
  
  public $json; 
  public function __construct($objjson) {
    $this->json = $objjson;
    
  }

	public function index(){
    $_SESSION['editar']=false;

      $objcaja=new caja();
      $estado=$objcaja->verificarCaja();
      if($estado=='a'){
        $estadocaja="abierta";
      }else{
        $estadocaja="cerrada";

      }
      $objproveedor= new proveedor();
      $proveedores=$objproveedor->getAll();
      $objcajachica=new cajachica();
      $cajas=$objcajachica->cajas();
      $objmesa= new mesa();
      $mesas= $objmesa->obtenerMesas();
      $json=['mesas'=>$mesas,'cajas'=>$cajas];
      echo json_encode($json);
        }
        public function abrircaja(){
          $objmesa= new mesa();
          $mesas= $objmesa->obtenerMesas();
            $caja= new caja();
            $nro=$caja->seleccionarUltimaCaja();
            $nro=$nro+1;
            $estado='a';
            $caja->setEstado($estado);
            $caja->setNumCaja($nro);
            $guardar=$caja->abrircaja();
            $objcaja=new caja();
            $estado=$objcaja->verificarCaja();
            $json=['mesas'=>$mesas];
            echo json_encode($json);

          }

          public function cerrarcaja(){
             $objmesa= new mesa();
               $mesasabiertas=$objmesa->mesasabiertas();
               if ($mesasabiertas!=false) {
                foreach ($mesasabiertas as $ma) {
                 $id=$ma['numero_mesa'];
                 $mesanro=$id;
                 $objcomanda= new comanda();
                 $pago="EFECTIVO";

                $comanda=$objcomanda->seleccionarcomanda($id);
                $comanda=$comanda['comanda'];
                $objcomanda->ingresarpago($comanda,$pago);
                              $mozo=$objcomanda->obtenerMozo($comanda);

                $cerrar=$objmesa->cerrarMesa($mesanro);
                $mesas= $objmesa->obtenerMesas();
                $total=$objcomanda->calculartotal($comanda);
                $objcaja=new cajachica();

                $objcaja->setIngreso($total);
                $objcaja->setEgreso(0);
                $objcaja->setPago($pago);
                $objcaja->setTipo(NULL);
                $objcaja->setFecha("NULL");

                $nro=$objcaja->seleccionarUltimaCaja();
                $objcaja->setNumCaja($nro);
                $objcaja->guardarmovimiento();
                $fecha=$objcaja->obtenerfecha();
          $descuento=0.00;

                 $ticket= $objcomanda->generarfactura($id);
                  $_SESSION['editar']=false;
                  $nombre_impresora="Generic";
                  $connector= new WindowsPrintConnector($nombre_impresora);
                  $printer= new printer($connector);
                  $printer->setJustification(Printer::JUSTIFY_LEFT);
                  $printer->text("MOZO:".$mozo);
                  $printer->feed(1);
                  $printer->setJustification(Printer::JUSTIFY_LEFT);
                  $printer->text("FECHA:".$fecha);
                  $printer->feed(1);
                  $printer->setJustification(Printer::JUSTIFY_LEFT);
                  $printer->text("MESA:"." ".$id);
                  $printer->feed(1);
                  $printer->setJustification(Printer::JUSTIFY_LEFT);
                  $printer->text("CANTIDAD  ");
                  $printer->setJustification(Printer::JUSTIFY_CENTER);
                  $printer->text("PRODUCTO");
                  $printer->setJustification(Printer::JUSTIFY_RIGHT);
                  $printer->text(" PRECIO X/U");
                 $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->text(" TOTAL");
                $printer->feed(2);
                $total=0.00;
                foreach($ticket as $obj){
		
		IF($obj['cantidad']>0){
   $printer->feed(1);
                  $subtotal=$obj['precio']*$obj['cantidad'];
                  $total=$total+$obj['precio']*$obj['cantidad'];
                  $printer->setJustification(Printer::JUSTIFY_LEFT);
     floatval($subtotal);
                  $printer->text("  ".$obj['cantidad']."   ".$obj['producto']."  $".$obj['precio']."  $".$subtotal);
                        $printer->feed(1);

}
                }
                  $total=$total-$descuento;
                  floatval($total);
     $printer->feed(1);     

  $printer->setJustification(Printer::JUSTIFY_RIGHT); 
                $printer->text("DESCUENTO: $ ".$descuento);
$printer->feed(1);     
                $printer->text("TOTAL:$ ".$total);
$printer->feed(2);
                  $printer->setJustification(Printer::JUSTIFY_RIGHT);
                  $printer->text("Muchas gracias por su compra!");
 
                $printer->feed(2);


                $printer->pulse();
                $printer->cut();
$printer->feed(1);
                $printer->close();
               }
              };

                $objcajagrandeuno= new caja_grande();
                $objcajachica= new cajachica();
                $nro=$objcajachica->seleccionarUltimaCaja();
                $efectivo=$objcajachica->totalefectivo($nro);
        $egresos=$objcajachica->veregresos($nro);

                $detalle="CAJA";
                $null=0;
            
               
              $objcajagrandeuno->setPago("EFECTIVO"); 
              $objcajagrandeuno->setIngreso($efectivo);
              $objcajagrandeuno->setDetalle("EFECTIVO"); 
              $objcajagrandeuno->setEgreso($null); 
              $objcajagrandeuno->guardarmovimiento();
              $caja= new caja();
              $nro=$caja->seleccionarUltimaCaja();
              $guardar=$caja->cerrarCaja($nro);
              $json=['caja'=>"cajacerrada"];
              echo json_encode($json);
}
public function detalleventa(){
  $objproveedor= new proveedor();
  $proveedores=$objproveedor->getAll();
  $objcajachica= new cajachica();
  $fechainicio="'".$this->json->apertura."'";
  $fechafin=$objcajachica->obtenerfecha();
  $caja=$this->json->caja;
  if (!empty($this->json->cierre)) {
    $fechafin="'".$this->json->cierre."'";
  }else{
    $fechafin="CURRENT_TIMESTAMP";
  }
  $fechainicio="'".$this->json->apertura."'";
  $detalleventa=$objcajachica->verventas($fechainicio,$fechafin);
 
  $json=['detalleventa'=>$detalleventa];
  echo json_encode($json);
  
}
public function egresos(){
  $objproveedor= new proveedor();
  $proveedores=$objproveedor->getAll();
  $objcajachica= new cajachica();
  $fechainicio="'".$this->json->apertura."'";
  $fechafin=$objcajachica->obtenerfecha();
  $caja=$this->json->caja;
  if (!empty($this->json->cierre)) {
    $fechafin="'".$this->json->cierre."'";
  }else{
    $fechafin="CURRENT_TIMESTAMP";
  }
  $fechainicio="'".$this->json->apertura."'";

  $egresos=$objcajachica->veregresos($caja);
 
  $json=['egresos'=>$egresos];
  echo json_encode($json);
  
}
            
            public function datosmozos(){
                $objproveedor= new proveedor();
                $proveedores=$objproveedor->getAll();
                $objcajachica= new cajachica();
                $fechainicio="'".$this->json->apertura."'";
                $fechafin=$objcajachica->obtenerfecha();
                $caja=$this->json->caja;
                if (!empty($this->json->cierre)) {
                  $fechafin="'".$this->json->cierre."'";
                }else{
                  $fechafin="CURRENT_TIMESTAMP";
                }
                $fechainicio="'".$this->json->apertura."'";
                $datosmozos=$objcajachica->datosmozos($fechainicio,$fechafin);
               
                $json=['datosmozos'=>$datosmozos];
                echo json_encode($json);
                
              }
              public function guardarmovimientocajachica(){
               if (isAdmin()==true or isCajero()==true) {
                $objcajachica=new cajachica();
                $acreedor=$_POST['acreedor'];
                $detalle=$_POST['detalle'];
                $ingreso=$_POST['ingreso'];
                $egreso=$_POST['egreso'];
                $movimiento=$_POST['tipo'];
                $cero="0.00";
                  $objcajachica->setTipo($acreedor);
                  $objcajachica->setFecha("CURRENT_TIMESTAMP()");

                $nro=$objcajachica->seleccionarUltimaCaja();
                $objcajachica->setNumCaja($nro);
                $objcajachica->setDetalle($detalle);
                  $objcajachica->setIngreso($ingreso);  
                  $objcajachica->setEgreso($egreso);  
                 $objcajachica->setPago($movimiento);
                }
                $objcajachica->guardarmovimiento();
                $objcaja=new caja();
                $estado=$objcaja->verificarCaja();
                if($estado=='a'){
                  $estadocaja="abierta";
                     $objproveedor= new proveedor();
                  $proveedores=$objproveedor->getAll();
               
                }else{
                  $estadocaja="cerrada";
                  $objproveedor= new proveedor();
                  $proveedores=$objproveedor->getAll();
                }
              
              $cajas=$objcajachica->cajas();

              if (isAdmin()) {
                require_once 'views/administrador/caja.php';
}               if (isCajero()) {
                require_once 'views/cajero/caja.php';
}              }

            public function guardarmovimientocajagrande(){
             if (isAdmin()==true) {

               $objcajagrandeuno=new caja_grande();
                $acreedor=$_POST['acreedor'];
                $detalle=$_POST['detalle'];
                $egreso=$_POST['egreso'];
                $ingreso=$_POST['ingreso'];
                $movimiento=$_POST['tipo'];
                $cero="0.00";

              $objcajagrandeuno->setIngreso($ingreso);
              $objcajagrandeuno->setDetalle($detalle);

              $objcajagrandeuno->setTipo($acreedor); 
              $objcajagrandeuno->setEgreso($egreso); 
             
                $objcajagrandeuno->setPago($movimiento);
              }
              $objcajagrandeuno->guardarmovimiento();
              $movimientos=$objcajagrandeuno->movimientos();
              $objcajachica=new cajachica();
              $totalefectivo=$objcajagrandeuno->totalefectivo();
              $totalposnet=$objcajagrandeuno->totalposnet();
              $totalegreso=$objcajagrandeuno->totalegreso();
              $saldo=$totalposnet+$totalefectivo-$totalegreso;
              $objproveedor= new proveedor();
              $proveedores=$objproveedor->getAll();

              require_once 'views/administrador/cajagrande.php';
            }
            public function vercajagrande(){
              if (isAdmin()==true) {

                $objcaja=new caja();
                $estado=$objcaja->verificarCaja();
                if($estado=='a'){
                  $estadocaja="abierta";
                }else{
                  $estadocaja="cerrada";
                }
                $objcajagrandeuno= new caja_grande();
                if(isset($_POST['proveedor'])){
                  $proveedor=$_POST['proveedor'];
                  $detalleproveedor=$objcajagrandeuno->detalleproveedor($proveedor);
                }else{
                  if(isset($_POST['fechainicio']) and (isset($_POST['fechafin']))){
                    $fechafin=$_POST['fechafin'];
                    $fechainicio=$_POST['fechainicio'];
                    $movimientos=$objcajagrandeuno->movimientosfiltrados($fechainicio,$fechafin);
                    if($movimientos==false){
                      $movimientos=$objcajagrandeuno->movimientos();
                      $mensaje="<h5 style=\"color:red;\">Error al consultar las fechas</h5>";
                    }
                  }else{
                    $movimientos=$objcajagrandeuno->movimientos();
                  }
                }

                $objcajachica=new cajachica();
                $totalposnet=0.00;
                $totalefectivo=$objcajagrandeuno->totalefectivo();
                $totalposnet=$objcajagrandeuno->totalposnet();

                $totalegreso=$objcajagrandeuno->totalegreso();
                $saldo=$totalposnet+$totalefectivo-$totalegreso;
                $objproveedor= new proveedor();
                $proveedores=$objproveedor->getAll();

                require_once 'views/administrador/cajagrande.php';
              }
            }
            public function estadisticassaldos(){
              if (isAdmin()==true) {

                $objcaja=new caja();
                $objcajagrandeuno= new caja_grande();
                if(isset($_POST['proveedor'])){
                  $proveedor=$_POST['proveedor'];
                  $detalleproveedor=$objcajagrandeuno->detalleproveedor($proveedor);
                }

                if(isset($_POST['acreedor']) and isset($_POST['fechainicio']) and isset($_POST['fechafin'])){
                  $acreedor=$_POST['acreedor'];
                  $fechafin=$_POST['fechafin'];
                  $fechainicio=$_POST['fechainicio'];
                  $detalleproveedor=$objcajagrandeuno->detalleproveedorporfecha($fechainicio,$fechafin,$acreedor);
                  if ($detalleproveedor==false) {
                    $error="NO EXISTEN DATOS ENTRE LAS FECHAS INTRODUCIDAS";
                  }
                }
                $totalefectivo=$objcajagrandeuno->totalefectivo();
                $totalposnet=$objcajagrandeuno->totalposnet();
                $totalotro=$objcajagrandeuno->totalotro();
                $totalegreso=$objcajagrandeuno->totalegreso();
                $saldo=$totalotro+$totalposnet+$totalefectivo;
                $saldo=$saldo-$totalegreso;
                $objproveedor= new proveedor();
                $proveedores=$objproveedor->getAll();

                foreach ($proveedores as $proveedor) {
                  $nombre= $proveedor['nombre'];
                  $cuentas[]=$objcajagrandeuno->cuentasproveedores($nombre);

                }


                require_once 'views/administrador/estadisticassueldos.php';

              }else{require_once 'views/usuario/inicio.php';}
            }
          }
          $objrecibido = json_decode(file_get_contents("php://input"));                                                                                                                                                                                       
          $accion=$objrecibido->accion;
         $objetocaja= new CajaController($objrecibido);
         
          $objetocaja->$accion();	
