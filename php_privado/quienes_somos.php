<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/estilos.css" rel="stylesheet">
		<!-- <link href="../bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/alert2.css" rel="stylesheet"> -->

	</head>
	<body>
		<br>
		<div id="divquienessomos" class="formulario" style="background-color:#BA1010; color:#fff;">
			<br>
			<p>Información de Quienes Somos</p>
			<form>
				<label for="titular">Titular:</label>
				<input  id="titular" class="form-control" type="text">
				<label   for="mision">Misión:</label>
				<textarea id="mision" class="form-control" cols="10"></textarea>
				<label   for="vision">Visión:</label>
				<textarea id="vision" class="form-control" cols="10"></textarea>
				<!-- <label for="organigrama">Organigrama:</label>
				<input  id="organigrama" class="form-control" type="text"> -->
			</form>
			<br>
			<button class="btn btn-primary pull-right" onclick="validar();">
				
				Guardar
			</button>
		</div>
		<br>
		<!--<script src="../bootstrap-3.3.4-dist/js/jquery.min.1.11.2.js"></script>
	    <script src="../bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	    <script src="../js/alert2.js"></script>-->

		<script type="text/javascript">
		    function validar(){
		    	var tit = $("#titular").val();
		    	var mis = $("#mision").val();
		    	var vis = $("#vision").val();
		    	//var org = $("#organigrama").val();
		    	var msj="<table align='center' border='0'><tr><td>Rellene los siguientes campos:<br><br><td><tr>";
	            var e =false;
	            if($.trim(tit)==""){
	                msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Titular<td><tr>";
	                e=true;
	            }
	            if($.trim(mis)==""){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Misión<td><tr>";
	                e=true;
	            }

	            if($.trim(vis)==""){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Visión<td><tr>";
	                e=true;
	            }

	         /*   if($.trim(org)==""){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Organigrama<td><tr>";
	                e=true;
	            }*/
	            if(e){
	            	msj=msj+"</table>";
	            	alert(msj);
	            	return false;
	            }
	            else{
	            	$.ajax({
			            type:"post",
			            url: "ajax/quienes_somos.ajax.php",
			            data:{titular:tit, mision:mis, vision:vis, /*organigrama:org,*/ accion:'upd'},
			            success:function(responseText){
				        	alert(responseText);
			            }
				    });    
	            	return true; 
				}
			}

	    </script>
	</body>
</html>