
			<!-- PIE DE PÁGINA -->
<!-- Footer -->
<footer class="footer-copyright text-center py-3 col-12" style=" clear: both;"> 

   
  </footer>
  <script type="text/javascript">
      	function cerrarsesion(){
         
            var respuesta=confirm("estas seguro de cerrar sesion?");
            if (respuesta ==true) {
              document.getElementById('cerrarsesion').setAttribute("href","?controller=usuario&action=logout&respuesta=true");
            }else{
            	var url=window.location;
              document.getElementById('cerrarsesion').setAttribute("href",url);

            }
          
        }
      </script>
	        	<script type="text/javascript">

	  function presionar_tecla() {

    tecla_esc = event.keyCode;
console.log(tecla_esc);
    if (tecla_esc == 43) {
document.getElementById("imprimir").click();
    }
 if (tecla_esc == 45) {
document.getElementById("cerrarmesajs").click();
    }
     if (tecla_esc == 42) {
document.getElementById("abrirmesajs").click();
    }
     if (tecla_esc == 46) {
document.getElementById("mesa_1").focus();

    }
}

window.onkeypress = presionar_tecla;



      </script>
      	<script type="text/javascript">
	if(window.history.replaceState){
		window.history.replaceState(null,null,window.location.href)
		      document.getElementById('palabra').focus();

	}
</script>
      	<script type="text/javascript">
	if(window.history.replaceState){
		window.history.replaceState(null,null,window.location.href)
		      document.getElementById('palabra').focus();

	}
</script>
</div>
</body>
	

    
</html>
 