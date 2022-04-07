 <div class="col-8" style="float:left; display: inline-block;">
   <a href="<?=base_url?>/" ><input id="btn-producto-nuevo" type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;"value="Nuevo Producto"></a>

   <a href="<?=base_url?>/?controller=producto&action=compra" ><input  type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;"value="Nueva Venta"></a>
   <a href="<?=base_url?>/?controller=producto&action=aumentar"> <input id="btn-producto-"   type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;" value="Aumentar precios">
   </a>
   <form method="post" action="<?=base_url?>/?controller=producto&action=buscar" class="col-12" style="margin-top: 15px; margin-bottom: 5px;display: inline-block;margin-left: -15px;">
    <input name="search" class="form-control mr-sm-4 col-8" type="text" style="margin-top: 15px; margin-bottom: 5px;display: inline-block;" placeholder="Introduzca el nombre del producto que desea buscar..." aria-label="Search"> 
    <button class="btn btn-secondary btn-lg disabled mb-2 mr-5" style="margin-left: -18px;   height: 40px; line-height: 20px;" type="submit">Buscar</button> </form>

    <table class="table table-striped col-12" id="productos-result" style="table-layout: fixed;overflow-wrap: break-word; text-align: center;">    

      <thead>
        <tr  style="background-color: #bfbfa4;">
         <th style="width:429px;" >Producto</th>
         <th style="width:74px;">Stock</th>
         <th style="width:94px;">Precio</th>
         <th style="width:144px;">Proveedor</th>
         <th style="width:99px;">Accion</th>
       </tr>
     </thead>
     <tbody id="tabla">  
     <button onclick ="funcion()" type="button" style="width: 50px;height: 50px;background-color: red;margin-top: 96px;" >
       sasasa
     </button>
       <?php foreach($products as $pro) : ?> 
        <tr  <?php if(($pro['alerta_stock'])>=($pro['stock'])) : ?> style="background: #d9675f;" 
        <?php else : ?>style="background: #78e37f;" <?php endif;?> >
          <td style="vertical-align: middle;text-align: left;"><?=  $pro['nombre']?></td>
          <td style="vertical-align: middle;"><?=  $pro['stock']?></td>
          <td style="vertical-align: middle;">$<?=  $pro['precio']?></td>
          <td style="vertical-align: middle;"><?=  $pro['proveedor']?></td>
          <td style="vertical-align: middle;">
            <a href="?controller=producto&action=editar&id=<?=$pro['id'];?>" class="btn btn-warning" style="display:inline-block;margin-bottom:4px;color: #4890c7;font-weight: 500;background:white;border-color:#4890c7;width: 88px;">Editar</a>
            <a href="<?=base_url?>/?controller=producto&action=eliminar&id=<?=$pro['id'];?>" class="btn btn-warning" style="display:inline-block;margin-bottom:4px;color: #c74a48;font-weight: 500;background:white;border-color:#c74a48;width: 88px;">Eliminar</a>
          </td>
        </tr> 
      <?php endforeach;?> 
    </tbody>
  </table> 

<script>
  function funcion(){ 
var xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var productos=json.parse(this.responseText);
    console.log(productos);
  }}
};
xhttp.open("GET", "http://localhost:8080/LaEstancia//?controller=producto&action=compra", true);
xhttp.send();
</script>
</div>

<?php $mensaje="Nuevo Producto"?> <?php if(isset($editar)) : $mensaje="Editar Producto"; endif;?>
  <div class="col-4" style="margin-top:70px; float:right;display: inline-block;">

    <h1 style="display: inline-block;margin-top: 60px;    margin-left: 62px;"> <?php echo $mensaje ?></h1>

    <?php $action="http://localhost:8080/ferreteria/?controller=producto&action=guardar" ?>
    <?php if(isset($editar)) : ?> <?php $action="http://localhost:8080/ferreteria/?controller=producto&action=modificar"?> <?php endif;?>

    <form class="crearp mt-0"  method="POST" action="<?php echo $action ?>">

      <div class="form-row">
        <div class="form-group col-12">
          <input type="text" class="form-control"  name="nombre" id="nombre"  style="background-color: #f5ecda;" <?php if(isset($editar)) :?> value="<?php echo $editar['nombre'] ?>"  <?php else : ?> placeholder="Ingrese el nombre del producto" <?php endif;?>>
        </div>

      </div>
      <div class="form-group col-7" style="margin-left: -15px; display:inline-block;">
        <label for="precio">Precio</label>
        <input  type="number" min="0" name="precio" max="9999999" step="0.01" class="form-control col-8" style="display: inline-block; background-color: #f5ecda;" id="precio" <?php if(isset($editar)) :?> value="<?php echo $editar['precio'] ?>"  <?php else : ?>placeholder="$ 99,99" <?php endif;?>>
      </div>

      <div class="form-row">
        <div class="form-group col-12">
          <label for="alerta_stock">Faltante cuando queden</label>
          <input type="number" min="1" name="alerta_stock" placeholder="unidades" class="form-control col-6" style="display: inline-block;background-color: #f5ecda;float: right; margin-left: 1px; margin-top: -5px;" id="alerta_stock" <?php if(isset($editar)) :?> value="<?php echo $editar['alerta_stock'] ?>"  <?php else : ?> placeholder="unidades" <?php endif;?>>
        </div>

        <div class="form-group col-12" style="margin-left: 1px; display:inline-block;float:right;">
          <label for="stock">Stock</label>
          <input type="number" min="1" name="stock" class="form-control col-6" style="display: inline-block;background-color: #f5ecda;" id="stock" <?php if(isset($editar)) :?> value="<?php echo $editar['stock'] ?>"  <?php else:?> placeholder="Unidades"
        <?php endif;?>>
      </div>

      <?php if(isset($editar)) : ?> <input type="hidden" name="id_prod" value="<?php echo $editar['id']?>"><?php endif;?>
      <button  id="enviar" type="submit"  class="btn btn-warning" style="display:inline-block;margin-bottom:4px;color: #c74a48;font-weight: 500;background:white;border-color:#c74a48;width: 88px;margin-left: 304px;"><?php if(isset($editar)):?> Editar <?php else :?> Guardar </button> <?php endif;?> 

    </div>  
  </form>
</div>

