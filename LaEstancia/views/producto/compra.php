 <div class="col-8" style="float:left; display: inline-block;">
 <a href="<?=base_url?>/?controller=producto&action=index" ><input id="btn-producto-nuevo" type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;"value="Nuevo Producto"></a>

<?php if (!isset($_SESSION['caja']))   :
         $_SESSION['caja'] =0.00; endif?>
 <h4 style="display: inline-block;margin-top: 60px;float:right;padding:10px;color:white;border-radius:5px;background-color:#6490b0; margin-right: 0px;">Ventas: <?php echo $_SESSION['caja'];?></h4>
   <a href="<?=base_url?>/?controller=producto&action=vaciarcaja" ><input id="btn-producto-nuevo" type="button" class="btn btn-warning" style="margin-top: 70px;font-weight: 500;"value="Vaciar Ventas"></a>
   <form method="post" action="<?=base_url?>/?controller=producto&action=buscarcompra" class="col-12" style="margin-top: 5px; margin-bottom: 5px;display: inline-block;margin-left: -15px;">
    <input name="search" class="form-control mr-sm-4 col-8" type="text" style="margin-top: 15px; margin-bottom: 5px;display: inline-block;" placeholder="Introduzca el nombre del producto que desea buscar..." aria-label="Search"> 
     <button class="btn btn-secondary btn-lg disabled mb-2 mr-5" style="margin-left: -18px;   height: 40px; line-height: 20px;" type="submit">Buscar</button> </form>

      <table class="table table-striped col-12" id="productos-result"  style="table-layout: fixed;overflow-wrap: break-word; text-align: center;">    

          <thead>
            <tr style="background-color: #bfbfa4;">
       
              <th style="width:303px;" >Producto</th>
              <th style="width:49px;">Stock</th>
              <th style="width:72px;">Precio</th>
              <th style="width:90px;">Proveedor</th>
               <th style="width:67px;">Accion</th>
            </tr>
          </thead>
          <tbody id="container">  
      
   <?php foreach($products as $pro) : ?> 
   <tr  <?php if(($pro['alerta_stock'])>=($pro['stock'])) : ?> style="background: #d9675f;" <?php else : ?>style="background: #78e37f;" <?php endif;?>>
      <td style="vertical-align: middle;text-align: left;"><?=  $pro['nombre']?></td>
      <td style="vertical-align: middle;"><?=  $pro['stock']?></td>
      <td style="vertical-align: middle;">$<?=  $pro['precio']?></td>
      <td style="vertical-align: middle;"><?=  $pro['proveedor']?></td>
        <?php if($pro['stock']>0) : ?>
      <td style="vertical-align: middle;">

        <form action="<?=base_url?>/?controller=producto&action=vender" method="GET">
            <input type="hidden" name="controller" value="producto">
              <input type="hidden" name="action" value="vender">
         <input type="hidden" name="id" value="<?php echo $pro['id'];?>">
         <input type="hidden" name="stock" value="<?php echo $pro['stock'];?>">
  <input type="hidden" name="nombre" value="<?php echo $pro['nombre'];?>">
    <input type="hidden" name="precio" value="<?php echo $pro['precio'];?>">
  
    <input type="submit" class="btn btn-info" style="color: black;background: white;border-color: black;font-weight: 500;" value="Agregar"></form>
      </td>
      <?php else :?>
        <td style="vertical-align: middle;"><h6>Sin Stock</h6></td>
    <?php endif;?>
    </tr> 
  <?php endforeach; ?> 
    </tbody>
        </table > 
         </div>
         <div class="col-4" style="margin-top:70px; float:right;display: inline-block;">
            <h1 style="display: inline-block;margin-top: 60px;    margin-left: 64px;">NUEVA VENTA</h1>
          <form method="GET" action="<?=base_url?>/?controller=producto&action=guardarcompra"  style="padding: 15px; border-radius: 5px; background: #bfbfa3 ;" >
             <input type="hidden" name="controller" value="producto">
              <input type="hidden" name="action" value="guardarcompra">
            <table class="table table-striped col-12" id="productos-result">    

          <thead style="background: #98ab80;">
            <tr>
                <th style="width: 40%;">Producto</th>
              <th style="width: 20%;">Cantidad</th>
              <th style="width: 20%;">Precio</th>
              <th style="width: 20%;">Accion</th>
            </tr>
          </thead>
        
    <tbody id="container"> 
     
             <?php if (isset($_SESSION['compra'])) : ?>
                       
           <?php foreach ($_SESSION['compra'] as $key => $value)  : ?>
            <tr>
             
            <td  style="width: 40%;vertical-align: middle;text-align: left;" > <?php  echo $value['producto'];?> </td>
            <td style="width: 20%;vertical-align: middle;">
             <input style="width: 75%;margin-left: 10px;background:#f0e7d3;border: solid 1px #c0b8a8;" type="number"  
             name="cantidad<?php  echo $key;?>" value="" step="1" min="1" max="<?php echo $value['stock']?>">
            <td style="width: 20%;vertical-align: middle;" > <?php  echo  $value['precio'];?> </td>
              <input type="hidden" name="id" value="<?php echo $pro['id'];?>">
            <input type="hidden" name="producto" value="<?php  echo $value['producto'];?>">
            <input type="hidden" name="precio" value="<?php  echo $value['precio'];?>">
            <td  style="width: 20%;"> <a href="<?=base_url?>/?controller=producto&action=quitarproducto&id=<?php echo $key;?>" class="btn btn-info" style="color: black;background: white;border-color: black;font-weight: 500;margin-top: 35px;" name="borrar"> Quitar</a></td>
          </tr>
           <?php endforeach;?>

            </tbody>

          </table>
           
           <div class="col-12">

            <h5>Cuentas</h5>
            <select style="width: 97%; background:#f0e7d3;border: solid 1px #c0b8a8;" name="clienteId"> 
            <option value="">Clientes</option> 
            <?php foreach ($clientes as  $cliente) :?>
            
              <option  value="<?php echo $cliente['id'];?>"><?= $cliente['nombre']." contacto: ".$cliente['contacto'] ; ?>

                </option>

            <?php endforeach;?>
          </select>
                      <h5  style="display: block;margin-top: 13px;margin-bottom: 13px; font-weight: bold;">Nueva cuenta corriente</h5>

            <label for="cliente" style="display: inline-block;font-weight: bold;">Cliente</label>
           <input type="text" name="cliente"  style="display: inline-block; background:#f0e7d3; border: solid 1px #c0b8a8;margin-left: 16px; width: 77%;">
         </div>
         <div class="col-12">
                 <label for="contacto" style="display: inline-block;font-weight: bold;">Contacto</label>
            <input type="text" name="contacto"  style="display: inline-block; background:#f0e7d3;border: solid 1px #c0b8a8;width: 77%;">
         </div>

           <input type="submit"  value ="CONFIRMAR VENTA" class="btn btn-success" style="margin-top: 20px;background: #c74a48; margin-left: 221px;border-color:#c74a48; ">
          <?php endif;?>
           </form>

        </div>
