      <?php
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Credentials: true");
      header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
      header('Access-Control-Max-Age: 1000');
      header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
      header('content-type: application/json; charset=utf-8');
      require_once '../models/producto.php';
      require_once '../models/mesa.php';
      require_once '../utils/utils.php';

      class productocontroller{
      	
        public $json; 
        public function __construct($objjson) {
          $this->json = $objjson;
          
        }

       public function eliminar(){

        $id= $this->json->id;
        $producto= new Producto();
        $busqueda= $producto->eliminar($id);
        $productos = $producto->getAll();
        $objmesa= new mesa();
        $mesas= $objmesa->obtenerMesas();
        $json=['mesas'=>$mesas,'productos'=>$productos];
        echo json_encode($json);
          } 
      public function guardar(){
       $producto= new Producto();
         $nombre = $this->json->nombre;
         $precio = $this->json->precio;
         $codigo = $this->json->codigo;
       
       if($nombre && $precio && $codigo){
        $producto = new Producto();
        $producto->setNombre($nombre);
        $producto->setPrecio($precio);
        $producto->setCodigo($codigo);
                $verificarcodigos=$producto->obtenercodigos($codigo);
      }
        if ($verificarcodigos!=false) {

        $mensaje="Error: Código ya existe";
        };
        if ($verificarcodigos==false) {
          $producto->save();   
          $mensaje="Producto creado correctamente";
        }   		
        $productos=$producto->getAll();
        $objmesa= new mesa();
        $mesas= $objmesa->obtenerMesas();
        $json=['mensaje'=>$mensaje,'productos'=>$productos];
        echo json_encode($json);
      }

        public function modificar(){
          $producto= new producto();
          $id=$this->json->id;
          $seleccionado=$producto->obteneruno($id);
          $productos=$producto->getAll();
          $objmesa= new mesa();
          $mesas= $objmesa->obtenerMesas();
          $json=['productos'=>$productos,'producto'=>$seleccionado];
          echo json_encode($json);

        }
        public function editar(){
           $producto= new Producto();
           $id= $this->json->id;
           $nombre = $this->json->nombre;
           $precio = $this->json->precio;
           $codigo = $this->json->codigo;

            $producto = new Producto();
            $producto->setNombre($nombre);
            $producto->setPrecio($precio);
            $producto->setCodigo($codigo);

           // $verificarcodigos=$producto->obtenercodigos($codigo);
          //}
            
       // if ($verificarcodigos!=false) {

        //$mensaje="Error: Código ya existe";
        //};
        //if ($verificarcodigos==false) {
        $producto->editar($id);   
        $mensaje="Producto modificado correctamente";
        //} 
            $objmesa= new mesa();
            $mesas= $objmesa->obtenerMesas();
            $productos = $producto->getAll();
          
            $json=['mensaje'=>$mensaje,'productos'=>$productos];
            echo json_encode($json);
              }
 public function aumentarprecio(){
           $producto= new Producto();

           if(isset($_POST)){
            $porcentaje = isset($_POST['porcentaje']) ? $_POST['porcentaje'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

}
          if($categoria && $porcentaje){
        $producto->aumentarprecio($porcentaje,$categoria);   
          }
          
            $objmesa= new mesa();
            $mesas= $objmesa->obtenerMesas();
            $productos = $producto->getAll();
          
          require_once 'views/administrador/productos.php';
        }




      }   $objrecibido = json_decode(file_get_contents("php://input"));                                                                                                                                                                                       
      $accion=$objrecibido->accion;
     $objetocaja= new productocontroller($objrecibido);
     
      $objetocaja->$accion();	