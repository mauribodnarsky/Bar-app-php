 <div class="col-12" style="background-color: #e4dabef5;">
      <div class="row p-2 d-flex" style="font-family: Blanchope Free;font-style: oblique;">
     <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=comanda&action=seleccionarmesa"> COMANDAS
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=productos">ADMINISTRACIÓN
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=estadisticas">ESTADISTICAS
       </a>
      
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=caja&action=index">CAJA CHICA
       </a> 

       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=caja&action=vercajagrande"><img src="logoestanc.ico" type="img/icon" style="width: 6%;margin-right: 2px;">CAJA GRANDE
       </a>  <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=usuarios">USUARIOS
       </a>  
     <a id="cerrarsesion" class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" onclick="cerrarsesion()"  style="text-decoration: none;border-right: 1px solid white !important;
    background: black;cursor: pointer;">CERRAR SESIÓN
       </a> 
     </div>
        <div class="row" >
      <div class="col-sm-4 col-12">
        <div class="row mt-2">
      <div class="col-sm-4 col-4"  style="background:#5cc91c;">
      <h4 class="d-inline-block font-weight-bold">EFECTIVO: <?php echo number_format($totalefectivo,2,',','.');?></h4>
    </div>
      <div class="col-sm-4 col-4" style="background:#5cc91c;">
      <h4 class="d-inline-block font-weight-bold">POSNET: <?php echo number_format($totalposnet,2,',','.');?></h4>
    </div>
      <div class="col-sm-4 col-4" style="background:#5cc91c;">
      <h4 class="d-inline-block font-weight-bold">SALDO: <?php echo number_format($saldo,2,',','.');?></h4>
    </div>
        </div>

        <div class="row">
          <div class="col-sm-12 col-12 mt-2 ">
            <form action="?controller=caja&action=guardarmovimientocajagrande" method="POST" class=" d-inline-block form-group">   
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
                <select class="form-control d-inline-block ml-0 w-100" name="acreedor">
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
    
    </div>
        </div>
        
      </div>
      <div class="col-sm-8 col-12">
        <div class="row mt-3">
      <div class="col-sm-12 col-12 mb-1 text-left">
         <div class="row">
        <div class="col-sm-6 col-12">
        <div class="row">
          <div class="col-sm-12">

      <h5 class="d-inline-block font-weight-bold">MOVIMIENTOS CAJA GRANDE</h5>
          
          <form  action="?controller=caja&action=vercajagrande" method="POST">
             <label class="d-inline-block font-weight-bold">DESDE</label>
              <input class="form-control d-inline-block w-50" type="date" name="fechainicio">
          </div>
        </div>
         <div class="row">
          <div class="col-sm-12">
              <label class="d-inline-block font-weight-bold">HASTA</label>
              <input class="form-control d-inline-block w-50" type="date" name="fechafin">
          <input type="submit" value="CONSULTAR">
               <?php if(isset($mensaje)):?>
                <?php echo $mensaje; endif;?>
          </div>
         </div>
    </div>

     <table class="table-striped table-dark w-100 table-hover text-center mt-2">
    <thead>
     <?php if(isset($movimientos) and ($movimientos!= false)):?>
      <tr>
      <th>INGRESOS</th>
      <th>EGRESOS</th>
      <TH>DETALLE</TH>
      <TH>DESCRIPCIÓN</TH>
      <TH>FECHA</TH>
      </tr>

    </thead>
    <tbody>

    <?php foreach ($movimientos as $key => $movimiento):?>
    <?php $ingreso=number_format($movimiento['ingreso'],2,',','.');?>
    <?php $egreso=number_format($movimiento['egreso'],2,',','.');?>
    <?php if($ingreso==0):?><?php $ingreso="";endif;?>
    <?php if($egreso==0):?><?php $egreso="";endif;?>
    <?php echo '<tr><td>'.$ingreso.'</td>'.'<td>'.$egreso.'</td>'.'<td>'.$movimiento['detalle'].'</td><td>'.$movimiento['tipo'].'</td><td>'.$movimiento['fecha'].'</td></tr>';endforeach;endif;?>
     </tbody>
  </table>
    </div>



    </div>

  </div>

      </div>

