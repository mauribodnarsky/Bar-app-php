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
          <div class="col-sm-4">

          </div>
          <div class="col-sm-8 col-12">
            <H4>PRODUCTOS VENDIDOS</H4>

          </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-12">
        <div class="row">
          <div class="col-sm-12">
          <form  action="?controller=usuario&action=estadisticasproductos" method="POST">
             <label class="d-inline-block font-weight-bold">DESDE</label>
              <input class="form-control d-inline-block w-50" type="date" name="fechainicio">
          </div>
        </div>
         <div class="row">
          <div class="col-sm-12">
              <label class="d-inline-block font-weight-bold">HASTA</label>
              <input class="form-control d-inline-block w-50" type="date" name="fechafin">
          </div>
         </div>
          <div class="row my-2">
          <div class="col-sm-12">
              <label class="d-inline-block font-weight-bold">PRODUCTO</label>
              <select class=" form-control d-inline-block w-50" name="producto">
                <option value="TODOS">TODOS</option>
                <?php foreach($allproductos as $producto):?>
               <?php echo " <option value=\"".$producto['codigo']."\"";?>"><?php echo $producto['nombre'];?></option>
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
      </div>
      <div class="col-sm-8 col-12">
        
        <div class="row">
          <div class="col-sm-12">
            <?php if(isset($imprimir_productos)):?>
            <?php echo $imprimir_productos;endif?>
          </div>
        </div>
        </div>
      </div>
        
     