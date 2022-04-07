    <div class="col-12" style="background-color: #e4dabef5;">

      <div class="row p-2 d-flex">
        
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=comanda&action=seleccionarmesa"> COMANDAS
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=productos">ADMINISTRACIÓN
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=caja&action=index"><img src="logoestanc.ico" type="img/icon" style="width: 6%;margin-right: 2px;">CAJA CHICA
       </a>   
     <a id="cerrarsesion" class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" onclick="cerrarsesion()"  style="text-decoration: none;border-right: 1px solid white !important;
    background: black;cursor: pointer;">CERRAR SESIÓN
       </a>  </div>
           <div class="row">
         <div class="col-12">
          <?php $ruta="?controller=caja&action=abrircaja";$valor="ABRIR CAJA";?>
          <?php $valor="ABRIR CAJA";?>

          <?php if(isset($estadocaja) and ($estadocaja=="abierta")):?>
          <?php $ruta="?controller=caja&action=cerrarcaja";$dinerocaja="";$valor="CERRAR CAJA";endif;?>

          <form action="<?php echo $ruta;?>" id="formulario"  onsubmit="mostrarventana()"  method="POST" class=" d-inline-block">
            <input type="submit"id="cerrar" class="btn-info border-info p-2 d-inline-block" value="<?php echo $valor;?>">

          </form>

        </div>
      </div>
      <script type="text/javascript">
        function mostrarventana(){
          if(document.getElementById('cerrar').value=="CERRAR CAJA"){
            var respuesta=confirm("estas seguro de cerrar caja?");
            if (respuesta ==true) {
              document.getElementById('formulario').setAttribute("action","?controller=caja&action=cerrarcaja&respuesta=true");
            }else{
              document.getElementById('formulario').setAttribute("action","?controller=caja&action=cerrarcaja&respuesta=false");

            }
          }
        }
      </script>

      <div class="row">
        <div class="col-12 col-sm-4">
          <div class="row mb-1">
           <div class="col-12 mt-2">
                <?php if(isset($estadocaja) and ($estadocaja=="abierta")):?>
            <form action="?controller=caja&action=guardarmovimientocajachica" method="POST" class=" d-inline-block form-group">
              <h5 class="font-weight-bold">NUEVO MOVIMIENTO</h5>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-12">
              
           <div class="row mb-1">       
            <div class="col-3">
              <label class="font-weight-bold d-inline-block float-right">ACREEDOR</label>
            </div>
            <div class="col-9">
              <?php if(isset($proveedores)):?>
                <select class="form-control d-inline-block ml-0 w-100 " name="acreedor">
                  <?php foreach($proveedores as $proveedor):?>
                    <option class="ml-1"  value="<?php echo $proveedor['nombre']?>"><?php echo $proveedor['nombre']?></option>
                  <?php endforeach;?>
                </select>
              <?php endif;?>
            </div>
          </div>
          <div class="row mb-1">       
            <div class="col-3">
              <label class="font-weight-bold d-inline-block float-right">PAGO</label>
            </div>
            <div class="col-9">
                <select class="form-control d-inline-block ml-0 w-100" name="tipo">
                    <option class="ml-1"  value="EFECTIVO">EFECTIVO</option>
                    <option class="ml-1"  value="POSNET">POSNET</option>
                </select>
              
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-1">       
        <div class="col-3">
          <label class="font-weight-bold d-inline-block float-right">INGRESO</label>
        </div>
        <div class="col-9">
          <input class="ml-0 w-100 align-self-center form-control "  type="number" min="0.00" value="0.00" name="ingreso">
        </div>
      </div>
   <div class="row mb-1">       
        <div class="col-3">
          <label class="font-weight-bold d-inline-block float-right">EGRESO</label>
        </div>
        <div class="col-9">
          <input class="ml-0 w-100 align-self-center form-control"  type="number" value="0.00" min="0.00"  name="egreso">
        </div>
      </div>

      <div class="row mb-1">
        <div class="col-3">
          <label class="font-weight-bold d-inline-block float-right">DETALLE</label>
        </div>
        <div class="col-9">
          <textarea class="form-control d-inline-block"  type="textarea" name="detalle" placeholder="INGRESE EL DETALLE DEL MOVIMIENTO"> </textarea>
        </div>
      </div>

      <div class="row mb-1">        
        <div class="col-12 mt-2">
          <input type="submit" class="btn-info border-info p-2 d-inline-block float-right" value="GUARDAR">          
        </form>
      <?php endif;?>
    </div>
  </div>
</div>
<div class="col-sm-8 col-10">
 <?php if(isset($egresos) and ($egresos!= false)):?>
 <h5 class="float-left">EGRESOS</h5>
<?php endif;?>
<table class="table-striped table-dark w-100 table-hover text-center">
  <thead>
    <?php if(isset($egresos) and ($egresos!= false)):?>
    <tr>
      <th>ACREEDOR</th>
      <th>DETALLE</th>
            <th>FECHA</th>

      <th>MONTO</th>
    </tr>

  </thead>
  <tbody>

    <?php foreach ($egresos as $key => $egreso):?>
      
      <?php echo '<tr><td>'.$egreso['acreedor'].'</td>'.'<td>'.$egreso['detalle'].'</td>'.'<td>'.$egreso['fecha'].'</td>'.'<td>$'.number_format($egreso['monto'],2,',','.').'</td>'.'</td>';endforeach;?>
    </tbody>
  </table>
<?php endif;?>
<?php if(isset($datosmozos) and ($datosmozos!= null)):?>
<h5 class="float-left">DATOS MOZOS</h5>
<?php endif;?>
<table class="table-striped table-dark w-100 table-hover text-center">
  <thead>
    <?php if(isset($datosmozos) and ($datosmozos!= null)):?>
    <tr>
      <th>MOZO</th>
      <th>MESAS ATENDIDAS</th>
      <th>PRODUCTOS VENDIDOS</th>
      <th>TOTAL VENDIDO</th>
    </tr>

  </thead>
  <tbody>

    <?php foreach ($datosmozos as $key => $mozo):?>
      
      <?php echo '<tr><td>'.$mozo['mozo'].'</td>'.'<td>'.$mozo['mesas_atendidas'].'</td>'.'<td>'.$mozo['productos_vendidos'].'</td>'.'<td>$'.number_format($mozo['total'],2,',','.').'</td>'.'</td>';endforeach;?>
    </tbody>
  <?php endif;?>
  <table class="table-striped table-dark  w-100 table-hover text-center mt-3">
    <thead>
      <?php if(isset($cajas) and ($cajas!= false)):?>
      <tr><h4 class="float-left my-2">CAJAS</h4></tr>
    <?php endif;?>
    <?php if(isset($cajas)):?>
      <th>APERTURA</th>
      <th>CIERRE</th>
      <th>VENTAS</th>  
      <th>EGRESO</th>
      <th>SALDO</th>
      <th>ACCION</th>

    </thead>
    <tbody>
      <?php if(isset($cajas) and ($cajas!= false)):?>
      <?php foreach ($cajas as $key => $caja):?>
        <?php if($caja['POSNET']==NULL):?><?php $caja['POSNET']="0.00";endif;?>
        <?php if($caja['EFECTIVO']==NULL):?><?php $caja['EFECTIVO']="0.00";endif;?>
        <?php if($caja['EGRESO']==NULL):?><?php $caja['EGRESO']="0.00";endif;?>
        <?php $totalventas=$caja['EFECTIVO']+$caja['POSNET'];?>
 <?php $saldo=$totalventas+$caja['EGRESO'];?>
        <?php echo '<tr><td>'.$caja['apertura'].'</td>'.'<td>'.$caja['cierre'].'</td>'.'<td>$'.number_format($totalventas,2,',','.').'</td>'.'<td>$'.number_format($caja['EGRESO'],2,',','.').'</td>'.'<td>$'.number_format($saldo,2,',','.').'</td>'.'<td>'.'<form action="?controller=caja&action=verventas" method="POST"><input type="hidden" name="fechainicio" value=" '.$caja['apertura'].'"><input type="hidden" name="fechafin" value="'.$caja['cierre'].'"><input type="hidden" name="fechainicio" value=" '.$caja['apertura'].'"><input type="hidden" name="caja" value="'.$caja['caja'].'"><input type="hidden" name="totalventas" value="'.$totalventas.'"> <input type="submit" class="btn-info border-info p-2 m-2 d-inline-block" value="DETALLES"></form></tr>';endforeach;?>
      </tbody>
    <?php endif;?>
  <?php endif;?>
  <?php if(isset($detalleventa) and ($detalleventa!= false)):?>
  <h5 class="float-left my-2">VENTAS: $<?php if(isset($totalventa)):?> <?php echo $totalventa;endif;?></h5>
<?php endif;?>
<?php if(isset($detalleventa)):?>
  <th>PRODUCTO</th>
  <th>CANTIDAD</th>
  <th>PRECIO</th>
  <th>PAGO</th>
  <th>MESA</th>
  <th>MOZO</th>
  <th>TOTAL</th>
  <TH>FECHA</TH>
  

</thead>
<tbody>

  <?php foreach ($detalleventa as $key => $caja):?>
    <?php echo '<tr><td>'.$caja['producto'].'</td>'.'<td>'.$caja['cantidad'].'</td>'.'<td>$'.number_format($caja['precio'],2,',','.').'</td>'.'<td>'.$caja['pago'].'</td>'.'<td>'.$caja['mesa'].'</td><td>'.$caja['mozo'].'</td><td>$'.number_format($caja['total'],2,',','.').'</td>'.'<td>'.$caja['fecha'].'</td></tr>';endforeach;?>
  </tbody>
<?php endif;?>
</table>
</div>



</div>

</div>

</div>
</div>