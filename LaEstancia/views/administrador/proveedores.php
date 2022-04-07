
 <div class="col-12" style="background-color: #e4dabef5;">
      <div class="row p-2 d-flex" style="font-family: Blanchope Free;font-style: oblique;">
     <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=comanda&action=seleccionarmesa"> COMANDAS
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=productos"><img src="logoestanc.ico" type="img/icon" style="width: 6%;margin-right: 2px;">ADMINISTRACIÓN
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=estadisticas">ESTADISTICAS
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
   
  <div class="row my-3">
  <div class="col-6 d-flex justify-content-center">
    <a href="<?=base_url?>?controller=proveedor&action=index" class="text-center form-control btn-danger w-50 py-1 px-2">ACREEDORES</a>
  </div>
    <div class="col-6 d-flex justify-content-center">
        <a href="<?=base_url?>?controller=usuario&action=productos" class="float-left form-control text-center w-50  ml-2 btn-danger py-1 px-2">PRODUCTOS</a>
</div>
  </div>

 <div class="row mt-3">
    <div class="col-sm-6">
      
            <H4>NUEVO ACREEDOR</H4>
            <form class="form-group" action="<?=base_url?>?controller=proveedor&action=guardarproveedor" method="POST">
            
         </div>
         <div class="col-sm-6">
           
         </div>
       </div>
       <div class="row ">

        <div class="col-sm-6">
          
          <div class="row">
            <div class="col-sm-12 mb-2">
              <LABEL class="d-inline-block font-weight-bold">NOMBRE</LABEL>
              <input class="form-control w-75 d-inline-block ml-1" type="text" required="true" name="nombre">
            </div>

          </div>

          <div class="row">
            <div class="col-sm-6 mb-2">
              <input class="form-control btn-success float-left py-1 px-2" style="text-decoration: none !important;border-radius:0.3em;"type="submit" value="GUARDAR">
            </div>
            <div class="col-sm-2 align-self-center">
              <label class="font-weight-bold d-inline-block float-right ">ACREEDORES</label>
            </div>
            <div class="col-sm-4">
              <?php if(isset($proveedores)):?>
                <select class="form-control d-inline-block ml-0 w-75 float-sm-left" name="acreedor">
                  <?php foreach($proveedores as $proveedor):?>
                    <option class="ml-0"  value="<?php echo $proveedor['nombre']?>"><?php echo $proveedor['nombre']?></option>
                  <?php endforeach;?>
                </select>
              <?php endif;?>
          </div>
          
          </form>
        </div>
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

</div>

