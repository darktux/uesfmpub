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
		<div id="divcontacto" class="formulario" style="background-color:#BA1010; color:#fff;">
		<br>
			<p>Información de Contacto</p>
			<form>
				<label   for="direccion">Dirección:</label>
				<textarea id="direccion" class="form-control" required></textarea>
				<div class="row">
					<div class="col-md-6">
						<label for="telefono">Teléfono:</label>
						<input  id="telefono" class="form-control" type="text" required>
					</div>
					<div class="col-md-6">
						<label for="fax">Fax:</label>
						<input  id="fax" class="form-control" type="text" required>
					</div>
				</div>
				<label for="correo">Correo Electrónico Institucional:</label>
				<input  id="correo" class="form-control" type="text" required>
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
		    	var dir = $("#direccion").val();
		    	var tel = $("#telefono").val();
		    	var fax = $("#fax").val();
		    	var cor = $("#correo").val();
		    	var msj="<table align='center' border='0'><tr><td>Rellene los siguientes campos:<br><br><td><tr>";
	            var e =false;
	            if($.trim(dir)==""){
	                msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Dirección<td><tr>";
	                e=true;
	            }
	            if($.trim(tel)==""){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Teléfono<td><tr>";
	                e=true;
	            }

	            if($.trim(fax)==""){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Fax<td><tr>";
	                e=true;
	            }

	            if($.trim(cor)==""){
	            	msj=msj+"<tr><td align='left'><span class='glyphicon glyphicon-hand-right' aria-hidden='true'></span>  Correo Electrónico<td><tr>";
	                e=true;
	            }
	            if(e){
	            	msj=msj+"</table>";
	            	alert(msj);
	            	return false;
	            }
	            else{
	            	$.ajax({
			            type:"post",
			            url: "ajax/contacto.ajax.php",
			            data:{direccion:dir, telefono:tel, fax:fax, correo:cor, accion:'upd'},
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