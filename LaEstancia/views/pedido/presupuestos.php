<div class="col-6" style="float:left; display: inline-block;border-right: 2px solid black;margin-top: 63px;">
    
   <form method="post" action="<?=base_url?>/?controller=pedido&action=buscarpresupuesto" class="col-12" style="margin-top: -15px; margin-bottom: 1px;display: inline-block;margin-left: -15px;">
    <input name="search" class="form-control mr-sm-4 col-8" type="text" style="margin-top: 15px; margin-bottom: 5px;display: inline-block;" placeholder="Introduzca el nombre del producto o proveedor..." aria-label="Search"> 
     <button class="btn btn-secondary btn-lg disabled mb-2 mr-5" style="margin-left: -18px;   height: 40px; line-height: 20px;" type="submit">Buscar</button> </form>
     
      <table class="table table-striped col-12" id="productos-result" style="table-layout: fixed;overflow-wrap: break-word; text-align: center;margin-top: 15px;">    

          <thead>
            <tr  style="background-color: #bfbfa4;">
                   <th style="width:40%; ">Producto</th>
             <th style="width:15%">Stock</th>
  
              <th style="width:15%;">Precio</th>
              <th style="width: 17%;">Accion</th>
            </tr>
          </thead>
          <tbody id="container">  
            <?php if (isset($faltantes)) : ?>
              
          
   <?php foreach($faltantes as $faltante) : ?> 
      <tr>
      <td style="vertical-align: middle;"><?=  $faltante['producto'] ?></td>
      <td style="vertical-align: middle;"><?=  $faltante['stock']?></td>
       <td style="vertical-align: middle;"><?=  $faltante['precioventa']?></td>
      
      <td style="width=100px;vertical-align: middle;">
        <a href="<?=base_url?>/?controller=pedido&action=agregarpresupuesto&producto=<?=$faltante['producto'];?>&id=<?=$faltante['id'];?>&precio=<?= $faltante['precioventa']?>"  class="btn btn-info" style="color: black;background: white;border-color: black;font-weight: 500;">Agregar</a>

     </td>
     </tr> 
<?php endforeach;?>
<?php endif; ?>
    </tbody>
  </table>
</div>
<div class="col-6" " style="float:right; display: inline-block;">

     <form method="POST" action="<?=base_url?>/?controller=pedido&action=generarpresupuesto" target="_blank" style="padding: 15px; border-radius: 5px;margin-top: 115px; background: #bfbfa3 ;" >
   <h1  style="margin-top: -10px; display: inline-block;margin-left: 260px;margin-bottom: -19px;"> Presupuesto</h1>
 <a class="btn btn-warning" href="<?=base_url?>/?controller=pedido&action=vaciarpresupuesto" style="margin-top: 0px;margin-bottom:12px;color:white;background: #c74a48;margin-bottom:-26px;float:right;border-color:#c74a48;"> Vaciar</a>
            <table class="table table-striped col-12" id="productos-result" style="margin-top: 27px;">    

          <thead style="background: #98ab80;">
            <tr >
                <th style="width: 70%;">Producto</th>
              <th style="width: 15%;">Cantidad</th>
              <th style="width: 15%;">Accion</th>
            </tr>
          </thead>
        
    <tbody id="container"> 
     
             <?php if (isset($_SESSION['presupuesto'])) : ?>
           <?php foreach ($_SESSION['presupuesto'] as $key => $value)  : ?>
            <tr>
             
            <td  style="width: 40%;vertical-align: middle;" > <?php  echo $_SESSION['presupuesto'][$key]['producto'];?> </td>
            <td style="width: 20%;">
             <input style="width: 75%;margin-left: 10px;vertical-align: middle;background:#f0e7d3;border: solid 1px #c0b8a8;" type="text" name="cantidad<?php echo $key ;?>"> </td>
            <td  style="width: 20%;vertical-align: middle;"> <a href="<?=base_url?>/?controller=pedido&action=quitarpresupuesto&producto=<?php echo $key;?>" class="btn btn-info" style="color: black;background: white;border-color: black;font-weight: 500;" > Quitar</a></td>
          </tr>
           <?php endforeach;?>

            </tbody>

          </table>
           
        

           <input type="submit"  value ="Confirmar presupuesto" class="btn btn-warning" style="margin-top: 20px;background: #c74a48; margin-left: 245px;border-color:#c74a48; color: white; ">
          <?php endif;?>

          </form>
</div>
 