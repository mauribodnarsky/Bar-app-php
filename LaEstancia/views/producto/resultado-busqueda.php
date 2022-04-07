 <div class="col-8" style="float:left; display: inline-block;">
 <a href="<?=base_url?>/"> <input id="btn-producto-nuevo"   type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;" value="Nuevo Producto">
</a>
 <a href="<?=base_url?>/"> <input id="btn-producto-"   type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;" value="Aumentar precios">
</a>
   <form method="post" action="<?=base_url?>/?controller=producto&action=buscar" class="col-12" style="margin-top: 15px; margin-bottom: 5px;display: inline-block;margin-left: -15px;">
    <input name="search" class="form-control mr-sm-4 col-8" type="text" style="margin-top: 15px; margin-bottom: 5px;display: inline-block;" placeholder="Introduzca el nombre del producto que desea buscar..." aria-label="Search"> 
     <button class="btn btn-secondary btn-lg disabled mb-2 mr-5" style="margin-left: -18px;   height: 40px; line-height: 20px;" type="submit">Buscar</button> </form>

      <table class="table table-striped col-12" id="productos-result"  style="table-layout: fixed;overflow-wrap: break-word; text-align: center;">    

          <thead>
            <tr  style="background-color: #bfbfa4;">
              <th style="width:429px;" >Producto</th>
              <th style="width:74px;">Stock</th>
              <th style="width:97px;">Precio</th>
              <th style="width:144px;">Proveedor</th>
               <th style="width:149px;">Accion</th>
            </tr>
          </thead>
          <tbody id="container">  
                 <h1>Resultados:<?php echo "  ".count($busqueda);?> </h1>
                  <?php if(empty($busqueda)) : ?> 
                    <h2>No se encontraron resultados </h2>
                  <?php endif; ?>
    <?php foreach($busqueda as $pro) :  ?> 
    <tr  <?php if(($pro['alerta_stock'])>=($pro['stock'])) : ?> style="background: #d9675f;"> <?php else : ?>style="background: #78e37f;">       <?php endif;?> 
      <td style="vertical-align: middle;text-align: left;"><?=  $pro['nombre']?></td>
      <td style="vertical-align: middle;"><?=  $pro['stock']?></td>
      <td style="vertical-align: middle;">$<?=  $pro['precio']?></td>
      <td style="vertical-align: middle;"><?=  $pro['proveedor']?></td>
      <td>
      <a href="<?=base_url?>/?controller=producto&action=editar&id=<?=$pro['id'];?>" class="btn btn-warning" style="display:inline-block;margin-bottom:4px;color: #4890c7;font-weight: 500;background:white;border-color:#4890c7;width: 130px;">Editar</a>
     <a href="<?=base_url?>/?controller=producto&action=eliminar&id=<?=$pro['id'];?>" class="btn btn-warning"  style="display:inline-block;margin-bottom:4px;color: #c74a48;font-weight: 500;background:white;border-color:#c74a48;width: 130px;">Eliminar</a>
        <a href="<?=base_url?>/?controller=producto&action=agregar&id=<?php echo $pro['id'];?>&nombre=<?php echo $pro['nombre'];?>&precio=<?php echo $pro['precio'];?>" class="btn btn-warning"  style="display:inline-block;margin-bottom:4px;color: #c7c548;font-weight: 500;background:white;border-color:#c7c548;width: 130px;">Aumento</a>
      </td>
    </tr> 
  <?php endforeach; ?>
  </tbody>
        </table>
        </div>
        <div class="col-4" style="float: right;margin-top: 70px;">
         <form method="POST" action="<?=base_url?>/?controller=producto&action=aplicarAumento"  style="padding: 15px; border-radius: 5px; background: #bfbfa3 ;" >
            <table class="table table-striped col-12" id="productos-result">    

          <thead style="background: #98ab80;">
            <tr>
              <th>Codigo</th>
              <th>Producto</th>
              <th>Precio</th>
               <th>Accion</th>
            </tr>
          </thead>
        
    <tbody id="container"> 
     
             <?php if (isset($_SESSION['aumentos'])) : ?>
                       
           <?php  foreach ($_SESSION['aumentos'] as $key => $value)  : ?>
            <tr>
           <td  style="vertical-align: middle;"> <?php  echo $value['codigo'];?> </td>
            <td  style="vertical-align: middle;"> <?php  echo $value['producto'];?> </td>
              <td  style="vertical-align: middle;"> <?php  echo  $value['precio'];?> </td>
            <td style="vertical-align: middle;"> <a href="<?=base_url?>/?controller=producto&action=quitar&id=<?php echo $key;?>" class="button button-gestion button-red" name="borrar"> Quitar</a></td>
          </tr>
           <?php endforeach;?>
            </tbody>

          </table>
          <a href="<?=base_url?>/?controller=producto&action=vaciar"> <input id="btn-producto-"   type="button" class="btn btn-warning" style="float: right; margin-top:-5px; margin-right: 1px;background: #c74a48;border-color:#c74a48;" value="Vaciar lista"></a>
           <div class="row" style="display: inline-block;margin-top: 16px;float: right;padding:5.5px;margin-right: 0px;">
           <input type="number" name="aumento" class="btn btn-warning" min="0" max="9999999" step="0.01" placeholder="ej 15" style="background: #e8de6f;border-radius: 5px;  border-color: #e8de6f;">
           <select class="btn btn-warning" name="valor" style="background: #e8de6f;border-radius: 5px; ;  border-color: #e8de6f;"><option value="porcentaje">Porcentaje</option> <option value="aumentar">Aumentar</option></select>
           </div>
           <input type="submit" name="guardar" value="Aplicar Aumento" class="btn btn-warning" style="margin-top: 20px;background: #c74a48; margin-left: 245px;border-color:#c74a48; ">
          <?php endif;?>
</form>
        </div> 