<?php
include 'models/producto.php';

        
         $producto= new producto();
        $text="<div class=\"col-12 table-wrapper-scroll-y my-custom-scrollbar h-25\">
      <table class=\"table-striped table-dark w-100 table-hover\" style=\"text-align: left;\">
        <thead class=\"thead-light\"> 
          <tr  >
            <th class=\"py-3\" style=\"text-align: center;\">CODIGO</th>
            <th>NOMBRE</th>
            <th style=\"text-align: center;\">PRECIO</th>
            <th style=\"text-align: center;\">ACCION</th>
          </tr>
        </thead><tbody>";

       if ($_GET['texto'] != "") {
        $busca= explode(' ', $_GET['texto']);
         $buscar="";

         foreach ($busca as $letra) {
           $buscar= $buscar.$letra."%";
         }
        $productos= $producto->buscar($buscar);
            if ($productos==0) {
             $text="<h4 class=\"mt-2 ml-2\">No se encontraron resultados</h4>";
            }
            else{
        foreach ($productos as $value) {
            $text=$text."<tr onclick=seleccionar(".$value['codigo'].")><td style=\"text-align: center;\">".$value['codigo']."</td>"."<td style=\"text-align: left;\">".$value['nombre']."</td>"."<td style=\"text-align: center;\">"."$ ".$value['precio']."</td>"."<td><a class=\"btn-primary d-block my-2 mx-1 py-2 px-1 \"  style=\"border-radius:0.3em;text-align: center; text-decoration: none;\" href="."http://localhost:8080/laEstancia"."?controller=producto&action=modificar&id=".$value['codigo'].">EDITAR</a><a class=\"btn-danger d-block my-2 mx-1 py-2 px-1 \" style=\"border-radius:0.3em;text-align: center;text-decoration: none;\" href="."http://localhost:8080/laEstancia"."?controller=producto&action=eliminar&id=".$value['codigo'].">ELIMINAR</a></td></tr>";
         }
     }
  
               
         
        }else{
        $productos= $producto->getAll();
         foreach ($productos as $value) {
            $text=$text."<tr onclick=seleccionar(".$value['codigo'].")><td style=\"text-align: center;\">".$value['codigo']."</td>"."<td style=\"text-align: left;\">".$value['nombre']."</td>"."<td style=\"text-align: center;\">"."$ ".$value['precio']."</td>"."<td><a class=\"btn-primary d-block my-2 mx-1 py-2 px-1 \"  style=\"border-radius:0.3em;text-align: center; text-decoration: none;\" href="."http://localhost:8080/laEstancia"."?controller=producto&action=modificar&id=".$value['codigo'].">EDITAR</a><a class=\"btn-danger d-block my-2 mx-1 py-2 px-1 \" style=\"border-radius:0.3em;text-align: center;text-decoration: none;\" href="."http://localhost:8080/laEstancia"."?controller=producto&action=eliminar&id=".$value['codigo'].">ELIMINAR</a></td></tr>";
         }

        }
         
        
        
           
         $text=$text."</tbody></table></div></div></div>";

         echo $text;
         ?>