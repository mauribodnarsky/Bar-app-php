<div class="col-8" style="float:left; display: inline-block;margin-top: 80px;">
 
<table class="table table-striped col-12" id="productos-result" style="table-layout: fixed;overflow-wrap: break-word; text-align: center;">    

          <thead>
            <tr>
           
              <th style="width:40%;" >Proveedor</th>
              <th style="width:40%;">Contacto</th>
               <th style="width:20%;">Accion</th>
            </tr>
          </thead>
          <tbody id="container">  
      
   <?php foreach($proveedores as $pro) : ?> 
    <tr>
      <td style="vertical-align: middle;font-size:xxx-large; font-weight: 400;" ><?=  $pro['proveedor']?></td>
      <td style="vertical-align: middle;font-size:medium; font-weight: 600;"><?=  $pro['contacto']?></td>
      <td style="width=100px;vertical-align: middle;">
        <a href="<?=base_url?>/?controller=proveedor&action=verproductos&id=<?=$pro['id'];?>" class="btn btn-warning" style="color:white;background: #4890c7;display: inline-block;margin-bottom:7px;border-color:#4890c7;width: 149px;">Ver productos</a>

  
         <a href="<?=base_url?>/?controller=proveedor&action=borrartodos&id=<?=$pro['id'];?>"  class="btn btn-warning" style="color:white;background: #c74a48;margin-bottom:7px;display: inline-block;border-color:#c74a48;" >Eliminar productos</a>
         <form method="POST" action="?controller=proveedor&action=aumentarprecio" style="display: inline-block;">
          <input type="hidden" name="id" value="<?=$pro['id'];?>" >
         
          <input type="submit" class="btn btn-warning" value="Aumentar precios" style="display: inline-block;background-color: #5bc246;color:white;width: 149px; border-color: #5bc246;" >
           <input type="number" name="aumento" step="0.1" style="display: inline-block;width: 45px;margin-top: 8px;">
          <label>%</label>
        </form>
      </td>
    </tr> 
  <?php endforeach; ?> 
    </tbody>
        </table> 
      </div>
<div class="col-4" style="display: inline-block;float: right;margin-top: 60px;">
 
     <div class="col-8"  style="float:left; display: inline-block;margin-top: 10px;">
    
  <form enctype="multipart/form-data" method="post" action="<?=base_url?>/?controller=proveedor&action=cargarexcel"  style="float:left; display: inline-block;margin-top: 10px; padding:10px;background: #a4b08f;border-radius: 5px;width:394px;" >
    <div  style="display: inline-block; border-bottom:2px solid #59594c;background: #a0b084;">
    <h5 style="display: inline-block;margin:4px 43px; color: #dbe1dc;">ACTUALIZAR LISTA DE PRECIOS</h5>
  </div>
    <input  name="planilla" type="file"  style="float:left; display: inline-block;margin-top: 10px;" >
     <select class="form-control col-6" name="proveedor_id"   style="float:left; display: inline-block;margin-top: 10px;">
      <?php foreach ($proveedores as $prov): ?> 
 
      <option value="<?php echo $prov['id'] ?>"> <?= $prov['proveedor'] ?> </option>
      <?php endforeach; ?>
    </select>
    <input type="submit" class="btn btn-warning" value="CARGAR"  style="width: 98PX;float:right; display: inline-block;margin-top: 64px;margin-right: 13px; background: #59594c;color: white;border-color: #59594c; opacity: 0.99;">
  </form>
  </div>
 
 <div class="col-8"  style="float:left; display: inline-block;margin-top: 10px;">
   
  <form enctype="multipart/form-data" method="post" action="<?=base_url?>/?controller=proveedor&action=nuevosproductos"  style="float:left; display: inline-block;margin-top: 10px; padding:10px;background: #a4b08f;border-radius: 5px;width:394px;" >
     <div  style="display: inline-block; border-bottom:2px solid #59594c;background: #a0b084;">
    <h5 style="display: inline-block;margin:4px 38px; color: #dbe1dc;">CARGAR NUEVOS PRODUCTOS</h5>
  </div>
    <input  name="planilla" type="file"  style="float:left; display: inline-block;margin-top: 10px;" >
     <select class="form-control col-6" name="proveedor_id"   style="float:left; display: inline-block;margin-top: 10px;">
      <?php foreach ($proveedores as $prov): ?> 
 
      <option value="<?php echo $prov['id'] ?>"> <?= $prov['proveedor'] ?> </option>
      <?php endforeach; ?>
    </select>
    <input type="submit" class="btn btn-warning" value="SUBIR"  style="float:right; display: inline-block;margin-top: 64px;margin-right: 13px; background: #59594c;color: white;border-color: #59594c; opacity: 0.99;width: 98PX;">
  </form>
  </div>
   <div class="col-8"  style="float:left; display: inline-block;margin-top: 10px;">
  
   <form   method="POST" action="<?=base_url?>/?controller=proveedor&action=guardar" style="display: inline-block; background: #a4b08f; padding: 20px; border-radius: 5px;width:394px;">
    <div  style="display: inline-block; border-bottom:2px solid #59594c;background: #a0b084;">
    <h5 style="display: inline-block;margin:4px 83px; color: #dbe1dc;">NUEVO PROVEEDOR</h5>
  </div>
    <div class="form-group col-12">
      <label style="font-weight: bold;" >Proveedor:</label>
      <input name="nombre" type="text" class="form-control"    style="background-color: #f5ecda;display: inline-block;" >
  
  </div>
          <div class="form-group col-12">
      <label style="font-weight: bold;">Contacto:</label>
      <input name="contacto" type="textarea" class="form-control"   style="background-color: #f5ecda;display: inline-block;" >
    </div>
       
  <input class="btn btn-primary" type="submit" style="width: 98PX;float: right;background:#59594c; color: white;margin-right:0px;width: 98PX; border-color: #59594c; opacity: 0.99;font-weight:400; margin-top: 15px;" value="GUARDAR">
    </form>
</div>
 <div class="col-8"  style="float:left; display: inline-block;margin-top: 10px;">
  
   <form   method="POST" action="<?=base_url?>/?controller=proveedor&action=editar" style="display: inline-block; background: #a4b08f; padding: 20px; border-radius: 5px;width:394px;">
    <div  style="display: inline-block; border-bottom:2px solid #59594c;background: #a0b084;">
    <h5 style="display: inline-block;margin:4px 83px; color: #dbe1dc;">EDITAR PROVEEDOR</h5>
  </div>
  <div class="form-group col-12">
     <select class="form-control col-6" name="proveedor_id"   style="float:left; display: inline-block;margin-top: 10px;background-color: #f5ecda;margin-bottom: 5px; ">
      <?php foreach ($proveedores as $prov): ?> 
 
      <option value="<?php echo $prov['id'] ?>"> <?= $prov['proveedor'] ?> </option>
      <?php endforeach; ?>
    </select>
  </div>
    <div class="form-group col-12" style="margin-top: 60px;">
      <label style="font-weight: bold;" >Proveedor:</label>
      <input name="nombre" type="text" class="form-control"    style="background-color: #f5ecda;display: inline-block;" >
  
  </div>
          <div class="form-group col-12">
      <label style="font-weight: bold;">Contacto:</label>
      <input name="contacto" type="textarea" class="form-control"   style="background-color: #f5ecda;display: inline-block;" >
    </div>
       
  <input class="btn btn-primary" type="submit" style="width: 98PX;float: right;background:#59594c; color: white;margin-right:0px;width: 98PX; border-color: #59594c; opacity: 0.99;font-weight:400; margin-top: 15px;" value="GUARDAR">
    </form>
</div>
