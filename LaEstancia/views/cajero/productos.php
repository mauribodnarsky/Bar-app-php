 <div class="col-12" style="background-color: #e4dabef5;">
  
      <div class="row p-2 d-flex" style="font-family: Blanchope Free;font-style: oblique;">
     <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=comanda&action=seleccionarmesa"> COMANDAS
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=productos"><img src="logoestanc.ico" type="img/icon" style="width: 6%;margin-right: 2px;">ADMINISTRACIÓN
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=caja&action=index">CAJA CHICA
       </a>   
     <a id="cerrarsesion" class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" onclick="cerrarsesion()"  style="text-decoration: none;border-right: 1px solid white !important;
    background: black;cursor: pointer;">CERRAR SESIÓN
       </a> 
     </div>
  <div class="row">
   <div class="col-sm-6 col-12">

    <div class="row">

      <div class="col-sm-12" >
       <input type="text" id="palabra" class="form-control py-1 w-75 mb-3" value="" onkeyup="busqueda();" placeholder="BUSCA UN PRODUCTO" autocomplete="off" name="search">


     </div>
   </div>
   <div class="row" id="datos" onload="busqueda();"></div>
   <script type="text/javascript">
     function busqueda(){
      var texto=document.getElementById("palabra").value;
      var parametros = {
        "texto": texto
      };


      $.ajax({
        data:parametros,
        url: 'buscador.php',
        type:'GET',
        success: function(response){

          $("#datos").html(response);
          console.log(response);
        }
      });
    }
  </script>

</div>  
<div class="col-sm-6 col-12">
  <div class="row">
    <div class="col-sm-12">

      <?php if(isset($seleccionado)):?>

        <H4>EDITAR PRODUCTO</H4>

        <form class="form-group" action="<?=base_url?>" method="GET">
           <input  type="hidden" name="id" value="<?= $seleccionado['codigo'];?>">

          <input type="hidden" name="controller" value="producto">
          <input type="hidden" name="action" value="editar">
          <!--  <label class="d-inline-block font-weight-bold">CATEGORIA</label>
          <select name="categoria" class="form-control w-25">
            <option   value="COMIDAS">COMIDAS</option>
            <option value="VINOS">VINOS</option>
            <option value="BEBIDAS">BEBIDAS</option>
          </select>-->
          <?php else :?>
            <H4>NUEVO PRODUCTO</H4>
            <form class="form-group" action="<?=base_url?>" method="GET">

             <input type="hidden" id="codigoNuevo" name="controller" value="producto">
             <script type="text/javascript">fetch()</script>
        <!--    <label class="d-inline-block font-weight-bold">CATEGORIA</label>
          <select id="categoriasuno" name="categoria" class="form-control w-25">
            <option   value="COMIDAS">COMIDAS</option>
            <option value="VINOS">VINOS</option>
            <option value="BEBIDAS">BEBIDAS</option>
          </select> -->
             <input type="hidden" name="action" value="guardar">
           <?php endif;?>
         </div>
       </div>
       <div class="row ">

        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-12 mb-2"> 
              <label class="d-inline-block font-weight-bold">CÓDIGO</label>
              <input class="form-control w-25 ml-0" type="text" name="codigo"<?php if(isset($seleccionado)):?>value="<?=$seleccionado['codigo'];?>"<?php endif;?>>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 mb-2">
              <LABEL class="d-inline-block font-weight-bold">PRECIO</LABEL>
              <input class="form-control w-25 ml-0" type="number" name="precio" min=0 step="0.50" <?php if(isset($seleccionado)):?>value="<?=$seleccionado['precio'];?>"<?php endif;?>>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 mb-2">
              <LABEL class="d-inline-block font-weight-bold">NOMBRE</LABEL>
              <input class="form-control w-75 ml-0" type="text" name="nombre" <?php if(isset($seleccionado)):?>value="<?=$seleccionado['nombre'];?>"<?php endif;?>>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 mb-2">
              <input class="form-control btn-success float-left py-1 px-2" style="text-decoration: none !important;border-radius:0.3em;"type="submit" value="GUARDAR">
            </div>
            <div class="col-sm-6 mb-2">
              <?php if(isset($mensaje)):?><h6 style="font-weight: 500;color: red;"><?= $mensaje; endif;?>
            </div>
          </form>
        </div>
   <!--     <div class="row">
          <div class="col-sm-12">
              <H4>AUMENTAR PRECIOS</H4>
            <form class="form-group" action="?controller=producto&action=aumentarprecio" method="POST">        <label class="d-inline-block font-weight-bold">PORCENTAJE</label>
             <input type="number" class="form-control w-25" step="0.1" name="porcentaje" autocomplete="off">
            <label class="d-inline-block font-weight-bold">CATEGORIA</label>
          <select id="categoriasdos" name="categoria" class="form-control w-25">
            <option  value="COMIDAS">COMIDAS</option>
            <option value="VINOS">VINOS</option>
            <option value="BEBIDAS">BEBIDAS</option>
          </select>
             <input type="submit" class="form-control btn-success mt-2 w-25 d-inline-block"  value="APLICAR AUMENTO">
           
          </div>
        </div>
         -->
        <div class="row">
         <div class="col-sm-12">
          <h4>MESAS</h4>
        </div>
        <div class="col-sm-12">
         <a href="<?=base_url?>?controller=usuario&action=agregarMesa" class="form-control btn-link w-25 mt-1 mb-2  text-center px-2" style="text-decoration: none !important;border-radius: 0.3;">AGREGAR</a>
        </form>
      </div>
    </div>
          </div>

  </div>
  

</div>

</div>

