<div class="col-12" style="display: inline-block; margin-top: 120px;">
	<video  controls autoplay width="70%"  height="auto" src="<?=base_url?>/media/armar-csv.mp4" type='video/mp4' style="display: inline-block;">  </video>

	<ol>
		 <li style="color: red;font-weight: bold">*En caso de actualizar una lista debe tener dos columnas: PRODUCTO-PRECIO </li>
        <li style="color: red;font-weight: bold">*En caso de cargar nuevos productos, la lista debe tener tres columnas: PRODUCTO-PRECIO PROVEEDOR-PRECIO VENTA (copiar columna del precio proveedor en caso de no tener precio de venta) </li>
		<li>Separar celdas combinadas</li>
		<li>En una celda vacia seleccionar el nombre del producto en caso de tener que combinar dos textos usar la funcion <b>=CONCATENAR(A27;" ";B27)</b> </li>
		<li>En la celda derecha al nombre seleccionar el precio de costo</li>
		<li>Luego arrastramos hacia el ultimo producto</li>
		<li>Copiamos estas dos ultimas columnas</li>
		<li>Creamos un nuevo archivo excel donde damos 2do click en la primer celda y seleccionamos 'pegado especial' 'pegar valores'</li>
		<li>seleccionamos las columnas de precios dando click en la letra cabecera y cambiamos su formato de celdas dando segundo click, seleccionamos formato de celdas numero con dos decimales </li>
        <li>Por ultimo lo guardamos como un archivo CSV(delimitado por comas)</li>
       

	</ol>

</div>