 <div class="col-12" style="background-color: #e4dabef5;">
      <div class="row p-2 d-flex" style="font-family: Blanchope Free;font-style: oblique;">
     <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=comanda&action=seleccionarmesa"> COMANDAS
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=productos">ADMINISTRACIÓN
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=estadisticas"><img src="logoestanc.ico" type="img/icon" style="width: 6%;margin-right: 2px;">ESTADISTICAS
       </a>
      
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=caja&action=index">CAJA CHICA
       </a> 

       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=caja&action=vercajagrande">CAJA GRANDE
       </a>  <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=usuarios">USUARIOS
       </a>  
     <a id="cerrarsesion" class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" onclick="cerrarsesion()"  style="text-decoration: none;border-right: 1px solid white !important;
    background: black;cursor: pointer;">CERRAR SESIÓN
       </a> 
     </div>
     <div class="row p-2 d-flex">
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;" href="<?=base_url?>?controller=usuario&action=estadisticascajas">CAJAS
       </a> 
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;" href="<?=base_url?>?controller=usuario&action=estadisticasproductos">PRODUCTOS
       </a>  
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center"  style="text-decoration: none;" href="<?=base_url?>?controller=usuario&action=estadisticasmozos">MOZOS
       </a> 

         <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center"  style="text-decoration: none;" href="<?=base_url?>?controller=caja&action=estadisticassaldos">SALDOS
       </a> 
  </div>
         <div class="row">
        <div class="col-sm-6 col-12">
        <div class="row">
          <div class="col-sm-12">
          <form  action="?controller=caja&action=estadisticassaldos" method="POST">
             <label class="d-inline-block font-weight-bold">DESDE</label>
              <input class="form-control d-inline-block w-50" type="date" required="on" name="fechainicio">
          </div>
        </div>
         <div class="row">
          <div class="col-sm-12">
              <label class="d-inline-block font-weight-bold">HASTA</label>
              <input class="form-control d-inline-block w-50" type="date" name="fechafin" required="on">
          </div>
         </div>
         <div class="row">
           <div class="col-sm-12">
                          <label class="d-inline-block font-weight-bold">ACREEDOR</label>

             <select class="form-control d-inline-block mt-2 w-50" name="acreedor">
              <?php foreach($proveedores as $proveedor):?>
              <option class="ml-1"  value="<?php echo $proveedor['nombre']?>"><?php echo $proveedor['nombre']?></option>
            <?php endforeach;?>
            </select>
           </div>
         </div>

        <div class="row">
          <div class="col-sm-12">
              <input class="form-control ml-1 btn-primary d-inline-block w-50 my-2" type="submit" value="CONSULTAR">
              </form>

          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
      <?php if(isset($cuentas) and ($cuentas!= false)):?>
          
<table class="table-striped thead-dark tbody-light w-100 table-hover text-center mt-2">
    <thead>

      <tr>
      <th>ACREEDOR</th>
      <th>DEUDA</th>
      <TH>PAGADO</TH>
      <TH>TOTAL</TH>
      <th>ACCIÓN</th>
      </tr>

    </thead>
    <tbody>

    <?php foreach ($cuentas as $key => $proveedor):?>
         <?php if( !($proveedor['INGRESOS']==0 and $proveedor['EGRESOS']==0 and $proveedor['TOTAL']==0)):?> 
 
    <?php if($proveedor['TOTAL']>0):?> <?php $color="red";endif;?>
        <?php if($proveedor['TOTAL']<=0):?> <?php $color="green";endif;?>

    <?php echo '<tr><td>'.$proveedor['PROVEEDOR'].'</td>'.'<td>$'.number_format($proveedor['INGRESOS'],2,',','.').'</td>'.'<td>$'.number_format($proveedor['EGRESOS'],2,',','.').'</td>'.'<td style="color:'.$color.';">$'.number_format(abs($proveedor['TOTAL']),2,',','.').'</td>'.'<td><form action="?controller=caja&action=estadisticassaldos" method="POST"><input type="hidden" name="proveedor" value="'.$proveedor['PROVEEDOR'].'"> <input type="submit" class="btn-info border-info p-1 p-sm-2 m-sm-2 mt-2 d-inline-block" value="DETALLES"></form></tr>'; endif;endforeach;?>
     </tbody>
  </table>
  <?php endif;?>

      </div>
    </div></div>
      <div class="col-sm-6 col-12">
            <?php if(isset($detalleproveedor) and (!isset($error))):?>
      <?php  $totalI=0.00;$totalE=0.00;?>
                  <?php if((isset($fechainicio)) and (isset($fechafin))):?>

      <?php $fechainicio=date("H:i:s d-m-Y",strtotime($fechainicio));?>
      <?php $fechafin=date("H:i:s d-m-Y",strtotime($fechafin));?>
        <div class="row"><div class="col-12" style="background-color: #a19d94;border:1px black solid;border-radius: 2%;">

          <h4 style="display: inline-block;"><?php ECHO "DESDE: ";?></h4>
    <h4 style="display:inline-block;color:#241f14;"><?php echo "".$fechainicio;?></h4>

        </div></div>
        <div class="row"><div class="col-12" style="background-color: #a19d94;border:1px black solid;border-radius: 2%;">

          <h4 style="display: inline-block;"><?php ECHO "HASTA: ";?></h4>
    <h4 style="display:inline-block;color:#241f14;"><?php echo "".$fechafin;?></h4>

        </div></div>
      <?php endif;?>
<div class="row"><div class="col-12">
   <?php foreach ($detalleproveedor as $key => $detalle):?>    
    <?php $totalI=$totalI+$detalle['ingresos'];
    $totalE=$totalE+$detalle['egresos'];endforeach;?>
    <?php $total=$totalI-$totalE; number_format($totalE,2,',','.');number_format($total);number_format($totalI,2,',','.');?>
        <?php if($total>0):?> <?php $color="red";endif;?>
        <?php if($total<=0):?> <?php $color="green";endif;?>
        <div class="row"><div class="col-12" style="background-color: #a19d94;border:1px black solid;border-radius: 2%;">
        <h4><?php ECHO "DEUDA:$".number_format($totalI,2,',','.');?></h4></div></div>
        <div class="row"><div class="col-12" style="background-color: #a19d94;border:1px black solid;border-radius: 2%;">   
         <h4 ><?php echo "PAGADO:".number_format($totalE,2,',','.');?></h4>
  </div></div>
  <div class="row"><div class="col-12" style="background-color: #a19d94;border:1px black solid;border-radius: 2%;">  
    <h4 style="display:inline-block;">SALDO:</h4>
    <h4 style="display:inline-block;color:<?php echo $color.";";?>"><?php ECHO "".number_format($total,2,',','.');?></h4>
  </div></div>

<?php  endif;?>
      <?php if(isset($error)):?>
        <h4><?php echo $error."!" ;?></h4> <?php endif;?>
</div></div>
  <table class="table-striped table-dark w-100 table-hover text-center mt-2">
    <thead>
      <?php if(isset($detalleproveedor) and ($detalleproveedor!= false)):?>
      <tr>
      <th>DETALLE</th>
      <th>INGRESOS</th>
      <TH>EGRESOS</TH>
      <TH>FECHA</TH>
      </tr>

    </thead>
    <tbody>

    <?php foreach ($detalleproveedor as $key => $detalle):?>
    
    <?php echo '<tr><td>'.$detalle['detalle'].'</td>'.'<td>$'.number_format($detalle['ingresos'],2,',','.').'</td>'.'<td>$'.number_format($detalle['egresos'],2,',','.').'</td><td>'.$detalle['fecha'].'</td></tr>';endforeach;endif;?>
     
          </div>
        </div>
        </div>
      </div>
        
     