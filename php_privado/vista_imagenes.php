<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/estilos.css" rel="stylesheet">
		<style type="text/css">
			p{font-size: 10px;}
		</style>
	</head>
	<body>
		<div class="container-fluid" id="imagenes" ></div>
		<div id="objetivos"></div>
		<script src="../bootstrap-3.3.4-dist/js/jquery.min.1.11.2.js"></script>
	    <script src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	    <script type="text/javascript">
	    	function allowDrop(ev) {
			    ev.preventDefault();
			}
			function drag(ev){
			    ev.dataTransfer.setData("text", ev.target.id);
			}
			function dropimagenes(ev,roles,obj){
			    ev.preventDefault();
			    var iddrop = ev.dataTransfer.getData("text");
			    if(!/\//.test(iddrop)){
				    $.ajax({
			            type:"post",
			            url: "../ajax/imagen.ajax.php",
			            data:{idimagen:iddrop, idrol:roles, accion:'imagenes'},
			            success:function(responseText){
			            	if(/Éxito/.test(responseText)){
			            		$("#"+obj).attr("src", $("#"+iddrop).attr("src") );
			            	}
				        	else{
				        		alert('ERROR: '+responseText);
				        	}
			            }
				    });
			   	}
			}
			function dropgaleria(ev,val){
			    ev.preventDefault();
			    var iddrop = ev.dataTransfer.getData("text");
			    if(!/\//.test(iddrop)){
			    	$.ajax({
			            type:"post",
			            url: "../ajax/imagen.ajax.php",
			            data:{idimagen:iddrop, accion:'galeria', cambio:val},
			            success:function(responseText){
			            	if(/Éxito/.test(responseText)){
			            		//alert(responseText);
			            		if(val=='false'){
				            		$("#imagenes").load('../ajax/imagen.ajax.php',{accion:'obtienegaleria'});
				            	}
				            	else{
				            		$("#imagenes").load('../ajax/imagen.ajax.php',{accion:'obtieneimagenes'});
				            		$("#objetivos").load('../ajax/imagen.ajax.php',{accion:'controlimagenes'});
				            	}
			            	}
				        	else{
				        		alert('ERROR: '+responseText);
				        	}
			            }
				    });
			    }
			}
			function dropbasurero(ev,val){
			    ev.preventDefault();
			    var iddrop = ev.dataTransfer.getData("text");
			    if(!/\//.test(iddrop)){
			    	$.ajax({
			            type:"post",
			            url: "../ajax/imagen.ajax.php",
			            data:{idimagen:iddrop, accion:'basurero', cambio:val},
			            success:function(responseText){
			            	if(/Éxito/.test(responseText)){
			            		//alert(responseText);
			            		if(val=='true'){
				            		$("#imagenes").load('../ajax/imagen.ajax.php',{accion:'obtienebasurero'});
				            	}
				            	else{
				            		$("#imagenes").load('../ajax/imagen.ajax.php',{accion:'obtieneimagenes'});
				            		$("#objetivos").load('../ajax/imagen.ajax.php',{accion:'controlimagenes'});
				            	}
			            	}
				        	else{
				        		alert('ERROR: '+responseText);
				        	}
			            }
				    });
				}
			}
			function dropeliminar(ev){
			    ev.preventDefault();
			    var iddrop = ev.dataTransfer.getData("text");
			    if(!/\//.test(iddrop)){
				    confirm('¿Realmente desea eliminar la imagen arrastrada?<br><img src="'+$("#"+iddrop).attr("src")+'" width="100">',function(){
				    	$.ajax({
				            type:"post",
				            url: "../ajax/imagen.ajax.php",
				            data:{idimagen:iddrop, accion:'eliminar'},
				            success:function(responseText){
				            	if(/Éxito/.test(responseText)){
				            		alert(responseText);
				            		$("#imagenes").load('../ajax/imagen.ajax.php',{accion:'obtienebasurero'});
				            	}
					        	else{
					        		alert('ERROR: '+responseText);
					        	}
				            }
					    });
				    });
				}
			}
	  		function cambio1(){
	    		$("#imagenes").load('../ajax/imagen.ajax.php',{accion:'obtieneimagenes'});
			    $("#objetivos").load('../ajax/imagen.ajax.php',{accion:'controlimagenes'});
	  		}
	  		function cambio2(){
	    		$("#imagenes").load('../ajax/imagen.ajax.php',{accion:'obtienegaleria'});
	    		$("#objetivos").load('../ajax/imagen.ajax.php',{accion:'controlgaleria'});
	  		}
	  		function cambio3(){
	    		$("#imagenes").load('../ajax/imagen.ajax.php',{accion:'obtienebasurero'});
	    		$("#objetivos").load('../ajax/imagen.ajax.php',{accion:'controlbasurero'});
	  		}
	  		window.onload=function(){ cambio1(); }
	    </script>
	</body>
</html>