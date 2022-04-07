<div class="col-8" style="float:left; display: inline-block;">
 <a href="<?=base_url?>/" ><input id="btn-producto-nuevo" type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;"value="Nuevo Producto"></a>
 <a href="<?=base_url?>/?controller=proveedor&action=index" ><input  type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;"value="Nuevo Proveedor"></a>
 <a href="<?=base_url?>/?controller=producto&action=compra" ><input  type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;"value="Nueva Venta"></a>
  <a href="<?=base_url?>/?controller=producto&action=aumentar"> <input id="btn-producto-"   type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;" value="Aumentar precios">
</a>
   <form method="post" action="<?=base_url?>/?controller=proveedor&action=buscarproductos" class="col-12" style="margin-top: 15px; margin-bottom: 5px;display: inline-block;margin-left: -15px;">
    <input name="search" class="form-control mr-sm-4 col-8" type="text" style="margin-top: 15px; margin-bottom: 5px;display: inline-block;" placeholder="Introduzca el nombre del producto que desea buscar..." aria-label="Search"> 
     <input name="proveedor" value="<?php $id;?>"  type="hidden"> 
     <button class="btn btn-secondary btn-lg disabled mb-2 mr-5" style="margin-left: -18px;   height: 40px; line-height: 20px;" type="submit">Buscar</button> </form>
     <h2 style="display: inline-block;"><?php  echo $nombre[0]['proveedor']; ?></h2>

      <table class="table table-striped col-12" id="productos-result" style="table-layout: fixed;overflow-wrap: break-word; text-align: center;">    

          <thead>
            <tr>
              <th style="width:514px;" >Producto</th>
              <th style="width:74px;">Stock</th>
              <th style="width:114px;">Precio Proveedor</th>
                  <th style="width:114px;">Precio Venta</th>
               <th style="width:181px;">Accion</th>
            </tr>
          </thead>
          <tbody id="container">  
      
   <?php foreach($products as $pro) : ?> 
    <tr  <?php if(($pro['alerta_stock'])>=($pro['stock'])) : ?> style="background: #d9675f;" 
      <?php else : ?>style="background: #78e37f;" <?php endif;?> >
      <td style="vertical-align: middle;"><?=  $pro['nombre']?></td>
      <td style="vertical-align: middle;"><?=  $pro['stock']?></td>
      <td style="vertical-align: middle;">$<?=  $pro['precio_proveedor']?></td>
      <?php $porcentaje=(($pro['precio']-$pro['precio_proveedor'])*100)/$pro['precio_proveedor'];?>
      <td style="vertical-align: middle;">$<?=  $pro['precio']?> <p style="display:contents;color: green;">+<?=number_format($porcentaje,2) ?> %</p></td>
      <td style="width=100px;vertical-align: middle;">
        <a href="<?=base_url?>/?controller=producto&action=editar&id=<?=$pro['id'];?>" class="btn btn-warning" style="display:inline-block;margin-bottom:4px;color: #4890c7;font-weight: 500;background:white;border-color:#4890c7;width: 149px;">EDITAR</a>
        <a href="<?=base_url?>/?controller=producto&action=eliminar&id=<?=$pro['id'];?>"class="btn btn-warning" style="display:inline-block;margin-bottom:4px;color: #c74a48;font-weight: bold;background:white;border-color:#c74a48;width: 149px;">ELIMINAR</a>
      </td>
     
    </tr> 
  <?php endforeach;?> 
    </tbody>
        </table> 
         </div>