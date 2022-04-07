 <div class="col-12 bg-white">
      <div class="row p-2 d-flex">
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;" href="<?=base_url?>?controller=usuario&action=inicio">COMANDAS
       </a>
      
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center"  style="text-decoration: none;" href="<?=base_url?>?controller=usuario&action=logout">CERRAR SESION
       </a>
     </div>
     
   <div class="row">
       <div class="col-sm-6 col-12">
        <div class="row">
         <div class="col-12">
          <form action="?controller=comanda&action=agregarproducto" method="POST">

           <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>
           <?php echo '<h5 class="d-inline-block" >MESA:</h5> <input class="w-25 d-inline" type="text" value="'.$mesa_seleccionada['numero_mesa'].'"  readonly > <input type="hidden" value="'.$mesa_seleccionada['numero_mesa'].'" name="mesa"';endif?>
         </div>
       </div>
       <div class="row d-flex">
        <div class="col-sm-6 col-12 d-inline-block">
                 <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>

         <input type="text" id="palabra" name="producto" autocomplete="off" class="form-control py-1 w-sm-100 w-75 ml-sm-1 ml-2 mb-3" value="" onfocus="busqueda();" onkeyup="busqueda();" placeholder="BUSCA UN PRODUCTO" name="search" required="true">
       </div>
       <div class="col-sm-6 col-12 d-inline-block">

         <label class="d-inline-block font-weight-bold ml-sm-1 ml-2 "  >CANTIDAD</label>
         <input class="d-inline-block w-25" min="1" type="number" id="cantidad" autocomplete="off" step="1" name="cantidad" required="true">
         <input class="d-inline-block btn-info" style="border-radius:0.3em;text-align: center; text-decoration: none;" type="submit" value="AGREGAR">
       <?php endif;?>
       </div>

     </form>

    </div>


  
    <div class="row" style="height: 20em; overflow: scroll;" id="datos" onload="busqueda();"></div>
    <script type="text/javascript">
     function busqueda(){
      var texto=document.getElementById("palabra").value;
      var parametros = {
        "texto": texto
      };


      $.ajax({
        data:parametros,
        url: 'buscadorcomanda.php',
        type:'GET',
        success: function(response){

          $("#datos").html(response);
          console.log(response);
        }
      });
    document.getElementById('palabra').addEventListener("keyup",function(){
       var codi= event.keyCode;
       if (codi==40) {
        document.getElementById('#fila-1').focus();
        };
    })}
  

    function seleccionarcodigo(response){
            document.getElementById("palabra").value=response['codigo'];
            document.getElementById('cantidad').focus();
            
    }

  
    </script>  <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>
    <?php echo '</div>'; endif;?> 
    </div>
    <div class="col-sm-6 col-12">
      <div class="row">
       <div class="col-3">
        <?php if(isset($mesa_seleccionada)):?>
          <?php echo '<h5 class="mt-4" style="display:inline-block;" >MESA: '.$mesa_seleccionada['numero_mesa'].'</h5>';endif?>
        </div>
        <div class="col-sm-9 col-12">

          <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>
          <?php echo '<form class="d-flex align-items-center float-right" action="?controller=comanda&action=cerrarmesa" method="POST"><input type="hidden" name="numeromesa" value="'. $mesa_seleccionada['numero_mesa'].'"></input>
           <input type="checkbox" class="font-weight-bold" name="posnet">POSNET</input> 
            <input type="submit" class="btn-success mt-2 my-2 mx-1 py-2 px-1 float-right" style="border-radius:0.3em;text-decoration: none;" value="CERRAR MESA"></input></form>';?>
          <?php elseif(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==1) and (isset($mozos))):?>
          <?php echo '<form class="mt-2 w-100 d-inline-block" action="?controller=comanda&action=abrirmesa" method="POST"><input type="hidden" name="mesa" value="'.$mesa_seleccionada['numero_mesa'].'"></input> <h5 class="d-inline-block mr-1">MOZO</h5> <select class="form-control w-50 mt-2 d-inline-block"  name="mozo">';?>;?>
          <?php foreach($mozos as $mozo):?>
            <?php echo '<option value="'.$mozo['id'].'">'.$mozo['nombre'].'</option>';?>
          <?php endforeach;?>
          <?php echo '</select> <input class="btn-success mt-2  my-2 mx-1 py-2 px-1" style="border-radius:0.3em;text-decoration: none;" type="submit" value="ABRIR MESA"></input></form>';endif;?>

        </div>
      </div>
      <?php foreach ($mesas as $mesa) :?>

       <?php if ($mesa['numero_mesa']%12==1 or $mesa['numero_mesa']==1): ?>

        <div class="row mt-2 mb-1 p-1">

         <div class="col-sm-1 col-1 mt-2">

          <a class="btn-light p-sm-2 p-1 border-dark border-1 " <?php if($mesa['estado']==0):?><?php echo 'style="background-color:green;"'?><?php elseif($mesa['estado']==1):?><?php echo 'style="background-color:gray;"'?><?php endif;?> href="?controller=comanda&action=seleccionarmesa&mesa=<?php echo $mesa['numero_mesa'];?>"><?= $mesa['numero_mesa'];?></a>
        </div>


        <?php else :?>
         <div class="col-sm-1 col-1 mt-2">

          <a class="btn-light p-sm-2 p-1 border-dark border-1 " <?php if($mesa['estado']==0):?><?php echo 'style="background-color:green;"'?><?php elseif($mesa['estado']==1):?><?php echo 'style="background-color:gray;"'?><?php endif;?>  href="?controller=comanda&action=seleccionarmesa&mesa=<?php echo $mesa['numero_mesa'];?>"><?= $mesa['numero_mesa'];?></a>
        </div>
      <?php endif ?>
      <?php if ($mesa['numero_mesa']%12==0): ?>
        </div> <?php endif?>
      <?php endforeach;?> 
      
    </div>
    <div class="row mt-2 mb-1 p-sm-1">
        <div class="col-sm-12 col-12">
        <table class="table table-dark text-center">
          <thead> 
            <tr>
              <th class="text-left">MESA: <?php if(isset($mesanro)){echo $mesanro;};?></th>
              <?php $href="?controller=comanda&action=editarfactura";?>
               <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>

              <?php if(isset($mesanro)):?><?php $href="?controller=comanda&action=editarfactura&mesa=".$mesanro;endif;?>
              <th></th>
              <th></th>
              <th class="text-right"><a href="<?php echo $href;?>"  class="btn-info p-sm-2  p-1 float-right">EDITAR</a>
                 <?php endif;?>

              </th>


            </tr>
            <tr>
            <th>PRODUCTO</th>
            <th> CANTIDAD</th>
            <th> PRECIO</th>
            <th>TOTAL</th>

            <?php if($_SESSION['editar']==true):?>
              <th>ACCIÓN</th>
            <?php endif;?>
            </tr>
          </thead>
          <tbody>
              <?php if($_SESSION['editar']==true):?>
              <?php $total=0;?>
              <?php foreach($factura as $obj):?>
              <?php $subtotal=$obj['precio']*$obj['cantidad'];?>
              <?php $total=$total+$obj['precio']*$obj['cantidad'];?>
              <?php echo '<tr><td class="text-center">'.$obj['producto'].'</td>'.'<td>'.'<form action="?controller=comanda&action=editarventa" method="POST"><input class="w-50" type="number" min="0" required="true" name="cantidad"><input type="hidden" name="fecha" value="'.$obj['fecha'].'"><input type="hidden" name="comanda" value="'.$obj['comanda'].'">'.'</td><input type="hidden" name="mesa" value="'.$mesa_seleccionada['numero_mesa'].'">'.'<td>'.$obj['precio'].'</td>'.'<td>'.number_format($subtotal,2,',','.').'</td><td><input class="btn-primary" type="submit" value="GUARDAR"></form></td></tr>';?>
              <?php endforeach;endif;?>
            <?php if(isset($factura) and ($factura!=false) and ($_SESSION['editar']!=true)):?>
              <?php $total=0;?>
              <?php foreach($factura as $obj):?>
              <?php $subtotal=$obj['precio']*$obj['cantidad'];?>
              <?php $total=$total+$obj['precio']*$obj['cantidad'];?>
              <?php echo '<tr><td class="text-left">'.$obj['producto'].'</td>'.'<td>'.$obj['cantidad'].'</td>'.'<td>'.$obj['precio'].'</td>'.'<td>'.number_format($subtotal,2,',','.').'</td></tr>';?>
              <?php endforeach;?>
              <?php if(isset($descuento)):?>
  <?php echo '<tr><td class="text-left" colspan="3">DESCUENTO</td><td>'.number_format($descuento,2,',','.').'</td></tr>';endif;?>
             <?php if(!isset($descuento)):?>
              <?php echo '<tr><td class="text-left">DESCUENTO</td><td><form action="?controller=comanda&action=aplicardescuento" method="POST"><input type="number" min="1" max="10" placeholder="%" name="descuento"><input class="btn-secondary" type="hidden" name="mesa" value="'.$mesanro.'"> <input type="hidden" name="total" value="'.$total.'"> <input  class="btn-secondary mt-2" type="SUBMIT" value="APLICAR"></form></td></tr>';endif;?>
<?php if(isset($descuento)):?><?php $total=$total-$descuento;endif;?>

              <?php echo '<tr><td class="text-left" colspan="3">TOTAL</td><td>'.number_format($total,2,',','.').'</td></tr><tr><td class="text-left" colspan="3"><form action="?controller=comanda&action=imprimir" method="POST"><input class="btn-secondary" type="hidden" name="mesa" value="'.$mesanro.'"> <input type="SUBMIT" value="IMPRIMIR" >

</form></td></tr>'; endif;?>


          </tbody>
        </table>
      </div>
    </div>
  
    </div>
    </div>
