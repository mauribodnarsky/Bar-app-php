<?php
include 'models/producto.php';

        
         $producto= new producto();
        $text="<div class=\"col-sm-12  col-12 table-wrapper-scroll-y my-custom-scrollbar h-25\">
      <table class=\"table-striped table-dark w-100 ml-sm-4 table-hover\" style=\"text-align: left;\">
        <thead class=\"thead-light\"> 
          <tr  >
            <th class=\"py-3\" style=\"text-align: center;\">CODIGO</th>
            <th class=\"py-3\" style=\"text-align: left;\">NOMBRE</th>
            <th class=\"py-3\" style=\"text-align: left;\">PRECIO</th>
          </tr>
        </thead><tbody>";

       if ($_GET['texto'] != "") {
        $busca= explode(' ', $_GET['texto']);
         $buscar="";

         foreach ($busca as $letra) {
           $buscar= $buscar.$letra."%";
         }
        $productos= $producto->buscarcomanda($buscar);
            if ($productos==0) {
             $text="<h5 class=\"mt-2 ml-sm-5\">No se encontraron resultados</h5>";
            }
            else{
                $num=0;
        foreach ($productos as $value) {

            $text=$text."<tr id=\"fila-".$num."\" onclick=seleccionarcodigo({'codigo':'".$value['codigo']."'})><td style=\"text-align: center;\" >".$value['codigo']."</td>"."<td style=\"text-align: left;\">".$value['nombre']."</td>"."<td style=\"text-align: left;\">"."$ ".$value['precio']."</td></tr>";
            $num++;
         }
     }
  
               
         
        }else{
        $productos= $producto->getAll();
        $int=0;
         foreach ($productos as $value) {
            $text=$text."<tr id=\"fila-".$int."\" onclick=seleccionarcodigo({'codigo':'".$value['codigo']."'})><td style=\"text-align: center;\">".$value['codigo']."</td>"."<td style=\"text-align: left;\">".$value['nombre']."</td>"."<td style=\"text-align: center;\">"."$ ".$value['precio']."</td></tr>";
            $int++;
         }

        }
         
        
        
           
         $text=$text."</tbody></table></div></div></div>";

         echo $text;
         ?>