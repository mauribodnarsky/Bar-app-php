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
require_once '../utils/utils.php';
require_once '../models/cajachica.php';
require_once '../models/proveedor.php';
require_once '../config/db.php';
require_once  '../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ComandaController{


  public $json; 
  public function __construct($objjson) {
    $this->json = $objjson;
    
  }
  
public function buscarproducto(){
  $producto= new producto();
  $objmesa= new mesa();

 if ($this->json->texto != "") {
  $busca= explode(' ', $this->json->texto);
   $buscar="";

   foreach ($busca as $letra) {
     $buscar= $buscar.$letra."%";
   }
  $productos= $producto->buscarcomanda($buscar);
  echo json_encode($productos);
    
         
   
  }
  else{
  $productos= $producto->getAll();
  echo json_encode($productos);


  }
}
   
  
  public function seleccionarmesa(){
      $objmesa= new mesa();
      $mesas= $objmesa->obtenerMesas();
        $mesanro=$this->json->mesa;
    $descuento=0;
        $mesa_seleccionada= $objmesa->seleccionarMesa($mesanro);
        if($mesa_seleccionada['estado']==0){
          $objcaja=new cajachica();
          $objcomanda=new comanda();
          $comanda= $objcomanda->seleccionarcomanda($mesanro);
          $moz= $objmesa->obtenerMozo($mesanro);
          $factura= $objcomanda->generarfactura($mesanro);
          $comanda= $comanda['comanda'];
          $descuento=0.00;
          if ($objcaja->ObtenerDescuento($comanda) !=false) {
            $descuento=$objcaja->ObtenerDescuento($comanda);
          }        
        }
      
        $mesanro=$this->json->mesa;
        $mesa_seleccionada= $objmesa->seleccionarMesa($mesanro);
        $moz= $objmesa->obtenerMozo($mesanro);
        if($mesa_seleccionada['estado']==0){
          $objcaja=new cajachica();
          $objcomanda=new comanda();
          $comanda= $objcomanda->seleccionarcomanda($mesanro);
          $factura= $objcomanda->generarfactura($mesanro);

          $cliente=$objcomanda->seleccionarcliente($mesanro);
          $comanda= $comanda['comanda'];
          $objusuario= new usuario();
          $mozos= $objusuario->obtenermozos();
    
          
          
        
        }
    
        $objcaja=new caja();
        $estado=$objcaja->verificarCaja();
        if($estado=='a'){

            $json=['comanda'=>$comanda,'factura'=>$factura,'mesas'=>$mesas,'mozos'=>$mozos,'mozo'=>$moz,'descuento'=>$descuento];
            echo json_encode($json);
          
      }
     
        
      
    }
      public function aplicardescuento(){
        $objmesa=new mesa();
          $monto=$this->json->total;
          $porcentaje=$this->json->descuento;
          $mesa=$this->json->mesa;
          
          $descuento= ($porcentaje*$monto)/100;
          $descuento= number_format($descuento,2);
          $objcaja= new cajachica();
          $cero=0.00;
          $mesanro=$mesa;
          $objcomanda=new comanda();
          $comanda= $objcomanda->seleccionarcomanda($mesanro);
          $comanda= $comanda['comanda'];
          $detalle="DESCUENTO DE ".$porcentaje."% MESA:".$mesa." ";
          $objcaja->setEgreso($descuento);
          $objcaja->setIngreso($cero);
          $objcaja->setDetalle($detalle);
          $nro=$objcaja->seleccionarUltimaCaja();
          $moz= $objmesa->obtenerMozo($mesanro);
          $objcaja->setNumCaja($nro);
          $objcaja->guardardescuento($comanda);
          if ($objcaja->ObtenerDescuento($comanda) !=false) {
            $descuento=$objcaja->ObtenerDescuento($comanda);
          }
          $factura= $objcomanda->generarfactura($mesa);
          $mesa_seleccionada=$objmesa->seleccionarmesa($mesa);

        

        $mesas=$objmesa->obtenerMesas();
        $objcaja=new caja();
        $estado=$objcaja->verificarCaja();
        if($estado=='a'){
          $estadocaja="abierta";
        }else{
          $estadocaja="cerrada";

        }

        $json=['factura'=>$factura,'mesas'=>$mesas,'descuento'=>$descuento];
            echo json_encode($json);
      }

      public function editarfactura(){
        $objmesa= new mesa();
        $mesas= $objmesa->obtenerMesas();
        $objcaja=new cajachica();

          $mesanro=$this->json->mesa;
          $mesa_seleccionada= $objmesa->seleccionarMesa($mesanro);

          $objusuario= new usuario();
          $objcomanda=new comanda();
          $comanda= $objcomanda->seleccionarcomanda($mesanro);
          $comanda= $comanda['comanda'];

          if($mesa_seleccionada['estado']==0){
            $factura= $objcomanda->generarfactura($mesanro);
          }
          $descuento=0.00;
          if ($objcaja->ObtenerDescuento($comanda) !=false) {
            $descuento=$objcaja->ObtenerDescuento($comanda);
          }
          $json=['comanda'=>$comanda,'factura'=>$factura,'mesas'=>$mesas,'descuento'=>$descuento];
          echo json_encode($json);
        
          
        }
        public function editarventa(){
          $objmesa= new mesa();
          $mesas= $objmesa->obtenerMesas();
          $objcomanda=new comanda();

   

            $mesanro=$this->json->mesa;
            $numcomanda=$this->json->comanda;
            $cantidad=$this->json->cantidad;
            $fecha=$this->json->fecha;
            $mesa_seleccionada= $objmesa->seleccionarMesa($mesanro);
            $moz= $objmesa->obtenerMozo($mesanro);

            $comanda= $objcomanda->seleccionarcomanda($mesanro);
            $comanda= $comanda['comanda'];
            $objusuario= new usuario();
            $mozos= $objusuario->obtenermozos();
            $resul=$objcomanda->editarventa($numcomanda,$cantidad,$fecha);
            if($mesa_seleccionada['estado']==0){
              $objcaja=new cajachica();
              $comanda= $objcomanda->seleccionarcomanda($mesanro);
              $comanda= $comanda['comanda'];
              $descuento=$objcaja->ObtenerDescuento($comanda);
              $factura= $objcomanda->generarfactura($mesanro);
            }
            $descuento=0.00;
            if ($objcaja->ObtenerDescuento($comanda) !=false) {
              $descuento=$objcaja->ObtenerDescuento($comanda);
            }
            $objcaja=new caja();
            $estado=$objcaja->verificarCaja();
            if($estado=='a'){
              $estadocaja="abierta";
            }else{
              $estadocaja="cerrada";

            }
            $json=['result'=>$resul,'comanda'=>$comanda,'factura'=>$factura,'mesas'=>$mesas,'mozos'=>$mozos,'mozo'=>$moz,'descuento'=>$descuento];
            echo json_encode($json);
          }
          public function abrirmesa(){
            $objmesa= new mesa();
            $mesas= $objmesa->obtenerMesas();
            $objcajas=new caja();

            $estado=$objcajas->verificarCaja();
            if($estado=='a'){
              $mozo=$this->json->mozo;
              $mesanro=$this->json->mesa;
          
              $comanda= new comanda();
              $numero_comanda= $comanda->generarnumerocomanda();
                                
              $numero_comanda= intval($numero_comanda['numero'])+1;
                                

              $comanda->setNum_Comanda($numero_comanda);

              $comanda->setMozo($mozo);
              $comanda->setMesa($mesanro);
              $comanda->save(); 
              $objmesa->abrirMesa($mesanro);
              $mesas= $objmesa->obtenerMesas();

                $json=["mesas"=>$mesas];
                echo json_encode($json);
            }

                   
                }
                       
                
            public function cerrarmesa(){
             $objmesa= new mesa();
             $mesas= $objmesa->obtenerMesas();


              $id=$this->json->mesa;
              $mesanro=$id;
              
              $objcomanda= new comanda();
              $pago="EFECTIVO";
             

              $comanda=$objcomanda->seleccionarcomanda($id);
              $comanda=$comanda['comanda'];
              $objcomanda->ingresarpago($comanda,$pago);
              $mozo=$objcomanda->obtenerMozo($comanda);
              $cerrar=$objmesa->cerrarMesa($id);
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

                $ticket= $objcomanda->generarfactura($id);
                if($objcaja->ObtenerDescuento($comanda)>0.00){
                  $descuento=$objcaja->ObtenerDescuento($comanda);};     
                $nombre_impresora="Generic";
                $connector= new WindowsPrintConnector($nombre_impresora);
                $printer= new printer($connector);
                  $printer->setJustification(Printer::JUSTIFY_LEFT);
                  $printer->text("MOZO: ".$mozo);
                   $printer->feed(1);
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->text("FECHA:".$fecha);
                $printer->feed(1);
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->text("MESA:"." ".$id);
                $printer->feed(2);
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->text("CANTIDAD  ");
                $printer->setJustification(Printer::JUSTIFY_CENTER);
                $printer->text("PRODUCTO");
                $printer->setJustification(Printer::JUSTIFY_RIGHT);
               $printer->text(" PRECIO X/U  ");
                 $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->text("  TOTAL");
                $printer->feed(1);
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

                $printer->pulse();
                $printer->cut();
$printer->feed(1);
                $printer->close();
                
               

                  $json=['ticket'=>$ticket,'mesas'=>$mesas];
                  echo json_encode($json);                
               
              }
              public function AgregarProducto(){
                $objcomanda=new comanda();
                $cantidad=$this->
                json->cantidad;
                $producto=$this->json->codigo;
                $mesanro=$this->json->mesa;
                $objmesa= new mesa();
                $mesas= $objmesa->obtenerMesas();
                $num_comanda= $objcomanda->seleccionarcomanda($mesanro);
                $moz= $objmesa->obtenerMozo($mesanro);

                $objcaja=new cajachica();
                $comanda= $objcomanda->seleccionarcomanda($mesanro);
                $comanda= $comanda['comanda'];          
                $num_comanda= $num_comanda['comanda'];
                $objmesa= new mesa();
                $objcomanda->guardarventa($producto,$cantidad,$num_comanda);
                $factura= $objcomanda->generarfactura($mesanro);
             

                  $objmesa= new mesa();
                  $mesas= $objmesa->obtenerMesas();
                  $json=["factura"=>$factura,"mesas"=>$mesas];
                  echo json_encode($json);
                                
                
             }
             public function imprimir(){

               
		$mesanro=$this->json->mesa;
                $comanda=new comanda();
                $objcaja=new cajachica();
                $objcomanda=new comanda();
                $fecha=$objcaja->obtenerfecha();
                $descuento=0.00;
                $objcomanda=new comanda();
                $comanda= $objcomanda->seleccionarcomanda($mesanro);
                $comanda=$comanda['comanda'];
                $mozo=$objcomanda->obtenerMozo($comanda);
                if($objcaja->ObtenerDescuento($comanda)>0.00){
                  $descuento=$objcaja->ObtenerDescuento($comanda);};
                  $factura= $objcomanda->generarfactura($mesanro);
		

                  $nombre_impresora="Generic";
                  $connector= new WindowsPrintConnector($nombre_impresora);
                  $printer= new printer($connector);
		
             
                 
                 

                  $printer->setJustification(Printer::JUSTIFY_LEFT);
                  $printer->text("MOZO: ".$mozo);
                   $printer->feed(1);
                  $printer->setJustification(Printer::JUSTIFY_LEFT);
                  $printer->text("FECHA: ".$fecha);
                  $printer->feed(1);
             
                 
                  $printer->text("MESA:"." ".$mesanro);
                  $printer->feed(1);
                
                  $printer->setJustification(Printer::JUSTIFY_LEFT);
                  $printer->text("CANTIDAD  ");
                  $printer->setJustification(Printer::JUSTIFY_CENTER);
                  $printer->text("PRODUCTO");
                  $printer->setJustification(Printer::JUSTIFY_RIGHT);
                  $printer->text(" PRECIO X/U  ");
                 $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->text("  TOTAL");
                $printer->feed(1);
                $total=0.00;

                foreach($factura as $obj){
		
		IF($obj['cantidad']>0){
   $printer->feed(1);
                  $subtotal=$obj['precio']*$obj['cantidad'];
                  $total=$total+$obj['precio']*$obj['cantidad'];
                  $printer->setJustification(Printer::JUSTIFY_LEFT);
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
                  $printer->pulse();
                  $printer->cut();
 $printer->feed(1);
$cliente=$objcomanda->seleccionarcliente($mesanro);
                  $printer->close();

                  $json=['factura'=>$factura,'mesas'=>$mesas,'mozos'=>$mozos,'mozo'=>$moz];
            echo json_encode($json); 

                

              }
            }

            $objrecibido = json_decode(file_get_contents("php://input"));                                                                                                                                                                                       
            $accion=$objrecibido->accion;
           $objetocomanda= new ComandaController($objrecibido);
           
            $objetocomanda->$accion();	
