 <div class="col-12" style="background-color: #e4dabef5;">
      <div class="row p-2 d-flex" style="font-family: Blanchope Free;font-style: oblique;">
     <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=comanda&action=seleccionarmesa"> COMANDAS
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=productos">ADMINISTRACIÓN
       </a>
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=estadisticas">ESTADISTICAS
       </a>
      
       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=caja&action=index">CAJA CHICA
       </a> 

       <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=caja&action=vercajagrande">CAJA GRANDE
       </a>  <a class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" style="text-decoration: none;border-right: 1px solid white !important;
    background: black;" href="<?=base_url?>?controller=usuario&action=usuarios"><img src="logoestanc.ico" type="img/icon" style="width: 6%;margin-right: 2px;">USUARIOS
       </a>  
     <a id="cerrarsesion" class="p-2 btn-secondary border-secondary flex-fill d-flex justify-content-center" onclick="cerrarsesion()"  style="text-decoration: none;border-right: 1px solid white !important;
    background: black;cursor: pointer;">CERRAR SESIÓN
       </a> 
     </div>
     <div class="row">
    <div class="col-12 col-sm-12">
      <?php if(isset($editar)):?>
        <?php  
        echo '<h4 class="text-center font-weight-bold mt-3">EDITAR USUARIO</h4>';?>
        <?php else :?>
          <?php  
          echo '<h4 class="font-weight-bold mt-3 text-center">AGREGAR NUEVO USUARIO</h4>';endif;?>

        </div>
      </div>
      <div class="row">
        <div class="col-sm-2 mt-2">
          <?php if(isset($editar)):?><?php $accion="?controller=usuario&action=modificar";?> <?php else :?> <?php $accion="?controller=usuario&action=save"; endif;?>
          <form class="form-group" method="POST" action=<?php echo $accion;?> >
            <?php if(isset($editar)):?><?php echo '<input type="hidden" name="id" value='.$editar[0]['id'].'>';endif;?>
              <label class="font-weight-bold d-inline-block float-sm-right float-left align-self-center" for="nombre">USUARIO</label>
            </div>
            <div class="col-sm-10">
              <input type="text" <?php if(isset($editar)):?><?php echo "value=".$editar[0]['nombre'];endif;?> class="form-control d-inline-block" name="nombre">
            </div>
          </div>
          <div class="row mt-2">

            <div class="col-sm-2 col-12">
              <label class="font-weight-bold  d-inline-block float-sm-right float-left  align-self-center" for="password">CONTRASEÑA</label>
            </div>

            <div class="col-sm-10 col-12">
              <input type="password" class="form-control d-inline-block " name="password">
            </div>
          </div>
          <div class="row mt-2">

            <div class="col-2">
              <label class="font-weight-bold d-inline-block float-right align-self-center" for="rol">ROL</label>
            </div>

            <div class="col-5">
              <select name="rol" class="float-left" name="rol">
                <option value="admin" class="font-weight-normal">ADMIN</option>
                <option value="cajero" class="font-weight-normal">CAJERO</option>
                <option value="mozo" class="font-weight-normal">MOZO</option>            
              </select>
            </div>
            <div class="col-5 mb-2">
              <button type="submit" class="btn btn-primary float-right">GUARDAR</button>
            </form>         
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-sm-12 col-12">
          <table class="table table-light table-striped col-12" id="productos-result" style="table-layout: fixed;overflow-wrap: break-word; text-align: center;">    

            <thead>
              <tr>
                <th style="width:50%;" >USUARIO</th>     
                <th style="width:25%;">ROL</th>
                <th style="width:25%;">ACCIÓN</th>
              </tr>
            </thead>
            <tbody class="table table-light table-striped">  

             <?php foreach($usuarios as $usu) : ?> 
              <tr    >
                <td style="vertical-align: middle;"><?=  $usu['nombre']?></td>
                <td style="vertical-align: middle;"><?=  $usu['rol']?></td>
                <td style="vertical-align: middle;">
                  <a href="?controller=usuario&action=editar_usuario&id=<?=$usu['id'];?>" class="btn btn-warning w-sm-50" style="display:inline-block;margin-bottom:4px;color: #4890c7;font-weight: 500;background:white;border-color:#4890c7;">EDITAR</a>
                  <a href="?controller=usuario&action=eliminar&id=<?=$usu['id'];?>"class="btn btn-warning w-sm-50" style="display:inline-block;margin-bottom:4px;color: #c74a48;font-weight: bold;background:white;border-color:#c74a48;">BORRAR</a>
                </td>

              </tr> 
            <?php endforeach;?> 
          </tbody>
        </table> 
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <form class="ml-2 d-inline-block" method="post" action="?controller=usuario&action=backup">
         <input type="file" name="bd"> <input type="submit" class="btn-success ml-5" value="CARGAR BACKUP"></form></form>
       <form class="ml-2 d-inline-block" method="post" action="?controller=usuario&action=vaciarbd">
          <input  type="submit" class="btn-success ml-5" value="LIMPIAR BASE DE DATOS"></form></form>
      </div>
    </div>


