<div class="col-6" style="float:left;margin-top: 67px; display: inline-block;border-right: 2px solid black;">

     <table class="table table-striped col-12" id="productos-result" style="table-layout: fixed;overflow-wrap: break-word; text-align: center;">    

          <thead>
            <tr  style="background-color: #bfbfa4;">
             <th style="width:15%">Fecha</th>
              <th style="width:15%">Proveedor</th>
              <th style="width: 15%;">Accion</th>
            </tr>
          </thead>
          <tbody id="container">  
            <?php  if (isset($esperados)) : ?>
              
   <?php foreach ($esperados as $key => $value) : ?>
    
      <tr>
      <td style="width: 100px;line-height: 140px;font-weight: bold;font-size: 33px;vertical-align: middle;"> <?= $value['fecha'] ?></td>
      <td style="width: 100px;line-height: 140px;font-weight: bold;font-size: 33px;vertical-align: middle;"> <?= $value['proveedor'] ?></td>
      <td style="width=100px;vertical-align: middle;">
        
        <form method="POST" action="<?=base_url?>/?controller=pedido&action=recibido">
          <input type="hidden" name="id" value="<?=$value['numpedido'];?>" >
          <input type="hidden" name="proveedor" value="<?=$value['proveedor'];?>" >
          <input type="hidden" name="fecha" value="<?=$value['fecha'];?>" >
          <input class="btn btn-warning" style="display: inline-block;width: 68%;font-weight: 500;" type="submit" value="Recibido">
        </form>
        <div style="display: block;">
        <a href="<?=base_url?>/?controller=pedido&action=mostrar&id=<?=$value['numpedido'];?>&proveedor=<?=$value['proveedor'];?>&fecha=<?=$value['fecha'];?>" class="btn btn-warning" style="display: inline-block;width: 68%; margin-bottom: 15px;font-weight: 500;">Ver</a>
        <a href="<?=base_url?>/?controller=pedido&action=deshacer&id=<?=$value['numpedido'];?>&proveedor=<?=$value['proveedor'];?>&fecha=<?=$value['fecha'];?>" class="btn btn-warning" style="display: inline-block;width: 68%; margin-bottom: 6px;font-weight: 500;">Deshacer</a>
      </div>
     </td>
     </tr> 
<?php endforeach;?>
<?php endif; ?>
    </tbody>
  </table>
</div>
<div class="col-6" style="float:right;margin-top: 67px; display: inline-block;border-right: 2px solid black;">

     <table class="table table-striped col-12" id="productos-result" style="table-layout: fixed;overflow-wrap: break-word; text-align: center;">    

          <thead>
            <tr  style="background-color: #bfbfa4;">
             <th style="width:70%">Producto</th>
              <th style="width: 30%;">Cantidad</th>
            </tr>
          </thead>
          <tbody id="container">  
            <?php  if (isset($pedido)) : ?>
              
   <?php foreach ($pedido as $key => $value) : ?>
      <tr>
      <td style="width: 100px;vertical-align: middle;"> <?= $value['producto'] ?></td>
      <td style="width:100px;vertical-align: middle;">
        <?= $value['cantidad'] ?>
     </td>
     </tr> 
     <?php $_SESSION['pdf'][$key]=array('producto'=>$value['producto'],'cantidad'=>$value['cantidad'],'proveedor'=>$value['proveedor']); ?>
<?php endforeach;?>
 <tr>
      <td style="width: 100px;vertical-align: middle;"></td>
      <td style="width:100px;vertical-align: middle;">
        <a href="<?=base_url?>/?controller=pedido&action=generarpdf" target="_blank" class="btn btn-info">Generar PDF</a>
      
     </td>
     </tr> 
<?php endif; ?>
    </tbody>
  </table>
</div>

