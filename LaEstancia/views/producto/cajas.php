<div class="col-6" style="float:left; display: inline-block;">
   
      <table class="table table-striped col-12" id="productos-result"  style="table-layout: fixed;overflow-wrap: break-word; text-align: center;margin-top: 72px;">    
          <thead>
            <tr style="background-color: #bfbfa4;">
       
              <th style="width:40%;" >MES</th>
               <th style="width:20%;" >AÑO</th>

              <th style="width:40%;">TOTAL</th>
            
            </tr>
          </thead>
          <tbody id="container">  
      
   <?php foreach($cajasmes as $obj) : ?> 
   <tr >
      <td style="vertical-align: middle;"><?=  $obj['mes'] ?></td>
      <td style="vertical-align: middle;"><?=  $obj['ano'] ?></td>
      <td style="vertical-align: middle;text-align: center;">$ <?=  $obj['total']?></td>

      
    </tr> 
  <?php endforeach; ?> 
    </tbody>
        </table > 
         </div>
 <div class="col-6" style="float:right; display: inline-block;margin-top: 72px;">
   
      <table class="table table-striped col-12" id="productos-result"  style="table-layout: fixed;overflow-wrap: break-word; text-align: center;">    

          <thead>
            <tr style="background-color: #bfbfa4;">
       
              <th style="width:50%;" >ULTIMOS DIAS</th>
              <th style="width:50%;">TOTAL</th>
            
            </tr>
          </thead>
          <tbody id="container">  
      
   <?php foreach($cajas as $pro) : ?> 
   <tr >
      <td style="vertical-align: middle;"><?=  $pro['dia'] ?> <?=  $pro['fecha'] ?></td>
      <td style="vertical-align: middle;text-align: center;">$ <?=  $pro['total']?></td>

      
    </tr> 
  <?php endforeach; ?> 
    </tbody>
        </table > 
         </div>
 