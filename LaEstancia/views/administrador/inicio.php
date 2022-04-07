    <div class="col-12 bg-white">
      <div class="row p-2 d-flex">
     <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" id="comandas" style="text-decoration: none;" href="<?=base_url?>?controller=comanda&action=seleccionarmesa">COMANDAS
       </a>
       <style>
        @font-face {
font-family: Redmilk;
src: url('fonts/Redmilk.otf');
}
#comandas{
  font-family: Redmilk !important;
  font-weight: 700;
}</style>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;" href="<?=base_url?>?controller=usuario&action=productos">ADMINISTRACIÓN
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;" href="<?=base_url?>?controller=usuario&action=estadisticas">ESTADISTICAS
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;" href="<?=base_url?>?controller=caja&action=index">CAJAS
       </a> 
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;" href="<?=base_url?>?controller=usuario&action=usuarios">USUARIOS
       </a>  
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center"  style="text-decoration: none;" href="<?=base_url?>?controller=usuario&action=logout">CERRAR SESIÓN
       </a> 
     </div>
        <div class="row">
         <div class="col-12">
          <?php $ruta="?controller=caja&action=abrircaja";$valor="ABRIR CAJA";?>
          <?php $valor="ABRIR CAJA";?>

          <?php if(isset($estadocaja) and ($estadocaja=="abierta")):?>
          <?php $ruta="?controller=caja&action=cerrarcaja";$dinerocaja="";$valor="CERRAR CAJA";endif;?>

          <form action="<?php echo $ruta;?>" id="formulario"  onsubmit="mostrarventana()"  method="POST" class=" d-inline-block">
            <input type="submit"id="cerrar" class="btn-info border-info p-2 d-inline-block" value="<?php echo $valor;?>">

          </form>

        </div>
      </div>
      <script type="text/javascript">
        function mostrarventana(){
          if(document.getElementById('cerrar').value=="CERRAR CAJA"){
            var respuesta=confirm("estas seguro de cerrar caja?");
            if (respuesta ==true) {
              document.getElementById('formulario').setAttribute("action","?controller=caja&action=cerrarcaja&respuesta=true");
            }else{
              document.getElementById('formulario').setAttribute("action","?controller=caja&action=cerrarcaja&respuesta=false");

            }
          }
        }
      </script>
     <div class="row">
       <div class="col-5">
        <div class="row">
         <div class="col-12">
          <form action="?controller=comanda&action=agregarproducto" method="POST">

           <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>
           <?php echo '<h5 class="d-inline-block" >MESA:</h5> <input class="w-25 d-inline" type="text" value="'.$mesa_seleccionada['numero_mesa'].'"  readonly > <input type="hidden" value="'.$mesa_seleccionada['numero_mesa'].'" name="mesa"';endif?>
         </div>
       </div>
       <div class="row d-flex">
        <div class="col-6 d-inline-block">
                 <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>

         <input type="text" id="palabra" name="producto" class="form-control py-1 w-100 mb-3" value="" onkeyup="busqueda();" placeholder="BUSCA UN PRODUCTO" name="search" required="true">
       </div>
       <div class="col-6 d-inline-block">

         <label class="d-inline-block font-weight-bold" >CANTIDAD</label>
         <input class="d-inline-block w-25" min="1" id="cantidad" type="number" step="1" name="cantidad" required="true">
         <input class="d-inline-block btn-info" style="border-radius:0.3em;text-align: center; text-decoration: none;" type="submit" value="AGREGAR">
       <?php endif;?>
       </div>

     </form>

    </div>


    <div class="row "  id="datos" onload="busqueda();"></div>
    <script type="text/javascript">
      function seleccionarcodigo(codigo){
        document.getElementById('palabra').value=codigo['codigo'];
        document.getElementById('cantidad').focus();
      }
    </script>
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
    }
    </script>
    <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>
    <?php echo '</div>'; endif;?> 
    </div>
    <div class="col-7">
      <div class="row">
       <div class="col-3">
        <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>
          <?php echo '<h5 class="mt-4" style="display:inline-block;" >MESA: '.$mesa_seleccionada['numero_mesa'].'</h5><br><h5>MOZO:'.$moz.'</h5>';?>
          <form action="?controller=comanda&action=seleccionarmesa" method="POST">
            <input type="hidden" name="mesa" value="<?= $mesa_seleccionada['numero_mesa'];?>">
            <select name="mozo">
          <?php foreach ($mozos as $mozo) :?>
            <option value="<?= $mozo['id']?>"  ><?= $mozo['nombre']?></option>
           <?php endforeach;?>
         </select>
           <input type="submit" class="btn-secondary" value="CAMBIAR MOZO"></form>
        <?php endif?>
        </div>

        <div class="col-9">

          <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>
          <?php echo '<form class="d-flex align-items-center float-right" action="?controller=comanda&action=cerrarmesa" method="POST"><input type="hidden" name="numeromesa" value="'. $mesa_seleccionada['numero_mesa'].'"></input>
           <input type="checkbox" class="font-weight-bold" name="posnet">POSNET</input> 
            <input type="submit" class="btn-success mt-2 my-2 mx-1 py-2 px-1 float-right" style="border-radius:0.3em;text-decoration: none;" id="cerrarmesajs" value="CERRAR MESA"></input></form>';?>
          <?php elseif(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==1) and (isset($mozos))):?>
          <?php echo '<form class="mt-2 w-100 d-inline-block" action="?controller=comanda&action=abrirmesa" method="POST"><input type="hidden" name="mesa" value="'.$mesa_seleccionada['numero_mesa'].'"></input> <select class="form-control w-75 mt-2 d-inline-block" name="mozo"><option>SELECCIONAR MOZO</option>';?>
          <?php foreach($mozos as $mozo):?>
            <?php echo '<option value="'.$mozo['id'].'">'.$mozo['nombre'].'</option>';?>
          <?php endforeach;?>
          <?php echo '</select> <input class="btn-success mt-2  my-2 mx-1 py-2 px-1" style="border-radius:0.3em;text-decoration: none;" type="submit" value="ABRIR MESA"></input></form>';endif;?>

        </div>
      </div><?php foreach ($mesas as $mesa) :?>

       <?php if ($mesa['numero_mesa']%18==1 or $mesa['numero_mesa']==1): ?>

        <div class="row mt-2 mb-1 ml-1 p-1">

         
 
          <a class="btn-light p-sm-2 p-1 d-inline-block border-dark border-1 mt-2 mx-1 "  <?php if($mesa['estado']==0):?><?php echo 'style="margin-right:1px;background-color: #27b940;color: white;border-radius: 100%;font-weight: bold;" id="mesa_'.$mesa['numero_mesa'].'"'?><?php elseif($mesa['estado']==1):?><?php echo 'style="margin-right:1px;background-color: #191818;margin-left:1px;color: white; border-radius: 100%;font-weight: bold;" id="mesa_'.$mesa['numero_mesa'].'"';?><?php endif;?> href="?controller=comanda&action=seleccionarmesa&mesa=<?php echo $mesa['numero_mesa'];?>"><?= $mesa['numero_mesa'];?></a>
       


        <?php else :?>
        

          <a class="btn-light p-sm-2 p-1 d-inline-block border-dark border-1 mx-1 mt-2" <?php if($mesa['estado']==0):?><?php echo 'style="margin-right:1px;background-color: #27b940;color: white;margin-left:1px;border-radius: 100%;font-weight: bold;" id="mesa_'.$mesa['numero_mesa'].'"';?><?php elseif($mesa['estado']==1):?><?php echo 'style="background-color: #191818;color: white; border-radius: 100%;font-weight: bold;margin-left:1px;" id="mesa_'.$mesa['numero_mesa'].'"';?><?php endif;?>  href="?controller=comanda&action=seleccionarmesa&mesa=<?php echo $mesa['numero_mesa'];?>"><?= $mesa['numero_mesa'];?></a>
        
      <?php endif ?>
      <?php if ($mesa['numero_mesa']%18==0): ?>
<br>
         <?php endif?>
      <?php endforeach;?> 
      
    </div></div></div></div>
    <div class="row mt-2 mb-1 p-1">
        <div class="col-12">
        <table class="table table-dark text-center">
          <thead> 
            <tr>
              <th class="text-left">MESA: <?php if(isset($mesanro)){echo $mesanro;};?></th>
              <?php $href="?controller=comanda&action=editarfactura";?>
               <?php if(isset($mesa_seleccionada) and ($mesa_seleccionada['estado']==0)):?>

              <?php if(isset($mesanro)):?><?php $href="?controller=comanda&action=editarfactura&mesa=".$mesanro;endif;?>
              <th></th>
              <th></th>
              <th class="text-right"><a href="<?php echo $href;?>"  class="btn-info p-2 float-right">EDITAR</a>
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
              <?php echo '<tr><td class="text-left">DESCUENTO</td><td><form action="?controller=comanda&action=aplicardescuento" method="POST"><input type="number" min="1" max="100" placeholder="%" name="descuento"><input class="btn-secondary" type="hidden" name="mesa" value="'.$mesanro.'"> <input type="hidden" name="total" value="'.$total.'"> <input  class="btn-secondary" type="SUBMIT" value="APLICAR"></form></td></tr>';endif;?>
<?php if(isset($descuento)):?><?php $total=$total-$descuento;endif;?>
<?php $formulariocliente="";?>
<?php if(isset($moz)):?>
          <?php if (isset($cliente) && $cliente!=null) : ?>
          <?php  $formulariocliente='<tr><td> CLIENTE </td>
          <td>

          <input name="cliente" class="form-control w-100 "value="'.$cliente[0]['cliente'].'"></td>
          <td> </tr>
          <tr><td>
         TELEFONO
          </td>
          <td>
          <input name="telefono" class="form-control w-100" value="'.$cliente[0]['telefono'].'" </td></tr>
          <tr>
          <td> DIRECCION</td>
          
        <td>
          <input name="direccion" class="form-control w-100" value="'.$cliente[0]['direccion'].'"  ></td></tr><tr><td>';else :?><?php
             $formulariocliente='<tr><td> CLIENTE </td>
          <td>

          <input name="cliente" class="form-control w-100 "></td>
          <td> </tr>
          <tr><td>
         TELEFONO
          </td>
          <td>
          <input name="telefono" class="form-control w-100"> </td></tr>
          <tr>
          <td> DIRECCION</td>
          
        <td>
          <input name="direccion" class="form-control w-100" ></td></tr><tr><td>';
          endif;endif;?>

              <?php echo '<tr><td class="text-left" colspan="3">TOTAL</td><td>'.number_format($total,2,',','.').'</td></tr><tr><td class="text-left" colspan="3"><form action="?controller=comanda&action=imprimir" method="POST">'.$formulariocliente.'<input class="btn-secondary" type="hidden" name="mesa" value="'.$mesanro.'"> <input class="btn-secondary" type="SUBMIT" id="imprimir" value="IMPRIMIR" >

</form></td></tr>'; endif;?>


          </tbody>
        </table>
      </div>
    </div>
	
    </div>
    </div>
